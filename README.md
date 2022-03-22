# LINE_Bot_YouTube

## イメージ
https://user-images.githubusercontent.com/70275399/159514530-ea077628-cd47-42f6-868a-b0088fa724a1.mov

## 概要
YouTuber名を送信すると、最新の動画リンクを取得できるLINE Botです。

## 環境
- macOS 12.2.1
- Laravel 9.5.1
- Docker
- YouTube Data API
- LINE-BOT-SDK-PHP

## 使用方法
LINEアカウントを追加し、任意のYouTuber名を送信する。送信後に、任意のYouTuberが投稿した最新の動画リンクが取得できる。

## 説明（LNE Botの作成方法）
- LINE Developserに登録する。
- Dockerでコンテナを作成し、ビルドする。
- appコンテナに入り、Laravel９をインストールする。
- YouTube Data API及び、LINE-BOT-SDK-PHPをインストールする。
- 各APIキーを取得し、.envファイルに記載。その後、services.phpに記載する。
- api.phpにpostでルーティングを作成する。
- Controllerをartisanコマンドで作成する。
- LINE Botに接続後、送信されてきたメッセージを取得する。
- YouTube Data APIより、取得したチャネル名をパラメーターとして検索する。
- 取得した動画リンクをLINE Botに返信する。

## リファレンス
https://anytimesnotes.com/archives/2736
https://developers.google.com/youtube/v3/docs/search/list?hl=ja
https://qiita.com/kata-n/items/e91ae5d4f0c6927db42e#env%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%AE%E8%A8%AD%E5%AE%9A

## Author
koki0429


