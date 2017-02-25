/*
后台用户表

 */
CREATE TABLE cms_admin(
  admin_id mediumint(6) unsigned not null auto_increment,
  username varchar(20) not null DEFAULT '',
  password varchar(32) not null DEFAULT '',
  lastloginip varchar(15) DEFAULT '0',
  lastlogintime int(10) unsigned DEFAULT '0',
  email varchar (40) DEFAULT '',
  realname varchar(50) not null DEFAULT '',
  status tinyint(1) not null DEFAULT '1',
  PRIMARY KEY (admin_id),
  KEY username (username)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*
菜单表
*/
CREATE TABLE cms_menu (
  menu_id   SMALLINT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  name      VARCHAR(40)  NOT NULL DEFAULT '',
  parentid  SMALLINT(6)          NOT NULL DEFAULT '0',
  m         VARCHAR(20)          NOT NULL DEFAULT '',
  c         VARCHAR(20)          NOT NULL DEFAULT '',
  f         VARCHAR(20)          NOT NULL DEFAULT '',
  listorder SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
  status    TINYINT(1)           NOT NULL DEFAULT '1',
  PRIMARY KEY (menu_id),
  KEY listorder (listorder),
  KEY parentid (parentid),
  KEY MODULE (m, c, f)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*
新闻文章主表
主副表分离
*/
CREATE TABLE cms_news (
  news_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  catid SMALLINT(5) unsigned NOT NULL DEFAULT '0',
  title varchar(80) NOT NULL DEFAULT '',
  small_title varchar(30) NOT NULL DEFAULT '',
  title_font_color VARCHAR(250) DEFAULT NULL comment '标题颜色',
  thumb varchar(100) NOT NULL DEFAULT '' comment '缩图',
  keywords char(40) NOT NULL DEFAULT '',
  description varchar(250) NOT NULL comment '文章描述',
  listorder tinyint(3) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '1',
  copyfrom VARCHAR(250) DEFAULT NULL comment '来源',
  username char(20) NOT NULL,
  create_time int(10) unsigned NOT NULL DEFAULT '0',
  update_time int(10) unsigned NOT NULL DEFAULT '0',
  count int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (news_id),
  KEY listorder (listorder),
  KEY catid (catid)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT charset=utf8;

/*
新闻文章内容副表
*/
CREATE TABLE cms_news_content (
  id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  news_id MEDIUMINT(8) UNSIGNED NOT NULL ,
  content MEDIUMTEXT NOT NULL ,
  create_time int(10) UNSIGNED NOT NULL DEFAULT '0',
  update_time int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  KEY news_id (news_id)
)ENGINE = MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET = utf8;

/*
推荐位管理表
*/
CREATE TABLE cms_position (
  id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  name CHAR(30) NOT NULL DEFAULT '',
  status TINYINT(1) NOT NULL DEFAULT '1',
  description char(100) DEFAULT null,
  create_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
  update_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
)ENGINE = MyISAM AUTO_INCREMENT=1 CHARSET = utf8;

/*
推荐为内容表
*/
CREATE TABLE cms_position_content (
  id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  position_id INT(5) UNSIGNED NOT NULL ,
  title VARCHAR(30) NOT NULL DEFAULT '',
  thumb VARCHAR(100) NOT NULL DEFAULT '',
  url VARCHAR(100) DEFAULT NULL ,
  new_id MEDIUMINT(8) UNSIGNED NOT NULL,
  listorder TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
  status TINYINT(1) NOT NULL DEFAULT '1',
  create_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
  update_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  KEY position_id (position_id)
)ENGINE = MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET = utf8;
