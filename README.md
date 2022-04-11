# チーム開発2022サンプル

チーム開発用のサンプルです、これを使ってサクッと開発してください

# Usage

コンテナ起動

```bash
docker-compose build --no-cache
docker-compose up -d
```

# Note

ログインURL

```bash
http://localhost/
```

管理者画面ログイン情報

```bash
メールアドレス：test@posse-ap.com
パスワード：password
```

データ初期化

```bash
./mysql/data を削除後、コンテナ再起動
./mysql/docker-entrypoint-initdb.d/init.sql が実行され初期データが投入されます
```
