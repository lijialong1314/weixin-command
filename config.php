<?php
class Config{
	static $token = "YOURTOKEN";
	static $encodingaeskey = "YOURAESKEY";
	static $adminids = ["YOURWEIXINOPENID"];
	static $command = [
		"backup"=>["isadmin"=>1,"desc"=>"备份博客网站和数据库","short"=>["bk"]],
		"help"=>["isadmin"=>0,"desc"=>"获取命令帮助信息","short"=>["h"]],
		"myopenid"=>["isadmin"=>0,"desc"=>"获取您在这里的唯一编号","short"=>["id"]],
		"seccode"=>["isadmin"=>0,"desc"=>"获取Wordpress博客后台登录验证码","short"=>["code"]],
	];
}