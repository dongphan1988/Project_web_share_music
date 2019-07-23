Sau khi clone dự án về thì làm theo những bước sau để có dự án hoàn chỉnh.
# Cấu hình cài docker
1. Vào project clone laradock về máy:
    $ git clone https://github.com/Laradock/laradock.git
2.  Terminal cd laradock trong project
    $ cd laradock
3.  $ cp env-example .env
4.  $ sudo docker-compose up -d nginx mysql phpmyadmin workspace
5. Kiểm tra các cổng đang chạy
    $ sudo docker-compose ps
    - phpMyAdmin: http://127.0.0.1:8080 (nếu không có quyền admin xem cấu hình dưới) 

# Chạy dự án
Sau khi enable môi trường:
1. $ sudo docker-compose exec workspace bash
2. $ composer update
3. $ cd ..
4. $ cp .env.example .env
5. $ php artisan key:generate
6. Tạo database và config file .env
Cấu hình file .env (không nhầm với file env bên trong thư mục laradock)
  - Đổi lại:
      DB_HOST=mysql
      REDIS_HOST=redis
      QUEUE_HOST=beanstalkd
      
      AWS_ACCESS_KEY_ID=AKIAVGFMMZMTD7JJQDIW
      AWS_SECRET_ACCESS_KEY=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
      AWS_DEFAULT_REGION=ap-northeast-1
      AWS_BUCKET=music-project-laravel
  - php artisan storage:link
  - php artisan migrate --seed
7. $ php artisan storage:link
8. cd laradock
    $ php artisan migrate
    $ php artisan db:seed
10. Vào trình duyệt gõ http://localhost


# Cấu hình lại file php.ini trong Apache2 và Cli để có thể upload file nặng trên 2Mb .
     Đường dẫn
     - etc/PHP/7.x/Apache2
     - etc/PHP/7.x/Cli

     Sửa dòng: upload_max_filesize = 2M
     Thành :   upload_max_filesize = 100M
 
 -----------------------------------------
  
 # PhpMyAdmin set admin nếu chưa có quyền admin
1. $ sudo docker-compose exec mysql bash
2. /# mysql -u root -p
3. password nhập là root
4. Sau đó nhập lệnh:
   mysql> ALTER USER 'root' IDENTIFIED WITH mysql_native_password BY 'root';
5. Ctrl+D để thoát
