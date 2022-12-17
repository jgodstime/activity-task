Installation 


Clone the repository

        git clone https://github.com/jgodstime/activity-task.git activityapp

Switch to the repo folder

         cd activityapp

Note: your PHP version should be atleast 8.0

Create db name 

Install all the dependencies using composer

        composer install 

Rename your .env.example file to .env

        cp .env.example .env

Generate a new application key

        php artisan key:generate

Run the database migrations (Set the database connection in .env before migrating)

        php artisan migrate 


Generate admin seeder

        php artisan db:seed --class=AdminSeeder

Admin login credentials
email: admin@gmail.com
password: password


But if you need test users to work with, then run the command below to generate random test users

        php artisan db:seed --class=UserSeeder


You can also go to the postman collection to create user(s)
Collection url: https://documenter.getpostman.com/view/8378011/2s8YzXwfpC#intro


Start the local development server

         php artisan serve 
