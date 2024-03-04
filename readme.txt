以下のデータベースとテーブルを作成、dbsetting.phpにDB情報入力で動作

mySQL
===DB名===
【blog】

===table名===
【post】
no      : int(20),AUTO_INCREMENT
title   : text,utf8mb4_general_ci
content : text,utf8mb4_general_ci
time    : timestamp,current_timestamp(),ON UPDATE CURRENT_TIMESTAMP()

【staff】
code    : int(11),AUTO_INCREMENT
name    : text,utf8mb4_general_ci
password: varchar(255),utf8mb4_general_ci

===========


サイトマップ

├── index.php                    サイトトップページ
├── list.php                     記事一覧
├── detail.php                   記事詳細
│
├── admin
│   ├── dbsetting.php            データベース接続情報
│   ├── admin_login.php          管理者ログイン
│   ├── admin_logincheck.php     管理者ログインチェック
│   ├── admin_logout.php         管理者ログアウト
│   ├── admin_top.php            管理者トップページ
│   ├── admin_post.php           記事投稿
│   ├── admin_postdone.php       記事投稿完了
│   ├── admin_edit.php           記事編集
│   ├── admin_editdone.php       記事編集完了
│   ├── admin_delete.php         記事削除
│   ├── admin_deletedone.php     記事削除完了
│   ├── admin_signup.php         管理者追加
│   └── admin_signupdone.php     管理者追加完了
│
├── common.php                   共通インクルード関数
└── blog.css                     共通css