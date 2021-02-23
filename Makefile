DEFAULT:
	composer install
	yarn
	yarn dev
	php artisan key:generate
	sh build.sh
