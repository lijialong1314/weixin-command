<?php
function shortCommand($arr){
	$text = "";
	foreach($arr as $v){
		$text .= "/$v,";
	}
	return substr($text,0,strlen($text)-1);
}
$commandArr = Config::$command;
$usertext = "下面是主人给我注册的普通用户命令：\n";
$admintext ="\n下面是主人给我注册的管理员命令：\n";
foreach($commandArr as $key => $value){
	switch($value["isadmin"]){
		case 0:
				$usertext .= ("/".$key." [".shortCommand($value['short'])."]：".$value["desc"]."\n");
			break;
		case 1:
				$admintext .= ("/".$key." [".shortCommand($value['short'])."]：".$value["desc"]."\n");
			break;
	}
}
if(checkIsAdmin($weObj))
	$text = $usertext .$admintext;
else
	$text = $usertext;
$weObj->text($text)->reply();