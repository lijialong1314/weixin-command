<?php

function checkIsAdmin($weObj){
	$currentID = $weObj->getRevFrom();
	if(in_array($currentID,Config::$adminids)){
		return true;
	}else{
		return false;
	}
}

function checkIsCommand($content){
	return strpos($content,"/") === 0?true:false;
}

function getResponseText($weObj){
	return $weObj->getRevContent();
}

function parseText($weObj){
	$content = getResponseText($weObj);
	if(checkIsCommand($content)){
		parseCommond($content,$weObj);
	}else{
		$weObj->text("你好，请输入 /h 获取命令帮助信息")->reply();
	}
}

function parseShortCommond($content){
	$commandArr = Config::$command;
	foreach($commandArr as $key=>$value){
		if(in_array($content,$value['short'])){
			return $key;
		}
	}
	return $content;
}

function parseCommond($content,$weObj){
    $contentArr = explode(' ',$content);
    //命令的参数
    $pargsArr = [];
    for($i=1;$i<count($contentArr);$i++){
        $pargsArr[] = $contentArr[$i];
    }
    //$weObj->text(json_encode($pargsArr))->reply();
    
	$command = str_replace("/","",$contentArr[0]);
	$command = parseShortCommond($command);
	$adminfile = "Command/admin_$command.php";
	$userfile = "Command/user_$command.php";
	if(file_exists($adminfile) && checkIsAdmin($weObj)){
		include $adminfile;
	}else if(file_exists($userfile)){
		include $userfile;
	}else{
		$weObj->text("哎呀，主人还没给我注册这个命令，暂时无法响应你~\n可以输入 /h 获取命令帮助")->reply();
	}
}