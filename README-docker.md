## Lưu Ý: 
- Nếu máy 95 độ khi chạy docker, check task manager có đang chạy vmmem ko, nếu có đừng WSL
- Tham khảo: https://superuser.com/questions/1645056/how-can-i-stop-vmmem-process

##  Hướng dẫn sử dụng docker:
### Xoá docker cũ: 
```
docker image prune -a -f
```

### Chạy docker compose build Dockerfile
```
docker-compose build
```

### Chạy các gói service 
```
docker-compose up -d
```

### Chạy composer 
- khởi động lại container để thoát các port chiếm dụng
```
docker restart Laravel-App
docker exec Laravel-App php artisan serve --host=0.0.0.0 --port=8000 
```
- --port=8000 start trên :8000 nhưng tại service Laravel-App trong file docker-compose.yml forward :81
- --host=0.0.0.0 lắng nghe tất cả các port bên ngoài vào

### Chạy cấu lệnh trong terminal của container docker
- Docker giống một hệ điều hành thu nhỏ nên cũng có terminal
- Cách chạy terminal: 
```
docker exec -it [service-name/container-name] bash
```

### Kết nối laravel tới mysql của docker
- Cách 1 (trường hợp ip ko thay đổi):
    - Vào CMD chay ipconfig lấy [ipv4]
    - DB_HOST=[ipv4] => được lấy từ ip máy chủ của laptop (127.0.0.0 hay localhost sẽ ko kết nối được)
    - Tham khảo: https://laracasts.com/discuss/channels/laravel/dock-laravel-sqlstatehy000-2002-connection-refused
- Cách 2 (trường hợp ip thay đổi):
    - DB_HOST=[tên-service] => thường tên của service là mysql
    - DB_PORT=3306 => port được cấu hình trong docker, ko phải port forward ra bên ngoài

### Lỗi failed to solve: archive/tar: unknown file mode ?rwxr-xr-x:
- Tạo file .dockerignore 
- Bỏ **/node_modules/ vào để loại khỏi quá trình chạy file

##  Cài đặt các Package
### tailwindcss:
- cài đặt node mới nhất (16 sẽ bị lỗi: TypeError: crypto$2.getRandomValues is not a function)
```
docker exec -it Laravel-App bash
npm install -D tailwindcss@3 postcss autoprefixer
npx tailwindcss init -p
```
- Cấu hình file:
    + ./Laravel-Learning/tailwind.config.js
    + ./Laravel-Learning/resources/css/app.css
- Start lại service
- Add các file để hệ thống tự generate các file trong Laravel-Learning/vite.config.js (plugins.laravel.input)
- Chạy các lệnh trong bash:
```
npm run build
npm run dev
```