create database planbox character set utf8;

grant all on planbox.* to dbuser@localhost identified by 'planbox';

use planbox;

/*usersのテーブル作成*/
create table users (
    id int not null auto_increment primary key,
    gender int not null,
    anony_flg int not null,
    name varchar(255),
    name_insta varchar(255),
    couple_id int,
    password varchar(255),
    photo varchar(255),
    birthday varchar(255),
    age int,
    insta_id varchar(255),
    insta_token varchar(255)
);

insert into users (gender, name, anony_flg, name_insta, couple_id, password, age, photo, birthday, insta_id, insta_token) values 
    (0,'@daichi119',0,null,1,"tsetet",21,"daichi.jpg",'1994/1/24',null,null),
    (0,'@k0hei1993',0,null,2,"tsetet",21,"kohei.jpeg",'1993/5/24',null,null),
    (0,'@toshichan',0,null,3,"tsetet",21,"taniguchi.jpg",'1993/5/4',null,null),
    (1,'@azuman',0,null,4,"tsetet",23,"azuma.jpg",'1992/2/2',null,null),
    (1,'@gakigaki',0,null,3,"tsetet",21,"gaki.jpeg",'1991/7/21',null,null),
    (1,'@mitsuki',0,null,1,"tsetet",28,"yamamoto.jpg",'1992/2/24',null,null),
    (0,'GIGcl',0,null,4,"tsetet",20,"tsumabuki.jpeg",'1995/1/1',null,null),
    (1,'@makihori',0,null,2,"tsetet",17,"horikita.png",'1994/6/24',null,null);

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

insert into dates (couple_id, name, description, budget, num_view, post_updated, created, modified) values 
    (1, "渋谷満喫デート", "晴れの日を二人で過ごしました。お金がなかったので、有名どころを回って来ました(^^)", "4000", 50, now(), now(),now()),
    (1, "中目黒ゆったりデート", "ゆったりと静かなひとときを過ごせます。ちょっぴり大人なカップル向けだと思います！", "10000", 20, now(), now(),now()),
    (1, "代官山の大人の休日デート", "オシャレなショップやカフェが立ち並び、有名人がたくさん住んでいる街、代官山。休日に行きたいデートです！", "8000", 16, now(), now(),now()),
    (1, null, null, null, 0, now(), now(),now()),
    (2, "自由が丘デート", "オシャレな街、自由が丘。カフェや雑貨屋さんを見てきました。まったりしたい方におすすめです！！", "5000", 6,now(), now(),now()),
    (2, "お財布に優しい二子玉川デート", "最近話題の二子玉川ライズに行ってきました！とってもおすすめです。ウィンドウショッピングだけなので学生さんにもおすすめです！", "1500", 20,now(), now(),now()),
    (3, "江ノ島デート", "夏ということで江ノ島に行ってきました！海に入らなくても江ノ島は楽しいですよ！", "6000", 7, now(), now(),now()),
    (3, "鎌倉プチ旅行デート", "少し遠出をしてきました。", "6000", 7, now(), now(),now()),
    (4, "夕方からの新宿デート", "歌舞伎町のイメージが強いですが…。ちゃんと新宿でも良い雰囲気の場所がたくさんありました！！", "5000", 13, now(), now(),now()),
    (4, "六本木デート", "仕事帰りにさらっと行けます。普段にも使えるお店で本当におすすめです！", "8000", 10, now(), now(),now());

/*postsのテーブル作成*/
create table posts(
    id int not null auto_increment primary key,
    date_id int not null,
    content varchar(255) not null,
    state varchar(255),
    city varchar(255),
    created datetime default null,
    modified datetime default null
);

