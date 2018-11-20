# yii2-basic
This is a skeleton web application with user actions. i.e guest, register, forget password, login, logout, remember password, etc. 

1- Make a domain in your hosts file . i.e  `127.0.0.1 yii2-basic.local` 

2- Make the vhost entry in your vhost config file http-vhosts.conf

`    <VirtualHost yii2-basic.local:80>
            DocumentRoot "C:/vhosts/yii2-basic/public_html"
        ServerName yii2-basic.local
    </VirtualHost>`

3-Launch your webserver and visit the url