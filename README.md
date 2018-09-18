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

Publish the migrations and commands 
```
$ php artisan vendor:publish -tag=migrations
$ php artisan vendor:publish -tag=commands

```

Then run 
```
$ php artisan migrate
```

Generate WPM controller, views and routes
```
$ php artisan make:wpm 
```
```
$ php artisan make:wpm --views (Only scaffold the wpm views), 
$ php artisan make:wpm --force (Overwrite existing files by default)
```

###### Views, Controller and Routes are now published and it can be customized based on the project requirement.
###### Views include `layouts\app` blade; ignore include if there is no such layout blade.
###### Check the `routes\web.php` to find the admin routes.

## Usage
Create new page in admin and publish it. To invoke the page, use the system-generated page slug and specify the view file (optional) to be rendered. If the view file is not specified the default view will be `wpm\static`.
```
WebPage::bind('slug', 'path\to\view')
```

Example:
Create a new page with title 'About Us'. Go to Web Pages List and copy the slug 'about-us'.
Then create new route
```
Route::get('/about', function () {
	return WebPage::bind('about-us');
});
```

