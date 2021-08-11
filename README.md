
## Trang mạng xã hội (instagram)

Đây là website giúp mọi người có thể chia sẻ những khoảnh khắc ,giúp kết nối mọi người lại với nhau thông qua tương tác trên các bài viết .
## Công nghệ   
- Laravel
- Jquery
- Ajax
- Boostrap
- HTML
- CSS
### Cài đặt 
+ Tải xuống bằng cmd : https://github.com/satosis/instagram.git
+ Cài đặt bằng cmd :
- composer install
- npm install 
- copy .env.example .env
- php artisan migrate
- php artisan db:seed
- php artisan serve
- Truy cập website :localhost:8000
### Chức năng chính
+ Trang đăng nhập dành cho người dùng
    - Đăng nhập 
    - Đăng nhập bằng google , facebook
    - Đăng ký ( email , số điện thoại)
    - Xác thực email , số điện thoại đã đăng ký
    - Quên mật khẩu ( gửi email cho người dùng để người dùng đặt lại mật khẩu)
+ Trang chủ dành cho người dùng
    - Theo dõi người dùng khác
    - Thay đổi ngôn ngữ ( Tiếng Anh ,Tiếng Việt )
    - Nếu người dùng theo dõi người dùng có bài viết thì khi refresh lại sẽ hiện bài viết lên trang chủ 
    - Bình luận , yêu thích bài viết
    - Tăng theo dõi bài viết (tự động)
    - Thông báo sẽ hiện khi có người khác bình luận bài viết của người dùng
+ Trang cá nhân
    - Thay đổi avatar
    - Xóa avatar
    - Thống kê số bài viết cá nhân , số người theo dõi , số người đang theo dõi
    - Người dùng có thể theo dõi hoặc hủy theo dõi người dùng khác trực tiếp trên 2 dòng thống kê
    - Đăng tải ảnh 
    - Bình luận , yêu thích bài viết
    - Tăng theo dõi bài viết (tự động)
+ Trang cá nhân của người khác 
    - Người dùng có thể theo dõi hoặc hủy theo dõi trên trang cá nhân
    - Khi theo dõi sẽ hiện link để có thể nhắn tin với người khác
+ Trang chat 
    - Có thể chat ,hiện online bằng cơ chế realtime
    - Tạo group chat với nhiều người khác nhau
    - Tìm kiếm người dùng để tạo nhóm chat
    - Gọi video 1-1
+ Trang chỉnh sửa thông tin
    - Thay đổi thông tin cá nhân ,avatar
    - Thay đổi giới tính trực tiếp bằng ajax
    - Thay đổi mật khẩu
+ Trang admin (http://localhost:8000/api-admin)
Nếu chưa đăng nhập sẽ không vào được trang admin
    - Nếu không có quyền thì chỉ xem và không thể thêm sửa xóa 
    - Đăng nhập (http://localhost:8000/admin-auth/login)
    - Đăng ký (http://localhost:8000/admin-auth/register)
+ Quản lý admin  ,người dùng ,  quyền hạn chung phân quyền
+ Video mô tả website : 
    - https://www.youtube.com/watch?v=-VgQRsKR03I
## Thành viên
- Nguyễn Hùng (https://github.com/satosis)
## Liên hệ
Facebook : https://www.facebook.com/profile.php?id=100024184182069
Linkedin : https://www.linkedin.com/in/satosis-h%C3%B9ng-1924611a7/
