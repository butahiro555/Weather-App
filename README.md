使用方法
1. git clone https://github.com/butahiro555/Laravel10-Vue3-docker.git
2. cd Laravel10-Vue3-docker
4. cp .env.example .env
5. cp .env.testing.example .env.testing

6. .envと、.env.testingのDB_*** と、MYSQL_***の環境変数を以下のように設定します。
- DB_CONNECTION=mysql
- DB_HOST=db
- DB_PORT=3306
- DB_DATABASE=任意のデータベース名
- DB_USERNAME=任意のユーザー名
- DB_PASSWORD=任意のパスワード名

- MYSQL_ROOT_PASSWORD=任意のrootのパスワード名
- MYSQL_DATABASE=任意のデータベース名
- MYSQL_USER=任意のユーザー名
- MYSQL_PASSWORD=任意のパスワード名

7. docker compose up -d
8. docker compose exec -it app bash
9. chmod -R guo+w storage
10. composer install
11. php artisan key:generate
12. .envに出力したAPP_KEYを、.env.testingのAPP_KEYにもコピーします。
13. php artisan storage:link
14. php artisan config:clear
15. php artisan migrate

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
