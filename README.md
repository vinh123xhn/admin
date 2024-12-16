## Hướng dẫn triển khai

- Yêu cầu hỗ trợ php7.4 trở lên và composer
- Clone project về (Có thể download file zip hoặc sử dụng git clone).
- CD đến thư mục project chạy lệnh: composer dump-autoload -o
- Mở file .env tiến thành chỉnh sửa các biến môi trường như: 
  - APP_ENV => production
  - APP_DEBUG => false
  - APP_URL => https://domain.xxx
- Cấu hình kết nối với csdl mariadb hoặc mysql:
  - DB_HOST => Host address
  - DB_PORT => Port kết nối (Mặc định 3306)
  - DB_DATABASE => Tên csdl
  - DB_USERNAME => Tên đăng nhập
  - DB_PASSWORD => Mật khẩu
- Import csdl mẫu sử dụng file: ./tldsxq_lc_rank.sql
- Chạy task schedule "php artisan schedule:run" với tuần suất 1 tiếng / 1 lần
- Lưu ý "php" trong lệnh trên là path đến php cli

