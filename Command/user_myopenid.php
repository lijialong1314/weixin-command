<?php
if(define(WEIXINAPI)) exit;

$userid = $weObj->getRevFrom();
$text = "您的OpenID为：\n$userid";
$weObj->text($text)->reply();