# 使用するベースイメージ
FROM mysql:8.0.38

# MySQLの設定ファイルをコンテナ内の適切な場所にコピー
COPY my.cnf /etc/mysql/my.cnf

# MySQLの初期化スクリプトをコンテナ内の適切な場所にコピー
COPY init.sql /etc/mysql/init.sql

# MySQLのデータファイルを保持するディレクトリを作成
RUN mkdir -p /var/lib/mysql

# 必要に応じてその他のカスタム設定を追加