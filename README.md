# サッカーチームマッチングプラットフォーム

全国の小学生サッカーチームのコーチが、練習試合の相手チームを探し、チャットで連絡を取り合うことができるWebサービスです。

## 🧭 概要

- コーチのみがユーザー登録可能（保護者などは未ログインで閲覧）
- チームの地域、学年帯、活動曜日などで検索可能
- 練習試合の申し込みはチャット機能で実施
- ファイル添付などにも対応予定

---

## 🛠️ 技術スタック

- **バックエンド**: Laravel
- **フロントエンド**: Blade
- **データベース**: MySQL
- **認証**: Laravel Breeze
- **通知・通信**: Laravel Echo または Firebase（検討中）

---

## 🗃️ テーブル構成（初期）

### users（コーチ）

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | bigint | PK |
| name | string | コーチ氏名 |
| email | string | メールアドレス（ログイン用） |
| password | string | ハッシュ化パスワード |
| timestamps | ✔️ | 登録・更新日時 |

---

### prefectures（都道府県マスタ）

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | bigint | PK（1〜47） |
| name | string | 都道府県名（例：大阪府） |
| timestamps | ✔️ | 登録・更新日時 |

---

### teams（チーム）

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| prefecture_id | bigint | FK → prefectures.id |
| city | string | 市区町村（例：吹田市） |
| name | string | チーム名 |
| grade_range | string | 対象学年（例：1〜3年） |
| practice_days | json | 活動曜日（["土", "日"]など） |
| introduction | text | チーム紹介文 |
| timestamps | ✔️ | 登録・更新日時 |

---

### team_images（チーム画像）

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | bigint | PK |
| team_id | bigint | FK → teams.id |
| image_path | string | 保存先ファイルパス |
| caption | string（nullable） | 説明文 |
| order | integer（nullable） | 表示順 |
| created_at | timestamp | 登録日時 |

---

### chat_rooms（チャットルーム）

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | bigint | PK |
| team1_id | bigint | FK → teams.id |
| team2_id | bigint | FK → teams.id |
| created_at | timestamp | 作成日時 |

---

### chat_messages（チャットメッセージ）

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | bigint | PK |
| chat_room_id | bigint | FK → chat_rooms.id |
| user_id | bigint | FK → users.id |
| message | text | メッセージ本文 |
| file_path | string（nullable） | 添付ファイルパス（任意） |
| created_at | timestamp | 投稿日時 |

---

### inquiry (お問い合わせ)

| カラム名 | 型 | 説明 |
|----------|----|------|
| id | int | 問い合わせID（主キー） |
| team_id | int | 紐づくチームのID |
| name | string | お問い合わせ者の名前 |
| email | string | メールアドレス |
| message | text | 問い合わせ内容 |
| status | string | 「未対応」または「対応済み」 |
| created_at | timestamp | 投稿日時 |
| updated_at | timestamp | 更新日時 |

### team_schedules  (チームスケジュール)
| カラム名        | 型         | 説明                |
| ----------- | --------- | ----------------- |
| id          | bigint    | 主キー               |
| team_id    | bigint    | 外部キー（teams.id）    |
| date        | date      | 実施日（例：2025-07-20） |
| start_time | time      | 開始時間（任意、例：10:00）  |
| end_time   | time      | 終了時間（任意、例：13:00）  |
| title       | string    | イベントタイトル（例：練習試合）  |
| memo        | text      | 備考（場所・相手チームなど）    |
| created_at | timestamp | 作成日時（Laravel標準）   |
| updated_at | timestamp | 更新日時（Laravel標準）   |


## 🚀 初期セットアップ手順

```bash
git clone https://github.com/yourname/soccer-matching.git
cd soccer-matching

cp .env.example .env
php artisan key:generate

# .env に DB 接続情報を記入後
php artisan migrate --seed

php artisan storage:link

php artisan serve

##tips
mysql -u ballerz_user -p -h 127.0.0.1 -P 3306 ballerz
test1@test.com
password