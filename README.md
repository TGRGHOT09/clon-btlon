OnlineJOB - Wedsite Tuyển dụng Trực tuyến

OnlineJOB là nền tảng kết nối nhân tài và doanh nghiệp, được phát triển nhằm tối ưu hóa quy trình tuyển dụng từ khâu đăng tin, nộp hồ sơ đến quản lý ứng viên. Hệ thống đảm bảo luồng dữ liệu xuyên suốt giữa ba đối tượng trọng tâm: Quản trị viên, Nhà tuyển dụng và Ứng viên.

Kiến trúc Hệ thống (Architecture)

Dự án sử dụng mô hình MVC (Model-View-Controller) trên nền tảng Laravel Framework, đảm bảo tính bảo mật và khả năng mở rộng cao:

1. Layer Middleware & Bảo mật (Security Engine)
Hệ thống sử dụng các bộ lọc Middleware để phân quyền truy cập nghiêm ngặt:
+AdminMiddleware: Kiểm tra quyền Quản trị viên (account_type == 1) cho các tác vụ hệ thống.

+EmployerLoginMiddleware: Đảm bảo chỉ Nhà tuyển dụng (account_type == 3) mới có thể quản lý tin đăng.

+Auth Middleware: Xác thực người dùng cơ bản trước khi thực hiện các hành động ứng tuyển.
2. Layout Inheritance (Kế thừa Giao diện)
Hệ thống OnlineJOB áp dụng triệt để kiến trúc kế thừa giao diện thông qua Blade Template Engine của Laravel. Đây là giải pháp tối ưu giúp tách biệt phần khung (Template) và nội dung (Content), đảm bảo tính nhất quán của giao diện và giảm thiểu sự trùng lặp mã nguồn (DRY - Don't Repeat Yourself)
Các Module Cốt lõi & Luồng nghiệp vụ
1. 👤 Phân hệ Ứng viên (Candidate)
Quản lý Hồ sơ & CV
Khai báo thông tin cá nhân (SĐT, Địa chỉ) và tải lên file hồ sơ năng lực (CV) định dạng PDF/DOCX.

Tìm kiếm & Ứng tuyển
Xem chi tiết công việc, yêu cầu kỹ năng và gửi đơn ứng tuyển trực tuyến.

Theo dõi tiến độ
Quản lý danh sách việc làm đã nộp và theo dõi trạng thái hồ sơ (Chờ duyệt, Chấp nhận, Từ chối).

2. 🏢 Phân hệ Nhà tuyển dụng (Employer)
Quản lý Tin tuyển dụng
Thực hiện đầy đủ các thao tác Thêm, Sửa, Xóa tin tuyển dụng kèm theo định mức lương và hạn nộp.

Quản lý Ứng viên
Tiếp nhận danh sách ứng viên, xem chi tiết CV và trực tiếp phê duyệt trạng thái hồ sơ.

Thống kê tuyển dụng
Bảng Dashboard hiển thị tổng số đơn, tỷ lệ phê duyệt và đơn ứng tuyển gần đây.

3. ⚖️ Phân hệ Quản trị (Admin)
Kiểm soát Tài khoản
Theo dõi danh sách toàn bộ người dùng, xem chi tiết hồ sơ và có quyền Khóa/Mở khóa tài khoản khi có vi phạm.

Quản trị Danh mục

Quản lý danh sách các ngành nghề (Categories) và bộ kỹ năng (Skills) làm dữ liệu nền cho hệ thống.
# 📂 Cấu trúc Thư mục Dự án

```text
app/
├── Http/
│   ├── Controllers/                # Xử lý logic nghiệp vụ
│   │   ├── Admin/AdminController.php
│   │   ├── Candidate/CandidateController.php
│   │   ├── Employer/EmployerController.php
│   │   └── AuthController.php      # Quản lý đăng nhập/đăng ký
│   └── Middleware/                 # Phân quyền (Admin, Employer)
├── Models/                         # 6 Models cốt lõi
│   └── User, Profile, Category, JobPost, Skill, Application
│
resources/
├── views/                          # Hệ thống giao diện Blade
│   ├── admin/                      # Dashboard và thống kê quản trị
│   ├── auth/                       # Giao diện xác thực (Đăng nhập, Đăng ký)
│   ├── candidate/                  # Giao diện hồ sơ và việc làm của ứng viên
│   ├── employer/                   # Giao diện quản lý tin tuyển dụng của NTD
│   ├── layouts/                    # Bộ khung giao diện dùng chung (Master Layouts)
│   └── public/                     # Trang chủ & Chi tiết việc làm
│
routes/
└── web.php                         # Hệ thống điều hướng chính
│
public/
├── images/                         # onlinejob-logo.png
└── uploads/cv/                     # Kho lưu trữ CV ứng viên
💻 Công nghệ & Quy chuẩn (Technical Stack)
Framework: Laravel 8.x.

Ngôn ngữ: PHP 7.3+.

Database: MySQL (Hệ thống 6 bảng quan hệ chặt chẽ).

Frontend: Bootstrap 5, Bootstrap Icons, Google Fonts (Inter).
🔐 Luồng Phê duyệt & Phân quyền
Đăng ký & Phân loại: Người dùng đăng ký tài khoản và chọn vai trò (Ứng viên/NTD).

Chuẩn bị dữ liệu: Ứng viên phải upload CV trước khi được phép ứng tuyển.

Luồng Ứng tuyển: Người cần ứng tuyển -> Xem tin -> Đăng nhập -> Nộp đơn -> Nhà tuyển dụng duyệt -> Kết quả.

Kiểm soát hệ thống: Admin giám sát toàn bộ tài khoản và danh mục ngành nghề.
🚀 Hướng dẫn Cài đặt
Clone dự án: git clone https://github.com/ttung20044-ctrl/BTL_Online_JOB.git

Cài đặt thư viện: composer install

Cấu hình môi trường: Cấu hình database file .env và cấu hình DB_DATABASE=baitaplon.

Khởi tạo dữ liệu: Import file baitaplon.sql vào MySQL.

Chạy ứng dụng: php artisan serve
