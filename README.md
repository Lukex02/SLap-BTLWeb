# S LAP

## Cách sử dụng database MySQL trên XAMPP

### Load data .sql

File database của web được lưu trong folder data với 2 hình thức là folder slap hoặc file slap\_<ngày>.sql

Để sử dụng thì có 2 cách

1. Cách 1: Thêm folder data slap vào folder data của mysql

   - Mở XAMPP
   - Mục MySQL bấm "Config" -> "<Browse>" -> /data
   - Copy folder `slap` trong `/data/` vào thư mục trên (`/xampp/mysql/data`)
   -

2. Cách 2: Import database vào MySQL

   - Mở XAMPP
   - Truy cập link `localhost/phpMyAdmin`
   - Import database dưới dạng file .sql theo hướng dẫn trên giao diện
