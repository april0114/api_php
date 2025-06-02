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
    
    label[for="ageCheck"] {
    display: inline-block;
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
                <span class="required">*</span> 필수 입력 항목입니다.
            </div>
        </div>

        <table class="custom-form-table">
            <tr>
                <th>이름<span class="required">*</span></th>
                <td>
<div class="name-inputs">
    <input type="text" name="Lastname" placeholder="Last name" required style="text-transform: uppercase;" />
    <input type="text" name="Firstname" placeholder="First name" required style="text-transform: uppercase;" />
</div>
                    <div class="form-note">*여권에 기재된 영문과 동일하게 대문자로 입력해 주세요</div>
                </td>
            </tr>
            <tr>
                <th>국적<span class="required">*</span></th>
                <td><input type="text" name="nationality" placeholder="Republic of Korea"  required />
                    <div class="form-note">*여권에 기재된 국적을 선택해 주세요</div>
                </td>
            </tr>
                        <tr>
                <th>여권 번호<span class="required">*</span></th>
                <td><input type="text" name="passport_number" placeholder="M12345678" required />
                <div class="form-note">*만약 제출된 이름/국적/여권 번호가 실제 여권과 다른 경우 심카드가 제공되지 않습니다</div>
</td>
            </tr>
            <tr>
                <th>이메일<span class="required">*</span></th>
                <td>
                    <input type="email" name="email" placeholder="example@example.com" required />
                    <div class="form-note">*QR 코드 또는 바우처(주문번호)을 받을 수 있는 이메일 주소를 정확하게 입력해 주세요</div>
                </td>
            </tr>
<tr>
  <th>휴대폰 번호<span class="required">*</span></th>
  <td>
    <input
      type="tel"
      name="phone"
      placeholder="2136495777"
      required
      pattern="\d{10}"
      maxlength="10"
      inputmode="numeric"
      oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
    />
    <div class="form-note">
      *미국 휴대폰 전화번호 10자리(3자리 지역코드를 포함)을 숫자만 입력해 주세요
    </div>
  </td>
</tr>

        </table>

        <div class="form-title">모바일 정보</div>
<table class="custom-form-table">
    <tr>
        <th>서비스 사업자<span class="required">*</span></th>
        <td><input type="text" name="mobilecarrier" placeholder="Verizon, AT&T, Tmobile" required /></td>
    </tr>
    <tr>
        <th>휴대폰 모델<span class="required">*</span></th>
        <td><input type="text" name="mobilemodelname" placeholder="iPhone 16, Samsung S25" required />
            <div class="form-note">*미국에서 출시된 아이폰 14 시리즈 이상은 eSIM만 이용 가능합니다
    </div></td>
    </tr>
</table>

<div class="form-title">입국 정보</div>
<table class="custom-form-table">
    <tr>
        <th>한국 도착일<span class="required">*</span>
</th>
        <td><input type="date" name="arrival_date" required min="<?= date('Y-m-d') ?>"/>
                <div class="form-note">*한국 날짜 기준으로 입력해 주세요</div>
        </td>
    </tr>
    <tr>
        <th>도착 공항<span class="required">*</span>
        </th>
        <td>
            <select name="arrival_terminal" required>
                <option value="" disabled selected>도착 터미널 선택</option>
                <option value="Incheon International Airport Terminal 1 (1st floor)">Incheon International Airport Terminal 1 (1st floor)</option>
                <option value="Incheon International Airport Terminal 2 (1st floor)">Incheon International Airport Terminal 2 (1st floor)</option>
                <option value="Gimpo International Airport">Gimpo International Airport</option>
                <option value="Gimhae International Airport">Gimhae International Airport</option>
                <option value="Jeju International Airport">Jeju International Airport</option>
                <option value="Busan Harbor">Busan Harbor</option>
                <option value="Daegu Airport">Daegu Airport</option>

            </select>
                    <div class="form-note">* 심카드 픽업 / 여권 확인 / 충전 / 도착 공항을 선택해 주세요</div>

        </td>
    </tr>
</table>
</div>
<style>
    table.custom-form-table th span.required {
    display: inline !important;
    }

    span.required{
    display: inline !important;
    }
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const buyNowBtn = document.getElementById("buy-now-button");
  const customAgreeAll = document.getElementById("customAgreeAll");
  const customSubAgrees = document.querySelectorAll(".custom-sub-agree");

  document.querySelectorAll("input[name='Firstname'], input[name='Lastname']").forEach(function (input) {
    input.addEventListener("input", function () {
      this.value = this.value.toUpperCase();

  if (!buyNowBtn) return;

  // 전체 동의 → 하위 체크박스 반영
  if (customAgreeAll) {
    customAgreeAll.addEventListener("change", function () {
      customSubAgrees.forEach(cb => cb.checked = this.checked);
    });
  }

  // 하위 체크 → 전체 동의 상태 반영
  customSubAgrees.forEach(cb => {
    cb.addEventListener("change", () => {
      const allChecked = [...customSubAgrees].every(c => c.checked);
      customAgreeAll.checked = allChecked;
    });
  });

  // Buy Now 버튼 클릭 시 유효성 검사 실행
  buyNowBtn.addEventListener("click", function (e) {
    e.preventDefault(); // ✅ 무조건 이동 방지

    let isValid = true;
    const unchecked = [];
    const emptyFields = [];

    // 체크 안된 항목 찾기
    customSubAgrees.forEach(cb => {
      if (!cb.checked) {
        cb.parentElement.style.outline = '2px solid red';
        cb.parentElement.classList.add('shake');
        unchecked.push(cb);
        isValid = false;
      } else {
        cb.parentElement.style.outline = '';
        cb.parentElement.classList.remove('shake');
      }
    });

    // 필수 input/select/checkbox 유효성 검사
    const requiredInputs = document.querySelectorAll('input[required], select[required], textarea[required]');
    requiredInputs.forEach(input => {
      const isEmpty = (input.type === 'checkbox') ? !input.checked : !input.value.trim();
      if (isEmpty) {
        input.style.outline = '2px solid red';
        input.classList.add('shake');
        emptyFields.push(input);
        isValid = false;
      } else {
        input.style.outline = '';
        input.classList.remove('shake');
      }
    });

    // 에러 발생 시 스크롤, 포커스, shake 복구
    if (!isValid) {
      const firstInvalid = [...unchecked, ...emptyFields][0];
      if (firstInvalid) {
        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstInvalid.focus();
      }

      setTimeout(() => {
        [...unchecked, ...emptyFields].forEach(el => {
          el.style.outline = '';
          el.classList.remove('shake');
        });
      }, 3000);

      return;
    }

    // ✅ 유효성 검사 통과한 경우 WooCommerce의 add-to-cart 버튼을 클릭시킴
    const realAddToCartBtn = document.querySelector('form.cart button[name="add-to-cart"]');
    if (realAddToCartBtn) {
      realAddToCartBtn.click();
    }
  });
});
</script>

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

add_action('woocommerce_checkout_create_order_line_item', 'yck_save_custom_data_to_order_items', 10, 4);
function yck_save_custom_data_to_order_items($item, $cart_item_key, $values, $order) {
    $fields = [
        'Firstname', 'Lastname', 'nationality', 'email', 'phone',
        'passport_number', 'mobilecarrier', 'mobilemodelname',
        'arrival_date', 'arrival_terminal'
    ];

    foreach ($fields as $field) {
        if (!empty($values[$field])) {
            $item->add_meta_data($field, $values[$field], true);
        }
    }
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


