<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About From App

Form app can used to create dynamic forms by admin and forms will be available for users in public:

Do these steps to run application in local

- Pull the code
- Configure database, sample of env included as .env.sample
- Run composer update
- Run php artisan migrate
- Run php artisan db:seed
- Login as admin, email : admin@formapp.com, password : 12345678
- Go to Manage Form, which will list all form which been created
- Click Add New to create a new form, this will redirect you to add new form page
- Enter Title and instruction, then click save form template
- After form template is saved, admin will be shown with input lists and a new add form input button
- Click Add form input to create new form input elements
- Click save input form to save new input field
- Once saved corresponding data will be reflected in table
- Edit and delete options will be shown for all input field inside a form
- Click View forms tab on sibebar menu to see all form listing and view each form
