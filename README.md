## File Sharing

## Предпосылки

Для запуска этого проекта у вас должно быть установлено:
* PHP 8.3
* Composer
* npm

## Инсталляция

Скачать GitHub хранилище локально:
```sh
git clone https://github.com/nadyafedotova/filesharing.git
```

Запустите сборку docker-а
```sh
docker-compose -f docker-compose.dev.yml up --build -d
```

Перейдите в папку проекта, в папку app и установите зависимости Composer, выполнив:

```sh
$ composer install
```

Установите зависимости npm:
```sh
$ npm install
```

Скопируйте содержимое файла `.env.example` в новый файл `.env`:
```sh
$ cp .env.example .env
```

Запустите комманду
```sh
docker exec -ti filesharing_php bash
```
для доступа к проекту

Создайте ключ шифрования приложения:
```sh
$ ./artisan key:generate
```

Создайте пустую базу данных и заполните `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` и `DB_PASSWORD` поля в `.env` 
файл, чтобы соответствовать учетным данным вашей вновь созданной базы данных.

Запустите миграции:

```sh
$ ./artisan migrate
```

Создайте символическую ссылку из `public/storage` на `storage/app/public`:
```sh
$ ./artisan storage:link
```

Запустить npm:
```sh
$ npm run watch
```

Запустить localhost и перейти по ссылке `http://127.0.0.1`:
```sh
$ ./artisan serve
```

## Характеристики
* Загрузка файла AJAX (включена поддержка перетаскивания)
* Анонимные загрузки
* Предварительный просмотр для файлов изображений
* Просмотр недавно загруженных файлов. Скачивание файлов. Удаление файлов
* Просмотр определенной страницы файла. Скачивание файла
