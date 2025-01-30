# Установка Laravel проекта

Этот проект использует Laravel. Следуйте этим шагам, чтобы настроить приложение локально.

## Требования

- PHP 8.x или выше
- Composer
- MySQL или другая совместимая база данных

## Инструкция по установке

### Шаг 1: Клонировать репозиторий

Для начала клонируйте репозиторий на свой локальный компьютер:

```bash
git clone https://github.com/yohaness421/shop.git
```

### Шаг 2: Установить зависимости

После этого установите все PHP зависимости с помощью Composer:

```bash
composer install
```

### Шаг 3: Установить зависимости

Создайте файл .env на основе .env.example:

```bash
cp .env.example .env
```

### Шаг 4: Генерация ключа приложения

Генерируйте ключ приложения:

```bash
php artisan key:generate
```

### Шаг 5: Настройка базы данных

Откройте файл .env и укажите параметры для подключения к вашей базе данных:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Шаг 6: Запуск миграций и сидеров

Теперь выполните миграции:

```bash
php artisan migrate --seed
```

### Шаг 7: Генерация ключа приложения

Запустите локальный сервер:

```bash
php artisan serve
```