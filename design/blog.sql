create database if not exists blog charset=utf8;
use blog;

-- 后台管理用户
create table if not exists blog_admin(
    id mediumint unsigned auto_increment,
    account varchar(191) not null comment '账号名',
    password varchar(191) not null comment '密码',
    email varchar(191) not null comment '邮箱',
    phone varchar(11) not null comment '手机号码',
    image varchar(191) comment '头像',
    last_login_ip varchar(191)  comment '最后一次登录的ip',
    last_login_time datetime comment '最后一次登录的时间',
    status tinyint default 1 comment '状态',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    unique key uk_account(account),
    unique key uk_email(email)
)charset=utf8,engine=innodb;


-- 文章标签表
create table if not exists blog_tags(
    id mediumint unsigned auto_increment,
    title varchar(64) not null comment '标签名',
    status tinyint default 1 comment '状态 0 - 禁用 1 - 启用',
    description text not null comment '描述',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    unique key uk_title(title),
    key uk_status(status)
)charset=utf8,engine=innodb;

-- 文章分类表
create table if not exists blog_category(
    id mediumint unsigned auto_increment,
    title varchar(64) not null comment '分类名',
    pid mediumint unsigned not null comment '上级id',
    description text not null comment '描述',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key(id),
    unique key uk_title(title),
    key idx_status(status),
    key idx_pid(pid)
)charset=utf8,engine=innodb;

-- 友情连接
create table if not exists blog_link(
    id mediumint unsigned not null auto_increment,
    title varchar(191) not null comment '友情连接名',
    url varchar(191) not null comment '友情链接url',
    status tinyint default 1 comment '状态 0 - 禁用 1 - 启用',
    sort int default 50 comment '排序值,越小越靠前',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    unique key uk_title (title),
    unique key uk_url (url)
)charset=utf8,engine=innodb;

-- 文章表
create table if not exists blog_article(
    id mediumint unsigned not null auto_increment,
    title varchar(191) not null comment '标题',
    description varchar(255) not null comment '文章简介',
    big_image varchar(255) not null comment '原图路径',
    small_image varchar(255) not null comment '缩略图路径',
    status tinyint default 1 comment '状态 0 - 禁用 1 - 启用',
    is_hot tinyint default 0 comment '是否热销',
    is_rec tinyint default 0 comment '是否推荐',
    view_number int default 0 comment '浏览数',
    author varchar(191) not null comment '作者昵称',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    unique key uk_title (title),
    key idx_status (status),
    key idx_is_hot (is_hot),
    key idx_is_rec (is_rec),
    key idx_view_number (view_number)
)charset=utf8,engine=innodb;


-- 文章 - 分类 中间表
create table if not exists blog_article_category(
    id mediumint unsigned not null auto_increment,
    article_id mediumint unsigned not null comment '文章id',
    category_id  mediumint unsigned not null comment '分类id',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    key idx_article_id(article_id),
    key idx_category_id(category_id)
)charset=utf8,engine=innodb;


-- 文章 - 标签 中间表
create table if not exists blog_article_tags(
    id mediumint unsigned not null auto_increment,
    article_id mediumint unsigned not null comment '文章id',
    tag_id mediumint unsigned not null comment '标签id',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    key idx_article_id(article_id),
    key idx_tag_id(tag_id)
)charset=utf8,engine=innodb;



-- 文章内容表
create table if not exists blog_article_details(
    id mediumint unsigned not null auto_increment,
    article_id mediumint unsigned not null comment '文章id',
    content text not null comment '文章内容',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    key idx_article_id (article_id)
)charset=utf8,engine=innodb;


-- 评论表
create table if not exists blog_comment(
    id mediumint unsigned not null auto_increment,
    username varchar(191)  comment '评论者姓名',
    email varchar(191) comment '评论者邮箱',
    pid tinyint default 0 comment '回复者id,0为评论者',
    content text comment '评论内容',
    is_verify tinyint default 0 comment '0 - 待审核 1 - 审核不通过 2 - 审核通过',
    verify_time datetime not null comment '审核时间',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    key idx_username (username),
    key idx_email (email),
    key idx_pid (pid),
    key idx_is_verify (is_verify)
)charset=utf8,engine=innodb;

-- 横幅表
create table if not exists blog_banner(
    id mediumint unsigned not null auto_increment,
    title varchar(191) not null comment '横幅名字',
    image varchar(191) not null comment '横幅图片路径',
    status tinyint default 0 not null comment '状态 0 - 启用 1 - 禁用',
    is_join tinyint default 0 not null comment '是否加入队列 0 - 未加入 1 - 轮播中',
    created_at datetime not null comment '添加时间',
    updated_at datetime not null comment '编辑时间',
    primary key (id),
    unique key uk_title (title),
    key idx_status (status)
)charset=utf8,engine=innodb;
