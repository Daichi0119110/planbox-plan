﻿create database planbox character set utf8;

grant all on planbox.* to dbuser@localhost identified by 'planbox';

use planbox;

/*usersのテーブル作成*/
create table users (
    id int not null auto_increment primary key,
    gender int not null,
    name varchar(255),
    couple_id int,
    password varchar(255),
    photo varchar(255),
    birthday varchar(255),
    age int,
    insta_id int,
    insta_token varchar(255)
);

insert into users (gender, name, couple_id, age, photo, birthday) values 
    (0,'@daichi119', 1, 21, "daichi.jpg", '1994/1/24'),
    (0,'@k0hei1993', 2, 21, "kohei.jpeg", '1993/5/24'),
    (0,'@toshichan', 3, 21, "taniguchi.jpg", '1993/5/4'),
    (1,'@azuman', 4, 23, "azuma.jpg",'1992/2/2'),
    (1,'@gakigaki', 3, 21, "gaki.jpeg",'1991/7/21'),
    (1,'@mitsuki', 1, 28, "yamamoto.jpg",'1992/2/24'),
    (0,'GIGcl', 4, 20, "tsumabuki.jpeg", '1995/1/1'),
    (1,'@makihori', 2, 17, "horikita.png",'1994/6/24');

/*couplesのテーブル作成*/
create table couples (
    id int not null auto_increment primary key,
    email varchar(255),
    profile varchar(255),
    start_date date, 
    cover_url varchar(255),
    profile_url varchar(255),
    often_area varchar(255),
    often_place varchar(255),
    relationship varchar(255),
    anniversary varchar(255),
    created datetime default null,
    modified datetime default null
);

insert into couples (often_area, often_place, relationship, anniversary, created, modified) values 
    ("横浜","水族館","破滅直前","2015/8/2",now(),now()),
    ("渋谷","カフェ","カップル","2012/3/7",now(),now()),
    ("中目黒","美術館","夫婦","2013/4/2",now(),now()),
    ("横浜","水族館","デモ用","2015/8/2",now(),now());


/*datesのテーブル作成*/
create table dates (
    id int not null auto_increment primary key,
    couple_id int not null,
    name varchar(255),
    description varchar(255),
    budget varchar(255),
    num_view int default 0,
    post_updated datetime default null, 
    created datetime default null,
    modified datetime default null
);

insert into dates (couple_id, name, description, budget, num_view, created, modified) values 
    (4, "ハッカソン＠PAAK", "今からデモを披露いたします！！", "100億", 5, now(), now(),now()),
    (1, "渋谷デート", "晴れの日を二人で過ごしました。お金がなかったので、有名どころを回って来ました(^^)", "4000", 4, now(), now(),now()),
    (2, "自由が丘デート", "オシャレな街、自由が丘。カフェや雑貨屋さんを見てきました。まったりしたい方におすすめです！！", "5000", 6,now(), now(),now()),
    (3, "江ノ島デート", "夏ということで江ノ島に行ってきました！海に入らなくても江ノ島は楽しいですよ！", "6000", 7, now(), now(),now());

/*postsのテーブル作成*/
create table posts(
    id int not null auto_increment primary key,
    date_id int not null,
    content varchar(255) not null,
    location varchar(255),
    created datetime default null,
    modified datetime default null
);

insert into posts (date_id, content, state, city, created, modified) values 
    (2, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", now(), now()),
    (2, "ハチ公前で写真撮影！いぇーい！！", "渋谷区", "東京都", now(), now()),
    (2, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (2, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),
    (2, "LOFTでお買い物！二人でお揃いの手帳ゲッチュ(*^^*)カラクリすごかった！！", "渋谷","東京都" now(), now()),
    (2, "ディナーは予約してました！美味しい料理がたくさんあって幸せだった♪", "原宿", "東京都", now(), now()),
    (2, "寂しいけど、ばいばーい（泣）夜景すごくキレイだった！！", "表参道", "東京都", now(), now()),
    (3, "駅前で集合、人やばい。", "自由が丘", "東京都", now(), now()),
    (3, "スタバでいっぱい！新作のフラペチーノ美味しい♡", "自由が丘", "東京都", now(), now()),
    (3, "メインストリートをゆっくりお散歩", "自由が丘", "東京都", now(), now()),
    (3, "デザート食べまくってお昼スキップー！ジェラート美味しすぎた！", "自由が丘", "東京都", now(), now()),
    (3, "雑貨屋さんに行ってきたよー！", "自由が丘", "東京都", now(), now()),
    (3, "ディナーはイタリアン！ラボエムにいってきたよー！オシャレな内装でおすすめ！", "自由が丘", "東京都", now(), now()),
    (3, "夜景すごくキレイだった！！また来たい街だなー自由が丘！", "自由が丘", "東京都", now(), now()),    
    (4, "駅前で集合、彼氏が遅刻！", "藤沢駅", "神奈川県", now(), now()),
    (4, "はじめての江ノ電！ローカル線すぎるー！ゆっくり動くー！", "江の電", "神奈川県", now(), now()),
    (4, "江ノ電で途中下車、スラムダンク発祥の高校があるみたい", "七里ガ浜駅", "神奈川県", now(), now()),
    (4, "江の島到着！江の島って橋を渡っていけるんだね！散歩行ってきまーす！", "江の島", "神奈川県", now(), now()),
    (4, "江の島といえば、しらす丼だよね！美味しい！", "江の島", "神奈川県", now(), now()),
    (4, "夜も綺麗な江の島ー！でもお店閉まるの早すぎ！早めの帰宅ー", "江の島", "神奈川県", now(), now()),
    (4, "家に帰って来ちゃった〜！江の島散策の1日でした！", "横浜", "神奈川県", now(), now()),
    (1, "みなさん、開発お疲れ様でした！！！","渋谷","東京都",now(),now());

/*photosのテーブル作成*/
create table photos (
    id int not null auto_increment primary key,
    post_id int default null,
    user_id int default null,
    filename varchar(255),
    created datetime default null, 
    modified datetime default null
);

insert into photos (post_id, user_id, filename, created, modified) values 
    (null, 2, 'kohei.jpg', now(), now()),
    (null, 5, 'aragaki.jpg', now(), now()),
    (1, null, 'photo1.jpg', now(), now()),
    (2, null, 'photo2.jpg', now(), now()),
    (3, null, 'photo3.jpg', now(), now());
     
/*countriesのテーブル作成*/
create table favorites (
    id int not null auto_increment primary key,
    fav_flg int,
    user_id int,
    date_id int,
    created datetime default null,
    modified datetime default null
  );

insert into favorites (fav_flg, user_id, date_id, created, modified) values 
    (1, 1, 3, now(), now()),
    (1, 1, 4, now(), now()),
    (1, 2, 1, now(), now()),
    (1, 2, 2, now(), now()),
    (1, 3, 2, now(), now()),
    (1, 3, 3, now(), now()),
    (1, 3, 4, now(), now());

/*followsのテーブル作成*/
create table follows (
    id int not null auto_increment primary key,
    fav_flg int,
    user_id int,
    couple_id int,
    created datetime default null,
    modified datetime default null
  );

insert into follows (fav_flg, user_id, couple_id, created, modified) values 
    (1, 1, 1, now(), now()),
    (1, 1, 2, now(), now()),
    (1, 1, 3, now(), now()),
    (1, 1, 4, now(), now()),
    (1, 3, 1, now(), now()),
    (1, 4, 2, now(), now()),
    (1, 4, 1, now(), now()),
    (1, 5, 2, now(), now());