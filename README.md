# 📚 Bookstore Order CRM

## 1. Giới thiệu

Bookstore Order CRM là một ứng dụng web được xây dựng bằng **PHP thuần (Pure PHP)** theo mô hình **MVC (Model - View - Controller)** nhằm quản lý khách hàng và đơn đặt sách.

Hệ thống hỗ trợ:

- Đăng nhập / Đăng xuất
- Dashboard thống kê
- Quản lý khách hàng (Customer)
- Quản lý đơn đặt sách (Book Order)
- Tìm kiếm, phân trang và sắp xếp dữ liệu
- Bảo mật Session
- Chống trùng mã đơn hàng
- Kiến trúc Repository + Service

---

# 2. Công nghệ sử dụng

- PHP 8.x
- MySQL
- Tailwind
- HTML5
- CSS3
- PDO
- MVC Architecture
- Repository Pattern
- Service Layer

---

# 3. Cấu trúc thư mục

```
BookstoreOrderCRM/
│
├── app/
│   ├── Controllers/
│   ├── Services/
│   ├── Repositories/
│   ├── Core/
│   └── Views/
│       ├── home/index.php
│       ├── auth/login.php
│       ├── layouts/main.php
│       ├── partials/nav.php, flash.php
│       ├── dashboard/index.php
│       ├── customers/index.php, create.php, edit.php
│       ├── book_orders/index.php, create.php, edit.php
│       └── errors/404.php, 405.php, 500.php
│
├── config/
│
├── database/
│   ├── database.sql
│   └── seed.sql
│
├── public/
│   └── index.php
│
├── storage/
│
├── composer.json
│
├── .gitignore
│
└── README.md
```

---

# 4. Kiến trúc hệ thống

```
Browser

↓

public/index.php

↓

Router

↓

Controller

↓

Service

↓

Repository

↓

MySQL

↓

View
```

Hệ thống áp dụng mô hình MVC nhằm tách biệt:

- Controller xử lý request
- Service xử lý nghiệp vụ
- Repository thao tác Database
- View chỉ hiển thị giao diện

---

# 5. Chức năng

## Authentication

- Login
- Logout
- Session Authentication
- Session Timeout
- Session Regenerate ID
- Cookie Security
- Flash Message

---

## Dashboard

Hiển thị

- Tổng số khách hàng
- Tổng số đơn hàng
- Tổng doanh thu
- Đơn hàng gần đây

---

## Customer Management

- Danh sách khách hàng
- Thêm khách hàng
- Cập nhật khách hàng
- Xóa khách hàng
- Tìm kiếm
- Phân trang
- Sắp xếp

---

## Book Order Management

- Danh sách đơn hàng
- Thêm đơn hàng
- Chỉnh sửa
- Xóa
- Tìm kiếm
- Phân trang
- Sort
- Mã đơn hàng không trùng

---

# 6. Database

Hệ thống gồm 3 bảng chính

## users

| Column | Type |
|---------|------|
| id | INT |
| name | VARCHAR |
| email | VARCHAR UNIQUE |
| password | VARCHAR |
| created_at | TIMESTAMP |

---

## customers

| Column | Type |
|---------|------|
| id | INT |
| name | VARCHAR |
| email | VARCHAR UNIQUE |
| phone | VARCHAR |
| address | TEXT |
| created_at | TIMESTAMP |

---

## book_orders

| Column | Type |
|---------|------|
| id | INT |
| order_code | VARCHAR UNIQUE |
| customer_id | INT |
| book_title | VARCHAR |
| quantity | INT |
| unit_price | DECIMAL |
| total_amount | DECIMAL |
| status | VARCHAR |
| created_at | TIMESTAMP |

---

# 7. Bảo mật

Ứng dụng áp dụng các kỹ thuật bảo mật sau

✅ Prepared Statements

✅ PDO

✅ Session Authentication

✅ Session Regenerate ID

✅ Session Timeout

✅ Cookie Flags

- HttpOnly
- SameSite
- Secure (HTTPS)

✅ PRG Pattern

(Post Redirect Get)

✅ Honeypot

✅ Rate Limit theo Session

✅ Unique Constraint

- Email
- Order Code

✅ Duplicate Exception

Hiển thị thông báo thân thiện thay vì SQLSTATE.

---

# 8. Search - Pagination - Sort

Hệ thống hỗ trợ

### Search

- Customer Name
- Email
- Phone
- Order Code
- Book Title

---

### Pagination

- LIMIT
- OFFSET

---

### Sort

Whitelist

```
id
name
email
created_at
status
```

Direction

```
ASC
DESC
```

---

# 9. Error Handling

Hệ thống hỗ trợ

- 404 Not Found
- 405 Method Not Allowed
- 500 Internal Server Error

Production không hiển thị

- SQLSTATE
- Stack Trace
- File Path
- Table Name

---

# 10. EXPLAIN

Sử dụng

```
EXPLAIN
```

để kiểm tra

- Customer List Query
- Customer Search Query
- Book Order List Query
- Book Order Join Query

Đảm bảo các truy vấn sử dụng Index phù hợp.

---

# 11. Route List

## Home

| Method | Route |
|---------|------|
| GET | / |

---

## Authentication

| Method | Route |
|---------|------|
| GET | /login |
| POST | /login |
| POST | /logout |

---

## Dashboard

| Method | Route |
|---------|------|
| GET | /dashboard |

---

## Customer

| Method | Route |
|---------|------|
| GET | /customers |
| GET | /customers/create |
| POST | /customers |
| GET | /customers/edit |
| POST | /customers/update |
| POST | /customers/delete |

---

## Book Order

| Method | Route |
|---------|------|
| GET | /book-orders |
| GET | /book-orders/create |
| POST | /book-orders |
| GET | /book-orders/edit |
| POST | /book-orders/update |
| POST | /book-orders/delete |

---

# 12. Cài đặt

Clone project

```bash
git clone https://github.com/your-name/BookstoreOrderCRM.git
```

Di chuyển vào project

```bash
cd BookstoreOrderCRM
```

Import database

```
database/database.sql
```

Import dữ liệu mẫu

```
database/seed.sql
```

Cập nhật thông tin kết nối Database

```
config/database.php
```

Chạy project

```bash
php -S localhost:8000 -t public
```

Mở trình duyệt

```
http://localhost:8000
```

---

# 13. Demo Account

Email

```
admin@example.com
```

Password

```
123456
```

---

# 14. Test Cases

| Test | Expected Result |
|------|----------------|
| Login đúng | Thành công |
| Login sai | Flash Error |
| Logout | Thành công |
| Session Timeout | Quay về Login |
| Duplicate Email | Báo lỗi |
| Duplicate Order Code | Báo lỗi |
| Search Customer | Thành công |
| Search Order | Thành công |
| Pagination | Chính xác |
| Sort ASC | Chính xác |
| Sort DESC | Chính xác |
| Honeypot | Reject |
| Rate Limit | Reject |
| 404 | Hiển thị trang 404 |
| 405 | Hiển thị trang 405 |
| 500 | Hiển thị trang 500 |

---


# 16. Tác giả

**Nguyễn Minh Trường**

Final Project

Bookstore Order CRM

Pure PHP MVC