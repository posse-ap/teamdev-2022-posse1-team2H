# チーム開発2022サンプル

チーム開発用のサンプルです、これを使ってサクッと開発してください

# Note

ソースの取得
※コマンドを実行したフォルダにサンプルコードがダウンロードされます

```bash
git clone git@github.com:posse-ap/teamdev-2022-sample2.git
```

コンテナ起動

```bash
cd teamdev-2022-sample2
docker-compose build --no-cache
docker-compose up -d
```

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
