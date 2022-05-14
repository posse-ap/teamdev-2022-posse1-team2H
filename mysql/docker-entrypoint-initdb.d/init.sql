DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  tel VARChAR(255) NOT NULL,
  univercity VARCHAR(255) NOT NULL,
  undergraduate VARCHAR(255) NOT NULL,
  department VARCHAR(255) NOT NULL,
  school_year INT(10) NOT NULL,
  graduation_year INT(10) NOT NULL,
  gender BOOLEAN NOT NULL,
  address VARCHAR(255) NOT NULL,
  address_num VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS agencies;

CREATE TABLE agencies (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  email_for_notification VARCHAR(255) NOT NULL,
  tel VARCHAR(255) NOT NULL,
  url TEXT NOT NULL,
  representative VARCHAR(255) NOT NULL,
  contactor VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  address_num VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO agencies SET
name = '株式会社〇〇',
email = 'marumaru@example.com',
email_for_notification = 'marumarun@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = '〇〇丸',
contactor = '武田鉄矢',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社菅田将暉', 'suda@example.com', password_hash('sudamasaki'), 'sudan@example.com', '08000001111', 'https://google.com', 'すだ', '菅生大将', '199-9999'),
INSERT INTO agencies SET
name = '株式会社菅田将暉',
email = 'suda@example.com',
email_for_notification = 'sudan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'すだ',
contactor = '菅生大将',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社竹内涼真', 'takeuti@example.com', password_hash('takeuti'), 'takeutin@example.com', '08000001111', 'https://google.com', 'たけうち', 'たけうち', '199-9999'),
INSERT INTO agencies SET
name = '株式会社竹内涼真',
email = 'takeuti@example.com',
email_for_notification = 'takeutin@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'たけうち',
contactor = 'たけうち',
address = '東京都港区',
address_num = '199-9999';

-- ('', 'mamiya@example.com', password_hash('mamiya'), 'mamiyan@example.com', '08000001111', 'https://google.com', 'まみや', 'まみや', '199-9999'),
INSERT INTO agencies SET
name = '株式会社間宮祥太朗',
email = 'mamiya@example.com',
email_for_notification = 'mamiyan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'まみや',
contactor = 'まみや',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社仲野太賀', 'nakano@example.com', password_hash('nakano'), 'nakano@example.com', '08000001111', 'https://google.com', 'なかの', 'なかの', '199-9999'),
INSERT INTO agencies SET
name = '株式会社仲野太賀',
email = 'nakano@example.com',
email_for_notification = 'nakano@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'なかの',
contactor = 'なかの',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社神木隆之介', 'kamiki@example.com', sha1('kamiki'), 'kamikin@example.com', '08000001111', 'https://google.com', 'かみき', 'かみき', '199-9999'),
INSERT INTO agencies SET
name = '株式会社神木隆之介',
email = 'kamiki@example.com',
email_for_notification = 'kamikin@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'かみき',
contactor = 'かみき',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社松坂桃李', 'matuzaka@example.com', sha1('matuzaka'), 'matuzaka@example.com', '08000001111', 'https://google.com', 'まつざか', 'まつざか', '199-9999'),
INSERT INTO agencies SET
name = '株式会社松坂桃李',
email = 'matuzaka@example.com',
email_for_notification = 'matuzakan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'まつざか',
contactor = 'まつざか',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社山田裕貴', 'yamada@example.com', sha1('yamada'), 'yamada@example.com', '08000001111', 'https://google.com', 'やまだ', 'やまだ', '199-9999'),
INSERT INTO agencies SET
name = '株式会社山田裕貴',
email = 'yamada@example.com',
email_for_notification = 'yamadan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'やまだ',
contactor = 'やまだ',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社吉沢亮', 'yosizawa@example.com', sha1('yosizawa'), 'yosizawan@example.com', '08000001111', 'https://google.com', 'よしざわ', 'よしざわ', '199-9999'),
INSERT INTO agencies SET
name = '株式会社吉沢亮',
email = 'yosizawa@example.com',
email_for_notification = 'yosizawan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'よしざわ',
contactor = 'よしざわ',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社DJ松永', 'matsunaga@example.com', sha1('matsunaga'), 'matsunagan@example.com', '08000001111', 'https://google.com', 'くにひこ', 'くにひこ', '199-9999'),
INSERT INTO agencies SET
name = '株式会社DJ松永',
email = 'matsunaga@example.com',
email_for_notification = 'matsunagan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'くにひこ',
contactor = 'くにひこ',
address = '東京都港区',
address_num = '199-9999';

-- ('株式会社常田大希', 'tuneta@example.com', sha1('tuneta'), 'tunetan@example.com', '08000001111', 'https://google.com', 'つねた', 'つねた', '199-9999');
INSERT INTO agencies SET
name = '株式会社常田大希',
email = 'tuneta@example.com',
email_for_notification = 'tunetan@example.com',
tel = '08000001111',
url = 'https://google.com',
representative = 'つねた',
contactor = 'つねた',
address = '東京都港区',
address_num = '199-9999';


DROP TABLE IF EXISTS agency_articles;
CREATE TABLE agency_articles (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agency_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  sentenses VARCHAR(255) NOT NULL,
  eyecatch_url VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY fk_agency_id(agency_id)
  REFERENCES agencies(id)
);

DROP TABLE IF EXISTS users_agencies; -- ユーザーとエージェンシーの中間テーブル

CREATE TABLE users_agencies (
  user_id INT,
  agency_id INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY fk_user_id(user_id) REFERENCES users(id),
  FOREIGN KEY fk_agency_id(agency_id) REFERENCES agencies(id)
);

DROP TABLE IF EXISTS industries;

CREATE TABLE industries (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  industry VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO industries (industry) VALUES
("IT"),
("広告"),
("営業"),
("コンサル"),
("接客"),
("医療");

DROP TABLE IF EXISTS agency_type;

CREATE TABLE agency_type (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agency_type VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO agency_type (agency_type) VALUES
("文系に強い"),
("理系に強い"),
("ベンチャーが多い"),
("カジュアル"),
("しっかり");

DROP TABLE IF EXISTS agencies_industries;

CREATE TABLE agencies_industries (
  agency_id INT,
  industry_id INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY fk_agency_id(agency_id) REFERENCES agencies(id),
  FOREIGN KEY fk_industory_id(industry_id) REFERENCES industries(id)
);

INSERT INTO agencies_industries (agency_id, industry_id) VALUES
(1, 1),
(2, 2),
(3, 1),
(3, 3),
(4, 4),
(4, 5),
(5, 3),
(6, 2),
(7, 4);


DROP TABLE IF EXISTS agencies_types; -- 中間テーブル

CREATE TABLE agencies_types (
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  agency_id INT,
  type_id INT,
  FOREIGN KEY fk_agency_id(agency_id) REFERENCES agencies(id),
  FOREIGN KEY fk_type_id(type_id) REFERENCES agency_type(id)
);

INSERT INTO agencies_types (agency_id, type_id) VALUES
(1, 1),
(2, 2),
(3, 1),
(3, 3),
(4, 4),
(4, 1),
(5, 3),
(6, 2),
(7, 4);

DROP TABLE IF EXISTS managers;

CREATE TABLE managers (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_representative BOOLEAN NOT NULL,
  agency_id INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY fk_agency_id(agency_id) REFERENCES agencies(id)
);

DROP TABLE IF EXISTS contracts;

CREATE TABLE contracts ( -- 契約情報のテーブル v
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY, -- 契約id
  agency_id INT NOT NULL, -- エージェンシーid 外部キー成約
  contract_year_month INT NOT NUll, -- 契約年月 ex) 2022-3
  claim_year_month DATE NOT NULL, -- 支払い期日 ex) 2022-4-30
  request_amounts INT NOT NULL, -- 請求金額
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY fk_agency_id(agency_id) REFERENCES agencies(id)
);

DROP TABLE IF EXISTS administorators;

CREATE TABLE administorators (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- INSERT INTO administorators
-- SET
-- name = 'サンプル太郎',
-- email = 'test@posse-ap.com',
-- password = password_hash('password', PASSWORD_DEFAULT);
