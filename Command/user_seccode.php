<?php
if(define(WEIXINAPI)) exit;
$userid = $weObj->getRevFrom();

//验证码简单生成逻辑
$num1=rand(100,900);
$num2=rand(3000,4000);
$code = $num1 + $num2;
$text = "Wordpress登录安全码(5分钟内有效): $code";

//保存redis
$redis = new Redis();
$redis->connect('127.0.0.1', 1234);
$redis->auth('xxxxxxx');
$redis->select(0);
$redis->set("WPLogin_$userid",$code,300);//5 min

//回复
$weObj->text($text)->reply();

