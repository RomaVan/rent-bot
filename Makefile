up-debug:
	./spiral serve -v -d -o "http.workers.command=php -d zend_extension=xdebug app.php"
