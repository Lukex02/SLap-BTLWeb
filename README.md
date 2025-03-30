# S LAP

## Cách sử dụng database MySQL trên XAMPP

### Load data .sql

File database của web được lưu trong folder data với 2 hình thức là folder slap hoặc file slap\_<ngày>.sql

Để sử dụng thì có 2 cách

1. Cách 1: Thêm đường dẫn thẳng vào folder slap

   - Mở XAMPP
   - Mục MySQL bấm "Config" -> "my.ini"
   - Tìm dòng `datadir=...` thay đường dẫn vào folder database

2. Cách 2: Import database vào MySQL

   - Mở XAMPP
   - Truy cập link `localhost/phpMyAdmin`
   - Import database dưới dạng file .sql theo hướng dẫn trên giao diện

   * Cách này sẽ tạo 1 folder database khác ở trong /xampp/mysql/data ở trong máy local của mỗi người cài XAMPP, sẽ không thể tự động sync data với data mới mà mọi người up lên GitHub nếu như có thay đổi, vì vậy nếu ai đó thay đổi database của mình thì nhớ export data dưới dạng folder hoặc .sql để mọi người có thể load data giống nhau vào folder data
