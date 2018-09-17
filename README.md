# jithin/cubet-wpm
Web Page Manager: A laravel package to manage static content pages like about, privacy policy etc.
## Installation ##

```
$ composer require jithin/cubet-wpm
```

Open config/app.php, Add the Service Provider
```
jithin\CubetWpm\WebPageProvider::class,
```

Add the Facade to your aliases
```
'WebPage' => jithin\CubetWpm\Facades\WebPage::class,
```
Publish the migrations, and run 
```
$ php artisan vendor:publish --tag=migrations
$ php artisan migrate
```

Publish the migrations, and run 
```
$ php artisan vendor:publish --tag=views
```

Publish the commands (--views Only scaffold the wpm views, --force Overwrite existing views by default), and run 
```
$ php artisan vendor:publish --tag=commands
$ php artisan make:wpm 
```

###### Views and Controller files are now published and can be edited based on the project requirement.