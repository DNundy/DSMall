<?php
return array(
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'system',
	'DB_USER' => 'root',
	'DB_PWD' => 'root',
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'trading_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'SHOW_PAGE_TRACE'=> true,
	 // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.163.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'18291953989@163.com',//你的邮箱名
    'MAIL_FROM' =>'18291953989@163.com',//发件人地址
    'MAIL_FROMNAME'=>'胖胖二手交易平台',//发件人姓名
    'MAIL_PASSWORD' =>'199723s',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
);