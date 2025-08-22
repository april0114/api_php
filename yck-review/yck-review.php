<?php
/**
 * Plugin Name: YCK Simple Reviews
 * Description: 간단한 리뷰 플러그인 — 폼 제출 → 즉시 공개, 카드 그리드 출력, 관리자에서 전체 리뷰 보기/수정/삭제. 쇼트코드: [yck_review_form] , [yck_reviews per_page="5" order="DESC" pagination="yes"]
 * Version: 1.1.0
 * Author: April,Ha
 * License: GPL2+
 */

if (!defined('ABSPATH')) exit;

class YCK_Simple_Reviews {
    const CPT = 'yck_review';
    const NONCE = 'yck_review_nonce';
    const NONCE_ACTION = 'yck_review_submit';

    public function __construct() {
        // Custom Post Type
        add_action('init', [$this, 'register_cpt']);
        // Assets
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);

        // Shortcodes
        add_shortcode('yck_review_form', [$this, 'shortcode_form']);
        add_shortcode('yck_reviews',     [$this, 'shortcode_list']);

        // Form handlers (front-end submit → admin-post)
        add_action('admin_post_nopriv_yck_submit_review', [$this, 'handle_form_submission']);
        add_action('admin_post_yck_submit_review',         [$this, 'handle_form_submission']);

        // Admin meta boxes & columns
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post',      [$this, 'save_review_meta']);
        add_filter('manage_edit-' . self::CPT . '_columns',        [$this, 'admin_columns']);
        add_action('manage_' . self::CPT . '_posts_custom_column', [$this, 'render_admin_columns'], 10, 2);

