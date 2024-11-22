## Pre-install #
Скопировать .env из .env.example:
```
cp ./.env.example ./.env && cp ./backend/.env.example ./backend/.env
```
И заполнить переменные внутри этих файлов:
- ./.env
- ./backend/.env.example


## Install #
Запустить проект в docker-контейнерах, вызвав команду из корня проекта:
```
docker compose up -d
```


## Post-install #
Выполнить для сборки frontend'а:
```
docker compose run npm npm i && docker compose run npm npm run build
```

Для выполнения миграций в laravel:
```
docker compose exec -i app php artisan migration
```

Для первичного импорта сделок их Amo:
```
docker compose exec -i app php artisan import:deals
```
