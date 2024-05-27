## Развертывание с помощью Docker (рекомендуемый)

Запуск проекта на контейнерах Docker позволяет настроить работу веб-сервиса без установки
и конфигурации MySQL, PHP непосредственно на сервере.

Файл конфигурации докер - docker-compose.yml. В нем также содержатся параметры доступа
базы данных MySQL. Для сборки необходимых контейнеров(MySQL, PHP-FPM, NGINX) 
запускается команда `docker compose build`, для запуска самих контейнеров в работу 
команда `docker compose up -d`.

После запуска контейнеров нужно проверить выполнение команд внутри контейнера fpm для 
установки зависимостей и развертывания Laravel. Войти в командную строку внутри контейнера
`docker exec -it fpm bash` и там выполнить `php artisan optimize`. Если выполнится без 
ошибок - значит развертывание прошло успешно.

При развертывании, в зависимости от настроек среды выполнения, все может пойти не так 
гладко и потребуется помощь devops`a. В случае проблем, если нет своего сисадмина или 
devops-инженера, можно обращаться - [telegram](https://t.me/weblanceur) или 
[vkontakte](https://vk.com/weblanceur) В телеграм предпочтительнее.

## Развертывание на сервере с установленным PHP, MySQL
Если не нужен Docker или проще работать с обычным LAMP, LEMP сервером или иным с 
установленными PHP и MySQL (или другой БД). Настройка веб-сервера с PHP производится 
направлением запросов в папку laravel/public. Настройка доступа приложения к БД описывается
в конфигурационных файлах laravel/config/database.php и в файле laravel/.env (образец - 
laravel/.env.example)

[Документация Laravel](https://laravel.com/docs/11.x/)