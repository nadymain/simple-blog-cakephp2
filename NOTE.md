#Note

1. core.php -> salt
2. webroot -> .htaccess
	# RewriteCond %{HTTPS} !=on
	# RewriteRule ^/?(.*) https://%{SERVER_NAME}/$1 [R=301,L]
3. webroot -> robots.txt
4. 