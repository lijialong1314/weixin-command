<?php
define("WEIXINAPI",1);
require 'vendor/autoload.php';
include "wechat.class.php";
include "config.php";
include "common.php";

$weObj = new Wechat(["token"=>Config::$token,"encodingaeskey"=>Config::$encodingaeskey]);
//加解密验证
$weObj->valid();
//必须调用，接收数据存放到类对象中，方便后面调用
$weObj->getRev();
//消息类型
$msgtype = $weObj->getRevType();

switch($msgtype) {
	case Wechat::MSGTYPE_TEXT:
			parseText($weObj);
			break;
	case Wechat::MSGTYPE_IMAGE:
		break;
	case Wechat::MSGTYPE_LOCATION:
		break;
	case Wechat::MSGTYPE_LINK:
		break;
	case Wechat::MSGTYPE_EVENT:
		break;
	case Wechat::MSGTYPE_MUSIC:
		break;
	case Wechat::MSGTYPE_NEWS:
		break;
	case Wechat::MSGTYPE_VOICE:
		break;
	case Wechat::MSGTYPE_VIDEO:
		break;
	default:
			$weObj->text("help info")->reply();
}