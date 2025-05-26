<?php
/**
 * Plugin Name: YCK HTML Form
 * Description: 사용자 정보를 입력하는 커스텀 폼을 숏코드로 추가합니다.
 * Version: 1.0
 * Author: April
 */

function yck_insert_custom_form() {
    ob_start();
    ?>
<style>

    .woocommerce div.product form.cart table td {
        padding-left: 12px !important;
    }

  .form-wrapper {
    font-family: 'Noto Sans KR', sans-serif;
    font-size: 16px;
    color: #333;
    max-width: 1000px;
    padding: 0 ;
    margin: 0 auto;
    width: 100%;

  }

  .form-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
    margin-top: 50px;
  }
  
  .form-title-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.form-check {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 0;
}

.form-check-left {
  display: flex;
  align-items: center;
  gap: 10px;
}

.form-check-right {
  font-size: 14px;
  color: #333;
}
.form-required-note {
  font-size: 14px;
  color: #333;
}
  .form-check input {
    margin-right: 10px;
  }

  table.custom-form-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
  }

    table.custom-form-table th {
      width: 180px;
      background-color: #f8f8f8 ;
      text-align: left;
      font-weight: 600;
      line-height: 1.4;
      padding: 12px 12px 12px 24px;
      text-indent: -15px;
      border: 1px solid #ccc;
      border-left: none; 
    }

table.custom-form-table td {
  border-top: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
  border-left: 1px solid #ccc;
  border-right: none; 
  padding: 12px 12px 12px 12px; 
  vertical-align: top;
}
  
    table.custom-form-table td > * {
      width: 100%;
      box-sizing: border-box;
    }

    .required {
      color: #1B2D6B;
      margin-right: 4px;
    }

    .form-note {
      font-size: 13px;
      color: #666;
      margin-top: 6px;
    }

    .name-inputs {
      display: flex;
      gap: 10px;
      width: 100%;
    }

    .name-inputs input {
      flex: 1;
      min-width: 0;
    padding: 10px !important;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 2px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 2px;
      box-sizing: border-box;
    }
    
            .elementor-widget-raven-product-add-to-cart .raven-product-add-to-cart select {
            display: block !important;
        }
        .personal-info .form-title {
  margin-top: 0;
}
</style>


    <div class="form-wrapper">
<div class="form-section personal-info">
  <div class="form-title">개인정보 입력</div>
</div>        <div class="form-check">
            <div class="form-check-left">
                <input type="checkbox" id="ageCheck" required>
                <label for="ageCheck">만 14세 이상만 예약하실 수 있습니다. 만 14세 이상이십니까?</label>
            </div>
            <div class="form-check-right">
                <span class="required">•</span> 필수 입력 항목입니다.
            </div>
        </div>

        <table class="custom-form-table">
            <tr>
                <th><span class="required">•</span> 이름</th>
                <td>
                    <div class="name-inputs">
                        <input type="text" name="Lastname" placeholder="Last name" required />
                        <input type="text" name="Firstname" placeholder="First name" required />
                    </div>
                    <div class="form-note">* 여권에 기재된 영문 이름을 입력해 주세요.</div>
                </td>
            </tr>
            <tr>
                <th><span class="required">•</span> 국적</th>
                <td><input type="text" name="nationality" placeholder="국적 입력 (예: 대한민국)" required />
                    <div class="form-note">* 외국인 전용 상품입니다.</div>
                </td>
            </tr>
            <tr>
                <th><span class="required">•</span> 이메일</th>
                <td>
                    <input type="email" name="email" placeholder="example@example.com" required />
                    <div class="form-note">* 메일로 예약 내역이 발송됩니다.</div>
                </td>
            </tr>
            <tr>
                <th><span class="required">•</span> 연락처</th>
                <td><input type="tel" name="phone" placeholder="연락처 입력" required /></td>
            </tr>
            <tr>
                <th><span class="required">•</span> 여권 번호</th>
                <td><input type="text" name="passport_number" placeholder="여권 번호 입력" required /></td>
            </tr>
        </table>

        <div class="form-title">모바일 정보</div>
        <table class="custom-form-table">
            <tr>
                <th><span class="required">•</span> 통신사</th>
                <td><input type="text" name="mobilecarrier" placeholder="통신사 입력 (예: visible)" /></td>
            </tr>
            <tr>
                <th><span class="required">•</span> 핸드폰 기종</th>
                <td><input type="text" name="mobilemodelname" placeholder="기종 입력 (예: iPhone 16)" /></td>
            </tr>
        </table>

        <div class="form-title">공항정보</div>
        <table class="custom-form-table">
            <tr>
                <th><span class="required">•</span> 한국 도착일</th>
                <td><input type="date" name="arrival_date" /></td>
            </tr>
            <tr>
                <th><span class="required">•</span> 도착 공항</th>
                <td>
                    <select name="arrival_terminal">
                        <option value="" disabled selected>도착 터미널 선택</option>
                        <option value="terminal1">인천공항 제1터미널</option>
                        <option value="terminal2">인천공항 제2터미널</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('my_custom_php_section', 'yck_insert_custom_form');

add_action('woocommerce_before_add_to_cart_button', function() {
    echo do_shortcode('[my_custom_php_section]');
});
add_filter('woocommerce_add_cart_item_data', 'yck_add_form_data_to_cart', 10, 2);
function yck_add_form_data_to_cart($cart_item_data, $product_id) {
    $fields = [
        'Firstname', 'Lastname', 'nationality', 'email', 'phone',
        'passport_number', 'mobilecarrier', 'mobilemodelname',
        'arrival_date', 'arrival_terminal'
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $cart_item_data[$field] = sanitize_text_field($_POST[$field]);
        }
    }

    return $cart_item_data;
}

add_filter('woocommerce_get_item_data', 'yck_show_custom_data_in_cart', 10, 2);
function yck_show_custom_data_in_cart($item_data, $cart_item) {
    $labels = [
        'Firstname' => '이름',
        'Lastname' => '성',
        'nationality' => '국적',
        'email' => '이메일',
        'phone' => '연락처',
        'passport_number' => '여권 번호',
        'mobilecarrier' => '통신사',
        'mobilemodelname' => '기종',
        'arrival_date' => '도착일',
        'arrival_terminal' => '도착 공항'
    ];

    foreach ($labels as $key => $label) {
        if (!empty($cart_item[$key])) {
            $item_data[] = [
                'key'   => $label,
                'value' => wc_clean($cart_item[$key]),
                'display' => ''
            ];
        }
    }

    return $item_data;
}


