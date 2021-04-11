<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# MLClone
This project consists of a clone of the popular eCommerce website MercadoLibre made with Laravel 6 and Vue.JS 2, it's functionality is limited to:

- Creating and logging into an user account
- Searching through classifieds with the usage of Algolia Instant Search.
- Creating and modifying classifieds by adding a name, description, category, price, and images
- Features a draggable image editor powered by Vue Draggable in the classifieds editor
- Viewing classifieds, with an image gallery that allows zoom-in, as well as viewing the seller's reputation, asking questions, and making purchases.
- Viewing the status of a purchase/sale, talking to the other party via a chat, and leaving them some feedback.
- Viewing and filtering the feedback of any user in the platform by the type.

In order to download this and make use of the app, you can follow the steps here, but fair warning, since the project was made in Laravel 6 with Vue.JS 2, you might find some compatibility issues with Laravel 8 / Vue.JS 3.

1. Clone the repository, either through the git command line or downloading the repository.
2. Cd into the repository
3. Run git checkout
4. Run composer install
5. Run npm install
6. Create the .env file using the .example file
7. Run php artisan key:generate
8. Create the database, add to .env file and run php artisan migrate
9. Create an algolia project and import the keys into the .env and scout.php files to get it working 



