# 微信个人订阅号-简易命令式机器人

灵感来自Telegram的机器人，无奈国内没法愉快的使用，所以想用微信来实现命令式的机器人，可以自己定义一些指令，发送出去，后台接收然后去执行任务。

**介绍**

1、支持普通用户和管理员用户区分，即管理员命令仅管理员可见和有效。可以对外公开一些命令，也可自己开发一些运维命令

2、命令定义方式简单，只需新建一个php文件，加一个配置，命令和命令之间是隔离的，维护起来很方便

3、	由于微信规定需要在5s内响应，所以如果遇到耗时长的，比如备份数据库这种任务，可以使用异步方式实现，比如Redis发布订阅、Workerman、Swoole等



**配置方法**

1、首先肯定是要注册好自己的微信个人订阅号

2、配置好【服务器配置】，包括服务器地址、令牌、消息加解密密钥。其中服务器地址可以指定源码中的index.php文件，已经内置了验证逻辑。比如：http://你的域名/index.php

3、修改config.php文件，包括$token、$encodingaeskey、$adminids（管理员的微信OPENID，可以通过myopenid指令获取）



**命令添加方法**

目前内置了几个基本命令，包含：

```
1）help，显示帮助信息，区分普通用户和管理员
2）myopenid，获取当前用户在当前公众号的OPENID
3）seccode，获取Wordpress后台登录验证码
```

添加新的命令只需两步：

1）在Command目录创建命令文件，格式为

```
管理员命令格式：admin_命令名称.php
普通用户命令格式：user_命令名称.php
```

2）修改config.php文件中的$command参数

配置参考如下：

```php
[
    "backup"=>["isadmin"=>1,"desc"=>"备份博客网站和数据库","short"=>["bk"]],
    "help"=>["isadmin"=>0,"desc"=>"获取命令帮助信息","short"=>["h"]],
    "myopenid"=>["isadmin"=>0,"desc"=>"获取您在这里的唯一编号","short"=>["id"]],
    "seccode"=>["isadmin"=>0,"desc"=>"获取Wordpress博客后台登录验证码","short"=>["code"]],
];
```

数组键值是对应着Command目录下的文件名，比如backup命令的Command文件名称为：admin_backup.php

short为当前命令可用的短命令，便于快速输入和使用。

完成后，即可在微信中测试啦~

**查看demo**

可以关注我部署的订阅号：

![](https://ws4.sinaimg.cn/large/62831495gy1fvxr0cqhknj2076076aaj.jpg)



