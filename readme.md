1. Clone repository - `git clone -b master git@github.com:naviny11/laravel-scheduler. git`
2. Run `composer install`
3. Create a new DB in your mysql
4. Rename the .env.example file to .env and update the DB properties as per your configuration
5. Run the migrations to create tables in the DB - `php artisan migrate` 
6. Run the command to initiate the scheduler process - `php artisan every30seconds:insert` to check the process.

Linux env does not provide feature to set cron for less than a minute. 
Hence the proces has been implemented to run for 75 secs and the cron can be set for every minute.
Once a process has been initiated it will run for 75 secs and if a second process is initiated, it will be exited and not run since the first process is already running.

## Requirements

### PHP >= 7.1.3

### Laravel version = 5.8

### NodeJs

### Composer > 2.0