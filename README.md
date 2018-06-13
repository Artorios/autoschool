### How do I get set up? ###

* Installation:
	* install docker and docker-compose
	* `$ cp docker-compose.example.yml docker-compose.yml`
	* adjust your configurations im docker-compose.yml file
	* `$ docker-compose up -d`
	* `$ npm i && npm watch`
	* Create .env file from source
	* `$ docker-compose exec php-fpm composer install`
	* `$ docker-compose exec php-fpm php artisan key:gen`
	* `$ docker-compose exec mysql sh`
	* `$ mysql -u root -proot_passw -h 127.0.0.1 app_db < database/geo-data.sql`
	* `$ cd public && bower i` (for AdminLTE template)
	* `$ docker-compose exec php-fpm php artisan migrate`
	* `$ docker-compose exec php-fpm php artisan db:seed`
	
* Done...

### Vuejs commands (webpack) ###

* Vue app build
	* npm run dev        (development build mode)
	* npm run watch      (live watcher)
	* npm run production (production build mode)
	* npm run hot        (hot reload)

### Ссылки ###

* /admin - Главная
* /admin/users - Пользователи
* /admin/schools - Список автошкол
* /admin/login - авторизация
* /logout - выход

### Ссылки на сайте ###
* / - Главная
* /registration - страница регистрации


### Доступы ###

* Сидер создает пользователя с ролью админ
* login: admin@gmail.com
* password: adminadmin

### Stripe ###
* Надо зарегистрироваться на https://dashboard.stripe.com/register
и получить STRIPE_SECRET и STRIPE_KEY в разделе https://dashboard.stripe.com/account/apikeys
* Прописать их в файле .env
* В разделе https://stripe.com/docs/api#create_card_token получить номер карточки и cvc для тестирования

### Scout ###
* php artisan scout:import "App\User\User"