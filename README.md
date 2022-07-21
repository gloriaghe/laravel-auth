In web.php scrivo:
 Route::resource('posts', 'Admin\PostController');

Creo model posts:
 php artisan make:model Models/Post


Creo controller:
php artisan make:controller Admin/PostController --resource


Faccio la concatenazione in web.php:
                Route::middleware('auth')
                ->namespace('Admin')
                ->name('admin.')
                ->prefix('admin')
                ->group(function () {
                        Route::get('/', 'AdminController@dashboard')->name('dashboard');
                        Route::resource('posts', 'PostController');
                });
