Простая система регистрации пользователя в соответствии с заданием.

В принципе по коду все должно быть понятно. Некоторые вещи я документирвоал в коде (если решения казались "странными")

На вашу просьбу: "необходимо использовать коллекции в Postman и экспортированные
коллекции выложить в один репозиторий вместе с проектом" - извините я года три им не пользовался - и совсем все забыл. 
Последний раз он у меня просто перестал запускаться. Вместо этого я пользуюсь возможностями IDE (в данном случае) phpStorm.
Он позволяет делать все, что делает Postman - но при гораздо меньших трудностях. Все запросы, которые запускаются через ide 
находятся в директории ApiRequestForIde. Файл http-client.env.json - содержит данные окружения (хост и токен), 
токен нужно будет изменить после входа или регистрации. 
Если postman некий стандарт - то вспомнить не проблема. 

Запуск проекта:

Есть тонкости в докере на которые не могу найти время для фикса, поэтому принесу неудобства. 
В докер контейнере не могу настроить автоматический запуск `composer update` и `php artisan migrate` 
поэтому приходится после `docker-compose up` заходить непосредственно в контейнер с php
и запускать перечисленные команды.
Т.е. запуск выглядит так:
* `docker-compose up`
* `docker exec -it laravel_test_laravel_php_1 bash` (laravel_test_laravel_php_1 мя контейнера с php)
* и внутри контейнера `composer update` && `php artisan migrate`
* .env файл я оставил специально для трекинга гитом
