# vestd-lara-test
Test project for vestd

Please follow the following steps to install
1. Download the repository to local environment
2. Create a mySql database (i.e., `db_vestd_test`)
3. Copy the file `.env-local` to `.env`
4. Run the following commands on terminal
    a. composer install
    b. php artisan key:generate
    c. php artisan storage:link
    d. php artisan migrate
    e. npm install
    f. npm run dev
    
5. Please provide write permissions to `storage` folder. (if required)
6. Run the following commands on terminal
    a. php artisan config:cache
    b. php artisan queue:work
    
General Information regarding this program
1. I used the email driver as `log` therefore email containing archive will be stored in /storage/logs/laravel.log
2. I used two jobs one is for archiving files and another is to send emails.
3. I used storage disk as `public` instead of `S3` as I do not have the S3 bucket.
4. The sample files those to be archived could be found in the folder `\storage\app\public\sample-files`
5. After archiving, the zip file will be created in the folder `\storage\app\public` as I used the public disk.
6. The archive url will be created as per storage_path.