insert into posts (date_id, content, city, state created, modified) values 
    (1, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", "東京都", now(), now()),
    (1, "ハチ公前で写真撮影！いぇーい！！", "渋谷", "東京都", now(), now()),
    (1, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (1, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),
    (1, "LOFTでお買い物！二人でお揃いの手帳ゲッチュ(*^^*)カラクリすごかった！！", "渋谷","東京都", now(), now()),
    (1, "ディナーは予約してました！美味しい料理がたくさんあって幸せだった♪", "原宿", "東京都", now(), now()),
    (1, "寂しいけど、ばいばーい（泣）夜景すごくキレイだった！！", "表参道", "東京都", now(), now()),
    (2, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "中目黒", "東京都", now(), now()),
    (2, "ハチ公前で写真撮影！いぇーい！！", "中目黒", "東京都", now(), now()),
    (2, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "中目黒", "東京都", now(), now()),
    (2, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "中目黒","東京都", now(), now()),
    (3, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "代官山", "東京都", now(), now()),
    (3, "ハチ公前で写真撮影！いぇーい！！", "代官山", "東京都", now(), now()),
    (3, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "代官山", "東京都", now(), now()),
    (3, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "代官山","東京都", now(), now()),
    (4, "駅前で集合、彼氏が遅刻！", "藤沢駅", "神奈川県", now(), now()),
    (4, "はじめての江ノ電！ローカル線すぎるー！ゆっくり動くー！", "江の電", "神奈川県", now(), now()),
    (4, "江ノ電で途中下車、スラムダンク発祥の高校があるみたい", "七里ガ浜駅", "神奈川県", now(), now()),
    (4, "江の島到着！江の島って橋を渡っていけるんだね！散歩行ってきまーす！", "江の島", "神奈川県", now(), now()),
    (4, "江の島といえば、しらす丼だよね！美味しい！", "江の島", "神奈川県", now(), now()),
    (4, "夜も綺麗な江の島ー！でもお店閉まるの早すぎ！早めの帰宅ー", "江の島", "神奈川県", now(), now()),
    (4, "家に帰って来ちゃった〜！江の島散策の1日でした！", "横浜", "神奈川県", now(), now()),
    (5, "駅前で集合、人やばい。", "自由が丘", "東京都", now(), now()),
    (5, "スタバでいっぱい！新作のフラペチーノ美味しい♡", "自由が丘", "東京都", now(), now()),
    (5, "メインストリートをゆっくりお散歩", "自由が丘", "東京都", now(), now()),
    (5, "デザート食べまくってお昼スキップー！ジェラート美味しすぎた！", "自由が丘", "東京都", now(), now()),
    (5, "雑貨屋さんに行ってきたよー！", "自由が丘", "東京都", now(), now()),
    (5, "ディナーはイタリアン！ラボエムにいってきたよー！オシャレな内装でおすすめ！", "自由が丘", "東京都", now(), now()),
    (5, "夜景すごくキレイだった！！また来たい街だなー自由が丘！", "自由が丘", "東京都", now(), now()),
    (6, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", "東京都", now(), now()),
    (6, "ハチ公前で写真撮影！いぇーい！！", "渋谷", "東京都", now(), now()),
    (6, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (6, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),
    (7, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", "東京都", now(), now()),
    (7, "ハチ公前で写真撮影！いぇーい！！", "渋谷", "東京都", now(), now()),
    (7, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (7, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),
    (8, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", "東京都", now(), now()),
    (8, "ハチ公前で写真撮影！いぇーい！！", "渋谷", "東京都", now(), now()),
    (8, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (8, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),
    (9, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", "東京都", now(), now()),
    (9, "ハチ公前で写真撮影！いぇーい！！", "渋谷", "東京都", now(), now()),
    (9, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (9, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),
    (10, "ヒカリエに集合！天気も良好◎　さすが晴れ男！！", "渋谷", "東京都", now(), now()),
    (10, "ハチ公前で写真撮影！いぇーい！！", "渋谷", "東京都", now(), now()),
    (10, "TOHOシネマで映画鑑賞！疲れてたからちょっと寝ちゃった…笑", "渋谷", "東京都", now(), now()),
    (10, "楽天カフェで一休み！ワンピースの音楽が永遠リピート。。。懐かしい！！", "渋谷","東京都", now(), now()),

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
    (4, null, 'shibuya.jpg', now(), now());
    (3, null, 'shinjuku.jpg', now(), now());
    (3, null, 'daikanyama.jpg', now(), now());
    (3, null, 'enoshima.jpg', now(), now());
    (3, null, 'jiyugaoka.jpg', now(), now());
    (3, null, 'nikotama.jpg', now(), now());
    (3, null, 'roppongi.jpg', now(), now());
    (3, null, 'kamakura.jpg', now(), now());
    (3, null, 'nakameguro.jpg', now(), now());
     
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
