# SpyLink

SpyLink is a link shortening application (similar to bitly), with secret features. [more info to come]

Discord: https://discord.gg/wUnjrF

#### View the [project board](https://github.com/marchershey/SpyLink/projects/1) for upcoming/planned features, enhancements, and bug fixes. 

## Getting Started

SpyLink is in it's ALPHA stage. Do not use in production. Feel free to help by forking your own copy and pushing new features.


## Installing

To install your own SpyLink environment, follow the steps below:

1. Navigate to your project folder and copy the project files

```
git clone https://github.com/marchershey/SpyLink.git
```

2. Install the Composer dependencies

```
composer install
```

3. Install the NPM Dependencies

```
npm install
```

5. Create a copy of the .env file

```
cp .env.example .env
```

5. Update the .env file

Open the .env file and update the following:

``` 
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spylink
DB_USERNAME=root
DB_PASSWORD=
```

6. Migrate the database

```
php artisan migrate
```

7. You're done!

## Built With

* [Laravel](https://laravel.com/) - The PHP Framework used
* [Bootstrap](https://getbootstrap.com/) - The front-end component library used
* [Browser.php](https://github.com/cbschuld/Browser.php) - Used to retreive the browser and platform information
* [Free IP Geolocation API](https://freegeoip.app/) - Used to retreive the geolocation data from ip addresses
* Other - all code snippets used inside of classes and functions are credited above the code

## Authors

* **Marc Hershey** - [@marc_hershey](https://twitter.com/marc_hershey) / [github.com/marchershey](https://github.com/marchershey)

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Thank you to the StackOverflow Community for all the help
* Thank you to anyone in the future who creates issues, creates push request, and just helps this project of mine grow. 
