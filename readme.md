Clone repository - git clone -b master git@github.com:naviny11/laravel-scheduler.git
Run composer install
Create a new DB - scheduler in your mysql
Rename the .env.example file to .env and update the DB properties as per your configuration
Run the migrations to create tables in the DB - php artisan migrate 
Run the command to initiate the scheduler process - php artisan every30seconds:insert
