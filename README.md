# Simple CURD App
Laravel + Inertia + VueJS

# Installation 
1. clone the repo.
2. create a `database.sqlite` file in `database` folder if not exists.
3. run the following command `php artisan migrate` (.env file already included/configured for db configuration)
4. run the following command `php artisan key:generate` to generate `APP_KEY`

# Run
1. run the following `php artisan serve` to run the app

# Windows 
Please be sure to enable sqlite form the `.ini` file before executing above or opt for `MySQL`. 

# MySql
To use MySql
1. Create a Database
2. change the following in `.env` file based on Database
```sh 
DB_CONNECTION=sqlite //to mysql
#DB_HOST=127.0.0.1 
#DB_PORT=3306
#DB_DATABASE=
#DB_USERNAME=
#DB_PASSWORD= 
```
3. run `php artisan migrate`
4. run the following command `php artisan key:generate` to generate `APP_KEY`