        // Simple CSS (front-end)
        add_action('wp_head', [$this, 'inline_styles']);
        

    }



    /**
     * Register Custom Post Type for Reviews.
     */
    public function register_cpt() {
        $labels = [
            'name'               => 'Reviews',
            'singular_name'      => 'Review',
            'menu_name'          => 'Reviews',
            'name_admin_bar'     => 'Review',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Review',
            'new_item'           => 'New Review',
            'edit_item'          => 'Edit Review',
            'view_item'          => 'View Review',
            'all_items'          => 'All Reviews',
            'search_items'       => 'Search Reviews',
        ];
        $args = [
            'labels'             => $labels,
            'public'             => false,            // 프론트엔드 단일글 노출 X
            'show_ui'            => true,             // 관리자 화면 O
            'show_in_menu'       => true,
            'supports'           => ['title', 'editor'], // title: 작성자명, editor: 본문
            'capability_type'    => 'post',
            'map_meta_cap'       => true,
            'has_archive'        => false,
            'menu_icon'          => 'dashicons-star-filled',
              'capabilities'    => [
      // 목록 화면 진입 권한을 'read'로 낮춤 (모든 로그인 유저 가능)
      'edit_posts'         => 'read',
      'delete_posts'        => 'read',
      'publish_posts'      => 'read',
      'delete_posts'       => 'read',
      'edit_others_posts'  => 'read',
      'delete_others_posts'=> 'read',
  ],
        ];
        register_post_type(self::CPT, $args);
    }

    /**flqb 
     * Assets: Font Awesome + 별점 클릭 JS/CSS
     */
    public function enqueue_assets() {
        // Font Awesome
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            [],
            '5.15.4'
        );

        // 간단 스타일(별점 위젯 일부)
        $inline_css = '
          .yck-stars, .yck-stars-input { color:#FFD700; font-size:1.25rem; line-height:1; }
          .yck-stars-input i { cursor:pointer; }
          .yck-stars-input .yck-star.active { transform:scale(1.05); }
          .yck-stars-input:focus-within { outline:2px solid #ddd; outline-offset:2px; border-radius:6px; padding:2px; }
          .yck-sr-only { position:absolute!important; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); border:0; }
          .yck-sim-badge{display:inline-block;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:999px;padding:2px 8px;font-size:12px;margin-left:6px}
        ';
        wp_add_inline_style('font-awesome', $inline_css);

        // 별점 위젯 동작 스크립트
        if ( ! wp_script_is('yck-reviews-inline-base', 'enqueued') ) {
            wp_register_script('yck-reviews-inline-base', '', [], null, true);
            wp_enqueue_script('yck-reviews-inline-base');
        }

        $inline_js = <<<'JS'
(function(){
  function init(container){
    if(!container) return;
    var stars = container.querySelectorAll(".yck-star");
    var input = container.querySelector("input[name='yck_rating']");
    function set(val){
      input.value = val;
      stars.forEach(function(el){
        var v = parseInt(el.getAttribute("data-value"),10);
        var active = v <= val;
        el.className = (active ? "fas" : "far") + " fa-star yck-star" + (active ? " active" : "");
        el.setAttribute("aria-checked", v === val ? "true" : "false");
      });
    }
    stars.forEach(function(el){
      el.addEventListener("click", function(){
        set(parseInt(this.getAttribute("data-value"),10));
      });
      el.addEventListener("keydown", function(e){
        var val = parseInt(input.value||"0",10);
        if(e.key === "ArrowRight" || e.key === "ArrowUp"){ e.preventDefault(); set(Math.min(5, val+1)); }
        if(e.key === "ArrowLeft"  || e.key === "ArrowDown"){ e.preventDefault(); set(Math.max(1, val-1)); }
        if(e.key === "Home"){ e.preventDefault(); set(1); }
        if(e.key === "End"){ e.preventDefault(); set(5); }
        if(e.key === " " || e.key === "Enter"){ e.preventDefault(); set(parseInt(this.getAttribute("data-value"),10)); }
      });
    });
    set(parseInt(input.value||"0",10));
  }
  document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll(".yck-stars-input").forEach(init);
      if(window.location.search.includes('yck_review_submitted=1')){
    // URL 파라미터 제거
    var cleanUrl = window.location.origin + window.location.pathname;
    history.replaceState({}, document.title, cleanUrl);
  }
  });
})();
JS;
        // 별점 위젯 스크립트를 실제로 붙여준다
        wp_add_inline_script('yck-reviews-inline-base', $inline_js);
        // ※ 더보기 토글 스크립트는 완전히 제거됨
    }

    /**
     * Front-end form shortcode: [yck_review_form]
     */
    public function shortcode_form($atts = []) {
        // 언어 감지: URL에 /en_ 이 포함되면 영어
        $is_english = (strpos($_SERVER['REQUEST_URI'], '/en_') !== false);

        // 라벨/문구
        $labels = [
            'success'       => $is_english ? 'Your review has been submitted. Thank you! ' : '리뷰가 등록되었습니다! 감사합니다.',
            'error_prefix'  => $is_english ? 'Error: ' : '오류: ',
            'name'          => $is_english ? 'Name' : '이름',
            'email'         => $is_english ? 'Email (optional)' : '이메일 (선택)',
            'rating'        => $is_english ? 'Rating' : '평점',
            'message'       => $is_english ? 'Review' : '리뷰 내용',
            'select'        => $is_english ? 'Select' : '선택',
            'required_tag'  => '<span class="req">*</span>',
            'submit'        => $is_english ? 'Submit Review' : '리뷰 제출',
            'sim_type'      => $is_english ? 'SIM Type' : 'SIM 종류',
            'esim'          => 'eSIM',
            'usim'          => 'USIM(공항픽업)',
            'required_note' => $is_english ? 'This is a required field.' : '필수 입력 항목입니다.',
        ];

        $success  = isset($_GET['yck_review_submitted']) && $_GET['yck_review_submitted'] == '1';
        $error    = isset($_GET['yck_review_error']) ? sanitize_text_field($_GET['yck_review_error']) : '';

        // current URL (no query) for redirect default
        $redirect = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');

        ob_start();
        if ($error) {
            echo '<div class="yck-review-alert yck-error">' . esc_html($labels['error_prefix'] . $error) . '</div>';
        }
        ?>
        <div class="yck-form-wrap">
        <form class="yck-review-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <div class="yck-field">
                <label for="yck_name">
                    <?php echo esc_html($labels['name']); ?> <?php echo $labels['required_tag']; ?>
                </label>
                <input type="text" id="yck_name" name="yck_name" required maxlength="80" aria-required="true" />
            </div>

            <div class="yck-field">
                <label for="yck_email"><?php echo esc_html($labels['email']); ?></label>
                <input type="email" id="yck_email" name="yck_email" maxlength="120" />
            </div>

            <div class="yck-field">
                <label for="yck_sim_type">
                    <?php echo esc_html($labels['sim_type']); ?> <span class="req">*</span>
                </label>
                <select id="yck_sim_type" name="yck_sim_type" required>
                    <option value=""><?php echo esc_html($labels['select']); ?></option>
                    <option value="esim"><?php echo esc_html($labels['esim']); ?></option>
                    <option value="usim"><?php echo esc_html($labels['usim']); ?></option>
                </select>
            </div>

            <div class="yck-field">
              <label for="yck_rating_widget">
                <?php echo esc_html($labels['rating']); ?> <?php echo $labels['required_tag']; ?>
              </label>

              <div id="yck_rating_widget"
                   class="yck-stars-input"
                   role="radiogroup"
                   aria-label="<?php echo esc_attr($labels['rating']); ?>">
                <input type="hidden" name="yck_rating" value="5" required />
                <i class="far fa-star yck-star" tabindex="0" role="radio" aria-checked="false" data-value="1" aria-label="1"></i>
                <i class="far fa-star yck-star" tabindex="0" role="radio" aria-checked="false" data-value="2" aria-label="2"></i>
                <i class="far fa-star yck-star" tabindex="0" role="radio" aria-checked="false" data-value="3" aria-label="3"></i>
                <i class="far fa-star yck-star" tabindex="0" role="radio" aria-checked="false" data-value="4" aria-label="4"></i>
                <i class="far fa-star yck-star" tabindex="0" role="radio" aria-checked="false" data-value="5" aria-label="5"></i>
              </div>
            </div>

            <div class="yck-field">
                <label for="yck_message">
                    <?php echo esc_html($labels['message']); ?> <?php echo $labels['required_tag']; ?>
                </label>
                <textarea id="yck_message" name="yck_message" rows="6" required aria-required="true"></textarea>
            </div>

            <?php wp_nonce_field(self::NONCE_ACTION, self::NONCE); ?>
            <input type="hidden" name="action" value="yck_submit_review" />
            <input type="text" name="yck_hp" value="" style="display:none" autocomplete="off" tabindex="-1" aria-hidden="true" />
            <input type="hidden" name="yck_redirect" value="<?php echo esc_url($redirect); ?>" />

            <button type="submit" class="yck-btn"><?php echo esc_html($labels['submit']); ?></button>

            <?php if ($success): ?>
              <div class="yck-form-success"><?php echo esc_html($labels['success']); ?></div>
            <?php endif; ?>
        </form>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Handle form submission: create CPT post and meta.
     */
    public function handle_form_submission() {
        // Basic nonce
        if (!isset($_POST[self::NONCE]) || !wp_verify_nonce($_POST[self::NONCE], self::NONCE_ACTION)) {
            return $this->redirect_with_error('잘못된 요청입니다 (nonce).');
        }
        // Honeypot
        if (!empty($_POST['yck_hp'])) {
            return $this->redirect_with_error('스팸으로 의심되는 요청입니다.');
        }
        $name     = isset($_POST['yck_name'])     ? sanitize_text_field($_POST['yck_name']) : '';
        $email    = isset($_POST['yck_email'])    ? sanitize_email($_POST['yck_email'])     : '';
        $rating   = isset($_POST['yck_rating'])   ? intval($_POST['yck_rating'])            : 0;
        $message  = isset($_POST['yck_message'])  ? wp_kses_post($_POST['yck_message'])     : '';
        $sim_type = isset($_POST['yck_sim_type']) ? sanitize_text_field($_POST['yck_sim_type']) : '';
        $redirect = isset($_POST['yck_redirect']) ? esc_url_raw($_POST['yck_redirect'])     : home_url('/');

        $allowed_sim = ['esim','usim'];
        if (!$name || !$message || $rating < 1 || $rating > 5 || !in_array($sim_type, $allowed_sim, true)) {
            return $this->redirect_with_error('필수 항목을 확인해 주세요.');
        }

        // Create post (publish immediately → 바로 노출)
        $post_id = wp_insert_post([
            'post_type'    => self::CPT,
            'post_title'   => $name,
            'post_content' => $message,
            'post_status'  => 'publish',
        ], true);

        if (is_wp_error($post_id)) {
            return $this->redirect_with_error('저장 중 오류가 발생했습니다.');
        }

        // Save meta
        update_post_meta($post_id, 'yck_reviewer_name',  $name);
        if ($email) update_post_meta($post_id, 'yck_reviewer_email', $email);
        update_post_meta($post_id, 'yck_rating',   $rating);
        update_post_meta($post_id, 'yck_sim_type', $sim_type);

        // Redirect back with success flag
        wp_safe_redirect(add_query_arg('yck_review_submitted', '1', $redirect));
        exit;
    }

    private function redirect_with_error($msg) {
        $redirect = isset($_POST['yck_redirect']) ? esc_url_raw($_POST['yck_redirect']) : home_url('/');
        wp_safe_redirect(add_query_arg('yck_review_error', rawurlencode($msg), $redirect));
        exit;
    }

    /**
     * 이름 마스킹
     */
    // private function mask_name($name) {
    //     if (function_exists('mb_substr')) {
    //         $head = mb_substr(trim($name), 0, 3, 'UTF-8');
    //     } else {
    //         $head = substr(trim($name), 0, 3);
    //     }
    //     return $head . '*****';
    // }

    /**
     * 카드 그리드 출력: [yck_reviews per_page="8" order="DESC" pagination="no"]
     */
    public function shortcode_list($atts = []) {
        $atts = shortcode_atts([
            'per_page'   => '9',
            'order'      => 'DESC',
            'pagination' => 'yes',
        ], $atts, 'yck_reviews');

        $per_page   = intval($atts['per_page']);
        $order      = in_array(strtoupper($atts['order']), ['ASC','DESC']) ? strtoupper($atts['order']) : 'DESC';
        $pagination = strtolower($atts['pagination']) === 'yes';

        $paged = max(1, get_query_var('paged') ? intval(get_query_var('paged')) : (isset($_GET['paged']) ? intval($_GET['paged']) : 1));

        $q = new WP_Query([
            'post_type'      => self::CPT,
            'post_status'    => 'publish',
            'posts_per_page' => $per_page === 0 ? 5 : $per_page,
            'orderby'        => 'date',
            'order'          => $order,
            'paged'          => $pagination && $per_page > 0 ? $paged : 1,
        ]);

        ob_start();

        if ($q->have_posts()) {
            echo '<div class="yck-reviewbox-section"><div class="yck-reviewbox-grid">';

            while ($q->have_posts()) {
                $q->the_post();
                $post_id = get_the_ID();
                $name    = get_post_meta($post_id, 'yck_reviewer_name', true) ?: get_the_title();
                $rating  = intval(get_post_meta($post_id, 'yck_rating', true));
                $sim     = get_post_meta($post_id, 'yck_sim_type', true);
                $sim_lbl = ($sim === 'esim' ? 'eSIM' : (($sim === 'usim') ? 'USIM(공항픽업)' : ''));
                $date    = get_the_date('Y-m-d');

                // 본문 전체 출력 (태그 제거)
                $full_text = trim( wp_strip_all_tags( get_the_content() ) );
                $uid = 'yck-body-' . $post_id;
                ?>
                <div class="yck-reviewbox-card">
                    <div class="yck-reviewbox-header">
                        <div class="yck-reviewbox-name">
    <?php echo esc_html($name); ?>
</div>
                        <div class="yck-reviewbox-stars-date">
                            <div class="yck-reviewbox-stars" aria-label="rating: <?php echo esc_attr($rating); ?>">
                                <?php
                                for ($i=1; $i<=5; $i++) {
                                    echo $i <= $rating
                                        ? '<i class="fas fa-star" aria-hidden="true"></i>'
                                        : '<i class="far fa-star" aria-hidden="true"></i>';
                                }
                                ?>
                            </div>
                            <div><?php echo esc_html( trim($sim_lbl . ($sim_lbl && $date ? ' / ' : '') . $date) ); ?></div>
                        </div>
                    </div>

<div class="yck-reviewbox-text" id="<?php echo esc_attr($uid); ?>"><?php echo esc_html($full_text); ?></div>
                </div>
                <?php
            }

            echo '</div></div>'; // .yck-reviewbox-grid / .yck-reviewbox-section

            if ($pagination && $per_page > 0) {
                $big = 999999999;
                $links = paginate_links([
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'current'   => max(1, $paged),
                    'total'     => $q->max_num_pages,
                    'type'      => 'list',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ]);
                if ($links) echo '<nav class="yck-pagination">' . $links . '</nav>';
            }

        } else {
            echo '<p class="yck-empty">아직 등록된 리뷰가 없습니다.</p>';
        }

        wp_reset_postdata();
        return ob_get_clean();
    }

    private function render_stars($rating) { // (리스트 모드에서 쓰던 함수 — 호환용)
        $rating = max(0, min(5, intval($rating)));
        $html = '<span class="yck-stars" aria-label="Rating: ' . esc_attr($rating) . ' / 5">';
        for ($i = 1; $i <= 5; $i++) {
            $html .= $i <= $rating
                ? '<i class="fas fa-star" aria-hidden="true"></i>'
                : '<i class="far fa-star" aria-hidden="true"></i>';
        }
        $html .= '</span>';
        return $html;
    }

    /**
     * Admin meta box for editing review meta
     */
    public function add_meta_boxes() {
        add_meta_box('yck_review_meta', 'Review Info', [$this, 'render_meta_box'], self::CPT, 'side', 'default');
    }

    public function render_meta_box($post) {
        $name   = get_post_meta($post->ID, 'yck_reviewer_name', true);
        $email  = get_post_meta($post->ID, 'yck_reviewer_email', true);
        $rating = intval(get_post_meta($post->ID, 'yck_rating', true));
        $sim    = get_post_meta($post->ID, 'yck_sim_type', true);
        wp_nonce_field('yck_admin_meta_save', 'yck_admin_meta_nonce');
        ?>
        <p>
            <label for="yck_reviewer_name">이름</label>
            <input type="text" id="yck_reviewer_name" name="yck_reviewer_name" value="<?php echo esc_attr($name); ?>" class="widefat" />
        </p>
        <p>
            <label for="yck_reviewer_email">이메일</label>
            <input type="email" id="yck_reviewer_email" name="yck_reviewer_email" value="<?php echo esc_attr($email); ?>" class="widefat" />
        </p>
        <p>
            <label for="yck_rating">평점</label>
            <select id="yck_rating" name="yck_rating" class="widefat">
                <?php for ($i=5; $i>=1; $i--) : ?>
                    <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </p>
        <p>
            <label for="yck_sim_type">SIM 종류</label>
            <select id="yck_sim_type" name="yck_sim_type" class="widefat">
                <option value=""> - </option>
                <option value="esim" <?php selected($sim, 'esim'); ?>>eSIM</option>
                <option value="usim" <?php selected($sim, 'usim'); ?>>USIM(공항픽업)</option>
            </select>
        </p>
        <?php
    }

    public function save_review_meta($post_id) {
        if (get_post_type($post_id) !== self::CPT) return;
        if (!isset($_POST['yck_admin_meta_nonce']) || !wp_verify_nonce($_POST['yck_admin_meta_nonce'], 'yck_admin_meta_save')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['yck_reviewer_name']))  update_post_meta($post_id, 'yck_reviewer_name', sanitize_text_field($_POST['yck_reviewer_name']));
        if (isset($_POST['yck_reviewer_email'])) update_post_meta($post_id, 'yck_reviewer_email', sanitize_email($_POST['yck_reviewer_email']));
        if (isset($_POST['yck_rating']))         update_post_meta($post_id, 'yck_rating', max(1, min(5, intval($_POST['yck_rating']))));

        if (isset($_POST['yck_sim_type'])) {
            $sim = sanitize_text_field($_POST['yck_sim_type']);
            if (in_array($sim, ['esim','usim'], true) || $sim === '') {
                update_post_meta($post_id, 'yck_sim_type', $sim);
            }
        }
    }

    /**
     * Admin list columns
     */
    public function admin_columns($columns) {
        $new = [];
        foreach ($columns as $key => $label) {
            if ($key === 'title') $new['title'] = '이름(제목)';
            elseif ($key === 'date') {
                $new['yck_rating'] = '평점';
                $new['yck_email']  = '이메일';
                $new['date']       = $label;
            } else {
                $new[$key] = $label;
            }
        }
        return $new;
    }

    public function render_admin_columns($column, $post_id) {
        if ($column === 'yck_rating') {
            $rating = intval(get_post_meta($post_id, 'yck_rating', true));
            echo esc_html($rating ? $rating . '/5' : '-');
        }
        if ($column === 'yck_email') {
            $email = get_post_meta($post_id, 'yck_reviewer_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '-';
        }
    }

    /**
     * Minimal front styles (카드 그리드 전용 스타일 포함)
     */
    public function inline_styles() {
        ?>
        <style>
            .yck-review-alert{padding:10px 12px;border-radius:8px;margin:10px 0;font-size:14px}
            .yck-success{background:#e7f9ee;border:1px solid #6bd19b; text-align: center;}
            .yck-error{background:#fff2f2;border:1px solid #ff8a8a}
            .yck-review-form{display:grid;gap:12px;max-width:600px}
            .yck-field label{display:block;font-weight:600;margin-bottom:6px}
            .yck-field input,.yck-field select,.yck-field textarea{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px}
            .yck-btn{background:#111;color:#fff;border:0;padding:10px 14px;border-radius:10px;cursor:pointer}
            .yck-pagination ul{display:flex;gap:6px;list-style:none;padding:0}
            .yck-pagination a,.yck-pagination span{display:block;padding:6px 10px;border:1px solid #ddd;border-radius:8px;text-decoration:none}
            .yck-pagination .current{background:#111;color:#fff;border-color:#111}
            .req{color:#e11}

            /* ===== 카드 레이아웃 ===== */
            .yck-reviewbox-section{
              max-width:1100px;
              margin:0 auto;
              padding:20px;
              font-family:'Noto Sans KR',system-ui,-apple-system,Segoe UI,Roboto,sans-serif;
              text-align:left !important; /* 부모쪽 중앙정렬 방지 */
            }
            .yck-reviewbox-grid{
              display:grid;
              grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
              gap:20px;
              text-align:left !important;
            }
            .yck-reviewbox-card{
              background:#fff;
              border:1px solid #ddd;
              border-radius:12px;
              padding:12px 16px 16px; /* 상단 최소 여백 */
              box-shadow:0 2px 8px rgba(0,0,0,.05);
              display:flex;
              flex-direction:column;
              align-items:stretch;
              height:100%;
              text-align:left !important;
            }
            .yck-reviewbox-header{ margin-bottom:0; }
            .yck-reviewbox-name{
              font-weight:700;
              font-size:18px;
              color:#333;
              margin:0 0 2px;
            }
            .yck-reviewbox-stars-date{
              display:flex;
              align-items:center;
              gap:8px;
              font-size:14px;
              color:#777;
              margin:0;
            }
            .yck-reviewbox-stars{
              color:#f5a623;
              display:flex;
              align-items:center;
              line-height:1;
            }
            .yck-reviewbox-text{
              margin-top:10px;
              font-size:14px;
              color:#444;
              line-height:1.6;
              flex-grow:1;
              white-space:pre-line;;
              overflow-wrap:anywhere;
              word-break:keep-all;
              text-align:left !important;
              align-self:stretch !important;
            }
            .yck-reviewbox-text a,
            .yck-reviewbox-text span,
            .yck-reviewbox-text p{
              overflow-wrap:anywhere;
              word-break:break-word;
            }
        </style>
        <?php
    }
}

new YCK_Simple_Reviews();
