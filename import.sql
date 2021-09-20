CREATE DATABASE news_blog;
USE news_blog;

create table users (
                       id char(36) primary key not null,
                       first_name varchar(255) not null,
                       last_name varchar(255) not null,
                       email varchar(255) not null,
                       birthDate date not null,
                       password varchar(255) not null,
                       createdAt datetime not null default current_timestamp(),
                       is_admin  tinyint(1) not null default 0
);

create table articles_author (
                                 id int auto_increment primary key,
                                 name varchar(255) not null
);


create table articles (
                          id  int auto_increment primary key,
                          title text not null unique,
                          description longtext null,
                          urlToImage text not null,
                          publishedAt datetime not null default current_timestamp(),
                          category varchar(30) not null default 'general'           ,
                          url varchar(250) not null,
                          author int null,
                          foreign key (author) references articles_author(id) on update cascade on delete set null
);

create table comments (
                          id int auto_increment primary key,
                          content text not null,
                          article_id int not null,
                          user_id char(36) not null,
                          posted_at datetime not null default current_timestamp(),
                          foreign key (article_id) references articles(id) on update cascade on delete cascade,
                          foreign key (user_id) references users(id) on update cascade on delete cascade
);

create index article_id on comments(article_id);

create index user_id on comments (user_id);
