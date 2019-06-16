<p align="center">
    <img src="https://raw.githubusercontent.com/duiying/img/master/thinkphp.jpg" height="100px">
    <h1 align="center">gt-project</h1>
    <br>
</p>


基于ThinkPHP3.2框架完成的企业网站CMS系统, 快速搭建可商用的企业网站
### 项目概览
![gt-project](https://raw.githubusercontent.com/duiying/img/master.png)

### 安装
```
1. 克隆项目到本地
2. 修改 Application/Common/Conf/config.php 文件中的数据库配置信息
3. 导入项目根目录下的sql文件
4. 访问后台 localhost/index.php/Admin/Login/index
    超级管理员: admin 123456
    编辑: bianji 123456
    游客: youke 123456
5. 登录后台以后点击更新缓存, 生成前台静态页面
6. 访问前台 localhost
```

### 使用说明
```
1. 由于后台部分插件的兼容性, 为了正常地使用后台管理系统, 推荐使用 360极速浏览器(兼容模式)
2. 前台基本使用HTML+CSS+JS进行手工页面布局, 除了首页的swiper轮播插件, 因此前台代码相当整洁
3. 后台更新友情链接、网站配置等操作, 由于涉及到前台整站的更新, 需要在后台手动点击更新缓存
4. 后台新增文章、幻灯管理等操作, 由于只涉及到前台单页面的更新, 无需在后台手动点击更新缓存, 已经做了自动更新静态页面
``` 

### 如何进行数据库备份
```shell
# 执行crontab命令
crontab -e
# 每隔10分钟备份数据库(php命令所在的地址要用全路径)
*/10 * * * * /usr/sbin/php /opt/lampp/htdocs/livecms/cron.php Admin Cron dump > /dev/null
```

### 后台展示
![后台](https://raw.githubusercontent.com/duiying/img/master/cms-admin.jpg)
### 前台展示
![前台](https://raw.githubusercontent.com/duiying/img/master/cms-index.png)
