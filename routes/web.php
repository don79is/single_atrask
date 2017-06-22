<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'menu'], function (){
    Route::get('/',['as' => 'app.menu.index','uses' => 'FrontEndController@index']);
    Route::get('/{lang}/pages/{slug}', ['as' => 'app.menu.show', 'uses' => 'FrontEndController@show']);

});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin-check']], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', ['as' => 'app.categories.index', 'uses' => 'VRCategoriesController@adminIndex']);
        Route::get('/create', ['as' => 'app.categories.create', 'uses' => 'VRCategoriesController@adminCreate']);
        Route::post('/create', ['as' => 'app.categories.store', 'uses' => 'VRCategoriesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.categories.edit', 'uses' => 'VRCategoriesController@adminEdit']);
            Route::post('/edit', ['as' => 'app.categories.update', 'uses' => 'VRCategoriesController@adminUpdate']);
            Route::get('/', ['as' => 'app.categories.show', 'uses' => 'VRCategoriesController@adminShow']);
            Route::delete('/', ['as' => 'app.categories.delete', 'uses' => 'VRCategoriesController@adminDestroy']);
        });
        Route::group(['prefix' => 'translations'], function () {
            Route::get('/', ['as' => 'app.translations.index', 'uses' => 'VRCategoriesTranslationsController@adminIndex']);
            Route::get('/create', ['as' => 'app.translations.create', 'uses' => 'VRCategoriesTranslationsController@adminCreate']);
            Route::post('/create', ['as' => 'app.translations.store', 'uses' => 'VRCategoriesTranslationsController@adminStore']);
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'app.translations.edit', 'uses' => 'VRCategoriesTranslationsController@adminEdit']);
                Route::post('/edit', ['as' => 'app.translations.update', 'uses' => 'VRCategoriesTranslationsController@adminUpdate']);
                Route::get('/', ['as' => 'app.translations.show', 'uses' => 'VRCategoriesTranslationsController@adminShow']);
                Route::delete('/', ['as' => 'app.translations.delete', 'uses' => 'VRCategoriesTranslationsController@adminDestroy']);
            });
        });
    });
    Route::group(['prefix' => 'language'], function () {
        Route::get('/', ['as' => 'app.language.index', 'uses' => 'VRLanguageCodesController@adminIndex']);
        Route::get('/create', ['as' => 'app.language.create', 'uses' => 'VRLanguageCodesController@adminCreate']);
        Route::post('/create', ['as' => 'app.language.store', 'uses' => 'VRLanguageCodesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.language.edit', 'uses' => 'VRLanguageCodesController@adminEdit']);
            Route::post('/edit', ['as' => 'app.language.update', 'uses' => 'VRLanguageCodesController@adminUpdate']);
            Route::get('/', ['as' => 'app.language.show', 'uses' => 'VRLanguageCodesController@adminShow']);
            Route::delete('/', ['as' => 'app.language.delete', 'uses' => 'VRLanguageCodesController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', ['as' => 'app.menu.index', 'uses' => 'VRMenuController@adminIndex']);
        Route::get('/create', ['as' => 'app.menu.create', 'uses' => 'VRMenuController@adminCreate']);
        Route::post('/create', ['as' => 'app.menu.store', 'uses' => 'VRMenuController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.menu.edit', 'uses' => 'VRMenuController@adminEdit']);
            Route::post('/edit', ['as' => 'app.menu.update', 'uses' => 'VRMenuController@adminUpdate']);
            Route::get('/', ['as' => 'app.menu.show', 'uses' => 'VRMenuController@adminShow']);
            Route::delete('/', ['as' => 'app.menu.delete', 'uses' => 'VRMenuController@adminDestroy']);
        });
        Route::group(['prefix' => 'translations'], function () {
            Route::get('/', ['as' => 'app.translations.index', 'uses' => 'VRMenuTranslationsController@adminIndex']);
            Route::get('/create', ['as' => 'app.translations.create', 'uses' => 'VRMenuTranslationsController@adminCreate']);
            Route::post('/create', ['as' => 'app.translations.store', 'uses' => 'VRMenuTranslationsController@adminStore']);
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'app.translations.edit', 'uses' => 'VRMenuTranslationsController@adminEdit']);
                Route::post('/edit', ['as' => 'app.translations.update', 'uses' => 'VRMenuTranslationsController@adminUpdate']);
                Route::get('/', ['as' => 'app.translations.show', 'uses' => 'VRMenuTranslationsController@adminShow']);
                Route::delete('/', ['as' => 'app.translations.delete', 'uses' => 'VRMenuTranslationsController@adminDestroy']);
            });
        });
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', ['as' => 'app.order.index', 'uses' => 'VROrderController@adminIndex']);
        Route::get('/create', ['as' => 'app.order.create', 'uses' => 'VROrderController@adminCreate']);
        Route::post('/create', ['as' => 'app.order.store', 'uses' => 'VROrderController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.order.edit', 'uses' => 'VROrderController@adminEdit']);
            Route::post('/edit', ['as' => 'app.order.update', 'uses' => 'VROrderController@adminUpdate']);
            Route::get('/', ['as' => 'app.order.show', 'uses' => 'VROrderController@adminShow']);
            Route::delete('/', ['as' => 'app.order.delete', 'uses' => 'VROrderController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', ['as' => 'app.pages.index', 'uses' => 'VRPagesController@adminIndex']);
        Route::get('/create', ['as' => 'app.pages.create', 'uses' => 'VRPagesController@adminCreate']);
        Route::post('/create', ['as' => 'app.pages.store', 'uses' => 'VRPagesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.pages.edit', 'uses' => 'VRPagesController@adminEdit']);
            Route::post('/edit', ['as' => 'app.pages.update', 'uses' => 'VRPagesController@adminUpdate']);
            Route::get('/', ['as' => 'app.pages.show', 'uses' => 'VRPagesController@adminShow']);
            Route::delete('/', ['as' => 'app.pages.delete', 'uses' => 'VRPagesController@adminDestroy']);
        });
        Route::group(['prefix' => 'translations'], function () {
            Route::get('/', ['as' => 'app.translations.index', 'uses' => 'VRPagesTranslationsController@adminIndex']);
            Route::get('/create', ['as' => 'app.translations.create', 'uses' => 'VRPagesTranslationsController@adminCreate']);
            Route::post('/create', ['as' => 'app.translations.store', 'uses' => 'VRPagesTranslationsController@adminStore']);
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'app.translations.edit', 'uses' => 'VRPagesTranslationsController@adminEdit']);
                Route::post('/edit', ['as' => 'app.translations.update', 'uses' => 'VRPagesTranslationsController@adminUpdate']);
                Route::get('/', ['as' => 'app.translations.show', 'uses' => 'VRPagesTranslationsController@adminShow']);
                Route::delete('/', ['as' => 'app.translations.delete', 'uses' => 'VRPagesTranslationsController@adminDestroy']);
            });
        });
    });
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', ['as' => 'app.permissions.index', 'uses' => 'VRPermissionsController@adminIndex']);
        Route::get('/create', ['as' => 'app.permissions.create', 'uses' => 'VRPermissionsController@adminCreate']);
        Route::post('/create', ['as' => 'app.permissions.store', 'uses' => 'VRPermissionsController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.permissions.edit', 'uses' => 'VRPermissionsController@adminEdit']);
            Route::post('/edit', ['as' => 'app.permissions.update', 'uses' => 'VRPermissionsController@adminUpdate']);
            Route::get('/', ['as' => 'app.permissions.show', 'uses' => 'VRPermissionsController@adminShow']);
            Route::delete('/', ['as' => 'app.permissions.delete', 'uses' => 'VRPermissionsController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'reservations'], function () {
        Route::get('/', ['as' => 'app.reservations.index', 'uses' => 'VRReservationsController@adminIndex']);
        Route::get('/create', ['as' => 'app.reservations.create', 'uses' => 'VRReservationsController@adminCreate']);
        Route::post('/create', ['as' => 'app.reservations.store', 'uses' => 'VRReservationsController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.reservations.edit', 'uses' => 'VRReservationsController@adminEdit']);
            Route::post('/edit', ['as' => 'app.reservations.update', 'uses' => 'VRReservationsController@adminUpdate']);
            Route::get('/', ['as' => 'app.reservations.show', 'uses' => 'VRReservationsController@adminShow']);
            Route::delete('/', ['as' => 'app.reservations.delete', 'uses' => 'VRReservationsController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'resources'], function () {
        Route::get('/', ['as' => 'app.resources.index', 'uses' => 'VRResourcesController@adminIndex']);
        Route::get('/create', ['as' => 'app.resources.create', 'uses' => 'VRResourcesController@adminCreate']);
        Route::post('/create', ['as' => 'app.resources.store', 'uses' => 'VRResourcesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.resources.edit', 'uses' => 'VRResourcesController@adminEdit']);
            Route::post('/edit', ['as' => 'app.resources.update', 'uses' => 'VRResourcesController@adminUpdate']);
            Route::get('/', ['as' => 'app.resources.show', 'uses' => 'VRResourcesController@adminShow']);
            Route::delete('/', ['as' => 'app.resources.delete', 'uses' => 'VRResourcesController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', ['as' => 'app.roles.index', 'uses' => 'VRRolesController@adminIndex']);
        Route::get('/create', ['as' => 'app.roles.create', 'uses' => 'VRRolesController@adminCreate']);
        Route::post('/create', ['as' => 'app.roles.store', 'uses' => 'VRRolesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.roles.edit', 'uses' => 'VRRolesController@adminEdit']);
            Route::post('/edit', ['as' => 'app.roles.update', 'uses' => 'VRRolesController@adminUpdate']);
            Route::get('/', ['as' => 'app.roles.show', 'uses' => 'VRRolesController@adminShow']);
            Route::delete('/', ['as' => 'app.roles.delete', 'uses' => 'VRRolesController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'app.users.index', 'uses' => 'VRUsersController@adminIndex']);
        Route::get('/create', ['as' => 'app.users.create', 'uses' => 'VRUsersController@adminCreate']);
        Route::post('/create', ['as' => 'app.users.store', 'uses' => 'VRUsersController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/edit', ['as' => 'app.users.edit', 'uses' => 'VRUsersController@adminEdit']);
            Route::post('/edit', ['as' => 'app.users.update', 'uses' => 'VRUsersController@adminUpdate']);
            Route::get('/', ['as' => 'app.users.show', 'uses' => 'VRUsersController@adminShow']);
            Route::delete('/', ['as' => 'app.users.delete', 'uses' => 'VRUsersController@adminDestroy']);
        });
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



