# api_php

---------------------------

<div align="center">
  <h1>Y CONNECT KOREA - 백엔드 자동화 시스템</h1>
  <p><i>WordPress + PHP 기반의 주문 처리 & 이메일 자동화 + 운영 관리 시스템</i></p>
</div>

---

## 🚀 프로젝트 개요

> ✅ 외주 개발 프로젝트 | 🧩 운영 중인 실 서비스  
> 💼 [yconnectkorea.com](http://yconnectkorea.com)에서 **WooCommerce 결제 완료 시**  
> → 사용자 데이터를 수집  
> → 외부 eSIM API로 전송  
> → **언어별 이메일 바우처 자동 발송**  
> → **운영 편의성 기능(에러 로그 뷰어, 자동 초기화)** 까지 포함된 **End-to-End 백엔드 시스템**을 개발했습니다.

---

## 🛠 기술 스택

| 기술         | 설명                                  |
|--------------|---------------------------------------|
| **PHP**      | 핵심 백엔드 로직 처리                 |
| **WordPress**| CMS 및 WooCommerce 기반 결제 처리     |
| **WooCommerce Hooks** | 주문 완료 후 자동 API 연동 처리 |
| **PHPMailer**| 이메일 전송 (HTML 바우처 포함)         |
| **cFileManager** | 서버 파일 관리 및 이메일 템플릿 분리 |
| **Custom API**| 외부 eSIM API와 JSON 기반 통신       |
| **Custom Cron + Log Viewer** | 에러 로그 자동화 관리 및 브라우저 기반 뷰어 구현 |

---

## ⚙️ 주요 기능

### ✅ 주문 자동 처리 프로세스

1. WooCommerce 주문 완료 시 Hook 실행
2. 사용자 입력 데이터 수집
3. 외부 eSIM API로 POST 전송
4. 결과 수신 후 언어별 HTML 이메일 템플릿 자동 발송 (eSIM 바우처 포함)

### ✅ 이메일 발송

- **다국어 지원** (영문/국문)
- HTML 기반 템플릿
- 주문 정보 기반 커스터마이징

### ✅ 에러 로깅

- 커스텀 에러 로깅 (`/home/yckoreadomain/public_html/error_log`)
- API 실패 및 이메일 실패 시 자동 기록

### ✅ 에러 로그 뷰어

- 브라우저 기반 Log Viewer (`log_viewer.php`)
- **역순 출력 (최근 에러 우선)**
- 새로고침 버튼 포함
- 최대 출력 줄 수 설정 가능

### ✅ 에러 로그 자동 초기화

- cPanel Cron Job 설정
- **90일마다 error_log 자동 초기화**
- 운영 관리 편의성 확보

---

## 💎 배운 점 / 개발 포인트

- WooCommerce Hooks를 활용한 자동화 구현 경험
- 외부 API 통신 시 에러 핸들링 및 로깅 전략 구성
- 다국어 이메일 템플릿 설계 및 동적 데이터 주입
- Cron Job을 통한 자동 운영 관리 기능 구축

---

## 🔗 서비스 링크

👉 [yconnectkorea.com](http://yconnectkorea.com) (운영 중)

---
## 🎯 Git Convention

- 🎉 **Start:** Start New Project [:tada]
- ✨ **Feat:** 새로운 기능을 추가 [:sparkles]
- 🐛 **Fix:** 버그 수정 [:bug]
- 🎨 **Design:** CSS 등 사용자 UI 디자인 변경 [:art]
- ♻️ **Refactor:** 코드 리팩토링 [:recycle]
- 🔧 **Settings:** Changing configuration files [:wrench]
- 🗃️ **Comment:** 필요한 주석 추가 및 변경 [:card_file_box]
- ➕ **Dependency/Plugin:** Add a dependency/plugin [:heavy_plus_sign]
- 📝 **Docs:** 문서 수정 [:memo]
- 🔀 **Merge:** Merge branches [:twisted_rightwards_arrows:]
- 🚀 **Deploy:** Deploying stuff [:rocket]
- 🚚 **Rename:** 파일 혹은 폴더명을 수정하거나 옮기는 작업만인 경우 [:truck]
- 🔥 **Remove:** 파일을 삭제하는 작업만 수행한 경우 [:fire]
- ⏪️ **Revert:** 전 버전으로 롤백 [:rewind]

