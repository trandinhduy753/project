![Laravel](https://img.shields.io/badge/Laravel-v8.82-red)
![Vue.js](https://img.shields.io/badge/Vue.js-v3.5-green)
![Docker](https://img.shields.io/badge/Docker-Enabled-blue)

## Giới thiệu

Đây là dự án web được phát triển bằng **Laravel**, **Vue.js**, và **Docker**.  
Mục tiêu của dự án là xây dựng **một nền tảng thương mại điện tử hiện đại** cho phép người dùng **xem, mua và thanh toán sản phẩm trực tiếp hoặc online**, đồng thời cung cấp hệ thống **quản lý toàn diện cho quản trị viên**.

---

### Đối tượng sử dụng & Tính năng chính

#### Người dùng
- Duyệt, tìm kiếm và xem chi tiết sản phẩm theo danh mục hoặc từ khóa.
- Thêm vào giỏ hàng, đặt hàng và thanh toán trực tiếp hoặc online (qua cổng thanh toán).
- Theo dõi đơn hàng theo trạng thái (đang xử lý, vận chuyển, hoàn tất...).  
- Quản lý thông tin tài khoản cá nhân, địa chỉ giao hàng, và lịch sử mua hàng.
- Trò chuyện trực tiếp với người bán hoặc nhân viên hỗ trợ qua hệ thống chat real-time.
- Đánh giá và bình luận sản phẩm sau khi mua.
- Nhập và sử dụng mã giảm giá (voucher) khi thanh toán.

#### Quản trị viên (Admin)
- Quản lý người dùng: khách hàng, nhân viên, và nhà cung cấp.
- Quản lý sản phẩm: thêm, sửa, xóa, phân loại và theo dõi tồn kho.
- Xử lý và duyệt đơn hàng, cập nhật trạng thái hoặc hủy đơn hàng.
- Quản lý phiếu giảm giá, doanh thu, và sổ sách thu chi.
- Trao đổi và hỗ trợ khách hàng trực tiếp qua hệ thống chat.
- Phân quyền nhân viên theo vai trò (quản lý, nhân viên, kế toán...).
- Xem báo cáo thống kê doanh số, lượt truy cập, và hiệu quả kinh doanh theo thời gian.
- Quản lý cấu hình hệ thống, thông báo, và tùy chỉnh nội dung website.
---

### Kiến trúc hệ thống

- **Backend (Laravel):**  
  - Cung cấp RESTful API và xử lý toàn bộ logic nghiệp vụ.  
  - Tích hợp xác thực bảo mật bằng JWT.  
  - Quản lý dữ liệu bằng MySQL và Redis cache.  
  - Thiết lập hệ thống phần quyền.  
  - Hỗ trợ real-time chat qua hoặc Pusher.

- **Frontend (Vue.js 3 + Tailwind CSS):**  
  - Giao diện thân thiện, tối ưu trải nghiệm người dùng.  
  - Sử dụng Vue Router cho điều hướng trang và Pinia/Vuex để quản lý trạng thái.  
  - Kết nối API qua Axios, cập nhật dữ liệu theo thời gian thực.

- **Docker & Nginx:**  
  - Cấu hình đồng bộ môi trường phát triển (PHP-FPM, Node, MySQL, Redis, Nginx).  
  - Dễ dàng triển khai bằng `docker-compose up -d`.  

---

## Cấu trúc thư mục
```bash
project/
├── backend/ (Laravel)
│   ├── app/
│   ├── bootstrap
│   ├── config/
│   ├── database/
│   ├── modules/
│   │   ├── admin/
│   │   ├── client/
│   │   │── ModulesServiceProvider.php
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── tests/
└── frontend/ (Vue.js)
    ├── src/
    │   ├── api/
    │   ├── assets/
    │   ├── axios/
    │   ├── components/
    │   ├── composables/
    │   ├── constant/
    │   ├── layout/
    │   ├── lib/
    │   ├── plugins/
    │   ├── router/
    │   ├── store/
    │   ├── utils/
    │   ├── view
    ├── public/
    ├── vite.config.js
```

# Hướng dẫn cài đặt

Bạn có thể theo 2 cách như sau:  
1. **Cài đặt thủ công** trên môi trường máy local.  
2. **Cài đặt tự động bằng Docker**.

---
## Cách 1 – Cài đặt thủ công (Manual Setup)

### Yêu cầu môi trường
Đảm bảo máy của bạn đã cài:

- **PHP** >= 8.2  
- **Composer**  
- **Node.js** >= 18  
- **MySQL** hoặc **MariaDB**  
- **Redis** *(tùy chọn, nếu dùng cache hoặc queue)*  
- **Pusher account** *(để chat real-time)*  
- **Sepay account** *(tích hợp thanh toán)*  

---

### Các bước thực hiện

#### 1. Clone dự án
git clone https://github.com/username/project-name.git
cd project-name

#### 2. Cài đặt Backend (Laravel)
```
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret (Bạn cần phải cài JWT nhé)

Cập nhật file .env:

APP_NAME="laravel"
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:5173 # Đây là URL của frontend nhé
SESSION_DOMAIN=localhost # Domain
SANCTUM_STATEFUL_DOMAINS=localhost:5173

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
FILESYSTEM_DRIVER=local
SESSION_DRIVER=cookie
SESSION_LIFETIME=10080
MEMCACHED_HOST=127.0.0.1
```

##### Cấu hình database
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
##### Cấu hình redis
```
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_CLIENT=predis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1
```

##### Cấu hình Mail
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your_email58@gmail.com # Nhập Gmail của bạn nhé
MAIL_PASSWORD=password # Nhập Gmail của bạn nhé truy cập https://myaccount.google.com/apppasswords
MAIL_ENCRYPTION=ssl 
MAIL_FROM_ADDRESS=your_email58@gmail.com 
MAIL_FROM_NAME="${APP_NAME}"
```

##### Cấu hình Sepay
```
SEPAY_CLIENT_ID=your_client_id
SEPAY_API_KEY=your_api_key
SEPAY_BASE_URL=https://api.sepay.vn
SEPAY_SECRET=hfudga11426673 # Bạn tự tao ra một dãy mã khoá nào đó nhé
# Link: https://sepay.vn/
# 1. Ban sẽ tạo tài khoản và liên kết với ngân hàng nhá
# 2. Thiết lập tài khoản ảo
# 3. Trong backend chạy ngrok http 8000 (Vì sepay yêu cầu Htpps)
# 3. Thiết lập webhook để trả dữ liệu khi có giao dịch nhé (Lấy url sinh ra từ Ngrok nhé)

```

##### Cấu hình Pusher
```
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=ap1
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
# Link: https://pusher.com/
# 1. Ban sẽ tạo tài khoản và tạo một project (Chọn laravel và vue js nhé)
# 2. Sau khi tạo project thì các thông số sẽ tự hiện ra nhéo
# 3. Nhập các thông số tương ứng vào file env nhé

```
##### Khởi tạo cơ sở dữ liệu
```
php artisan migrate --seed 
# Hoặc php artisan migrate:refresh --seed
```

##### Chạy serve
```
php artisan serve  --host=localhost
php artisan queue:work
php artisan schedule:run
```

#### 3. Cài đặt Frontend (Vue js)
```
cd frontend
npm install
npm run dev
```

#### 4. Truy cập vào wensite
```
Frontend: http://localhost:5173
Backend API: http://localhost:8000
```


## Cách 2 – Cài đặt bằng Docker (Docker Setup)
### Yêu cầu môi trường
Đảm bảo máy của bạn đã cài:

- **Docker Desktop hoặc Docker Engine**
- **Docker Compose**  

---

### Các bước thực hiện

#### 1. Clone dự án về máy của bạn
```
git clone https://github.com/username/project-name.git
cd project-name
```

#### 2. Tạo file môi trường
```
cd backend
cp .env.example .env

# Cập nhật file .env tương tự như phần thủ công (bao gồm Sepay và Pusher).
```

#### 3. Chạy Docker
```
cd ..
docker-compose up -d --build
```

#### 4. Chạy migration và seed dữ liệu
```
docker exec -it laravel-backend bash
php artisan migrate:refresh --seed
php artisan queue:work
php artisan schedule:run
exit
```

5. Truy cập website
```
Frontend: http://localhost:5173
Backend API: http://localhost
```

---

## Ghi chú
- Đây là dự án **demo thương mại điện tử** với chức năng đầy đủ cho người dùng và admin.  
- Mục tiêu chính là **học tập, thực hành Laravel, Vue.js, Docker, Pusher, Sepay**.  
- Nếu triển khai production, cần **cấu hình bảo mật**, SSL, và SMTP thật.  
- Các thông tin nhạy cảm (API keys, mật khẩu) **không commit lên GitHub**, luôn dùng `.env`.

---

## Tác giả
- **Tên:** Nguyễn Trần Cường
- **Email:** nguyentrancuong58@gmail.com
- **Phone:** 0988870434

