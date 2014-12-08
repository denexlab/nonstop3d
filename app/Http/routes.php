<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
 *  Set up locale and locale_prefix if other language is selected
*/
if (in_array(Request::segment(1), Config::get('app.support_locales'))
    and (Request::segment(1) != Config::get('app.fallback_locale'))){

    App::setLocale(Request::segment(1));
    Config::set('app.locale_prefix', Request::segment(1));

}

/*
 * Set up route patterns - patterns will have to be the same as in translated route for current language
 */

foreach(Lang::get('routes') as $k => $v) {
    Route::pattern($k, $v);
}

Route::get('/translate/{locale}', 'ChangeLocaleController@update');


/*
 * Start routing with language preferences
 */


//Route::group(['prefix' => Config::get('app.locale_prefix'), 'middleware' => 'locale_helper'], function()
Route::group(['prefix' => Config::get('app.locale_prefix')], function()
{

    Route::get(
        '/',
        'WelcomeController@index'
    );


    Route::get(
        '/{home}/',
        'HomeController@index'
    )->where('home', Lang::get('routes.home'));


    Route::get(
        '/{contact}/',
        function () {
            return "contact page ".App::getLocale();
        }
    )->where('contact', Lang::get('routes.contact'));


    Route::get(
        '/{about}/',
        function () {
            return "about page ".App::getLocale();

        }
    )->where('about', Lang::get('routes.about'));


    /*
    |--------------------------------------------------------------------------
    | Authentication & Password Reset Controllers
    |--------------------------------------------------------------------------
    |
    | These two controllers handle the authentication of the users of your
    | application, as well as the functions necessary for resetting the
    | passwords for your users. You may modify or remove these files.
    |
    */

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);


});




