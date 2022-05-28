

# コンテナ起動

```bash
cd teamdev-2022-sample2
docker-compose build --no-cache
docker-compose up -d
```

# URL

```bash
学生: http://localhost/
エージェンシー: http://localhost/agency
管理者: http://localhost/admin
```

# エージェンシー画面ログイン情報
``bash
データ挿入: agency/login.php:10行目をコメントインしてページにアクセス。一度アクセスしたらコメントアウト
メールアドレス: fukuba@example.com
パスワード: fukuba
```

# 管理者画面ログイン情報

```bash
データ挿入: admin/login.php:9行目をコメントインしてページにアクセス。一度アクセスしたらコメントアウト
メールアドレス：admin@example.com
パスワード：admin
```

データ初期化

```bash
./mysql/data を削除後、コンテナ再起動
./mysql/docker-entrypoint-initdb.d/init.sql が実行され初期データが投入されます
※エージェンシー、管理者のログイン情報だけ上記の方法で投入してください。
```
