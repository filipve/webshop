## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

# We Dew Lawns

Welcome to the *Easy E-Commerce Using Laravel and Stripe: Selling Products and Subscriptions* companion project.

## Installation

You should be able to run a local instance of the WeDewLawns.com website by following a few simple steps:

* Run `composer install` from inside the project root directory to install the package dependencies.
* Copy the `.env.example` file to `.env` and update the various relevant configuration settings.
* Execute `php artisan migrate:install` to install the database tables. Make sure you create the project database first (having the same name as that used in the `.env` file), because Laravel will not create it for you.
* Execute `php artisan db:seed` to install the seed data.
	
Configure your local web server to reference the project. You could alternatively use Laravel Homestead, or even use the native PHP web server (`php artisan serve`).

## Image Credits 

The WeDewLawns.com companion website uses two photos taken by [AdamKR](https://www.flickr.com/photos/adamkr/) and [~lzee~by~the~Sea~is~not~really~all~here~](https://www.flickr.com/photos/77108378@N06/), respectively. Further details regarding the two photos are available via the following links:

* [lawn.jpg](https://www.flickr.com/photos/adamkr/4507810159/in/photolist-7SkGUP-kwDzU-h4fgGJ-9pEbxe-7HrmV1-a4mr9F-oewKYZ-h4gMRY-h4gxUS-692irQ-4gEdnq-7XW6Vk-c61vkG-kx3mo-bjup6Q-ktm8BH-4aW9CX-ouWTh-ktkrnX-aUPTHe-57ZpqM-6NetV2-6rRN7N-egFA9U-cG1fgC-4iFXhu-docNQ9-ktm7Le-5X6x6T-fdwLTh-ktku3X-5X6Q4P-9m56PA-niHkAq-9sAuHj-4RU6PW-mzeLc-bPrVsP-oGELe-3o4Jfz-52jjHR-pMKHTJ-7AnDdo-LrFMf-e781RD-p8AHQQ-etM9bx-h4hhiu-2PXaov-eepyo3)
* [blade.jpg](https://www.flickr.com/photos/77108378@N06/16604611047/in/photolist-rihYnn-Ju6fP-qq8Lrt-pQJW1V-rpaLsT-a4tci3-6n95uh-9cYBYt-9dUV9z-f8moN-3gPcy-a3N9iL-9fc2MM-aro1g-36feP-65YUZr-9cHcQa-9dgRfu-9NW9dP-spgVuf-nP9rZF-NCrec-51zjZf-cfNGgd-cgnZvw-aD42PE-9dmT4V-bDfsRU-ewAdy1-6LxfHf-6cfSGm-6WAmK2-8XvRzc-9GWGW6-aSbH4-ufemn-67YqaE-9NYYKU-9dnn9i-9d4AgH-rnw6MQ-9NYYJh-6HrrCK-npi1Eg-6UeUtu-6cfSJG-49Ckgy-fk5vW6-8wWxgs-6HwhxJ) 

## Questions?

E-mail the authors Eric L. Barnes and W. Jason Gilmore at support@easyecommercebook.com.

## Disclaimer

You are free to use this code for educational purposes, however keep in mind this software is provided without warranty of any kind nor expectation it works as anticipated. Bugs can and do creep into software all the time, and you can expect to find a few in this project. Building even a simple e-commerce store is difficult, and you should not just copy and paste code into any project intended to interact with sensitive customer information such as contact details or credit card data.