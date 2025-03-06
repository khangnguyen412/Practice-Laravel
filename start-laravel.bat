:: Vào đường dẫn
cd .\Laravel-Learning\

:: Xoá các img cũ (chỉ lần cài đặt đầu tiên)
:: không nên chạy system prune nếu còn những lưu container khác
docker system prune -a -f 
docker image prune -a -f

:: Chạy docker-compose (chỉ lần cài đặt đầu tiên)
docker compose up -d

:: Cài composer (chỉ lần cài đặt đầu tiên)
docker exec Laravel-App composer install

:: Chạy migrate cho source (chỉ lần cài đặt đầu tiên, cấu hình file .env trước khi chạy, nếu muốn tạo ra các bảng cần thiết)
:: docker-compose exec app php artisan migrate

:: Khởi động project
docker restart Laravel-App
:: docker restart Laravel-Webserver
docker exec Laravel-App php artisan serve --host=0.0.0.0 --port=8000
