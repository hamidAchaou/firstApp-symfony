# Symfony

## install
 ```bash
 composer create-project symfony/skeleton:"7.2.x-dev" "name_of_project"
 composer require webapp
 ```

## Run serve
```bash
 php -S localhost:8000 -t public
```
### Create controller :
```bash
php bin/console make:controller
```
## Entity
1. Create
```bash
php bin/console make:entity Recip
```
2. connect databases
```bash
   DATABASE_URL="mysql://username:password@127.0.0.1:3306/db_name?serverVersion=5.7"
```
3. create migration:
```bash
   php bin/console make:migration
```
4. add migration in data bases
```bash
php bin/console doctrine:migrations:migrate
```

## Seeder
5. install DoctrineFixturesBundle
``
```bash
composer require --dev orm-fixtures
```
6. create file seeder
```bash
php bin/console make:fixture
```
7. Load Fixtures into the Database
```bash
php bin/console doctrine:fixtures:load
```