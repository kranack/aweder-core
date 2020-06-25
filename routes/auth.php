<?php

use Illuminate\Routing\Router;

Route::middleware(['auth'])->namespace('Auth')
    ->prefix('registration')->group(function (Router $router) {
        $router->get('/opening-hours', ['uses' => 'Registration\\OpeningHours\\SetupController'])
            ->name('registration.opening-hours');
        $router->post('/opening-hours', ['uses' => 'Registration\\OpeningHours\\CreateController'])
            ->name('registration.opening-hours.post');

        $router->get('/categories', ['uses' => 'Registration\\Categories\\SetupController'])
            ->name('registration.categories');
        $router->post('/categories', ['uses' => 'Registration\\Categories\\CreateController'])
            ->name('registration.categories.post');
    });

Route::prefix('register')->namespace('Auth\\Registration\\MultiStep')
    ->group(function (Router $router) {
        $router->namespace('UserDetails')->group(function (Router $router) {
            $router->get('/', ['uses' => 'UserDetails'])
                ->name('register');
            $router->post('/', ['uses' => 'UserDetailsPost'])
                ->name('register.user-details.post');
        });

        $router->namespace('BusinessDetails')
            ->middleware(['auth', 'has-user-completed-registration-stage:2'])
            ->prefix('business-details')
            ->group(function (Router $router) {
                $router->get('/', ['uses' => 'Details'])
                    ->name('register.business-details');
                $router->post('/', ['uses' => 'DetailsPost'])
                    ->name('register.business-details.post');
            });

        $router->namespace('ContactDetails')
            ->middleware(['auth', 'has-user-completed-registration-stage:3'])
            ->prefix('contact-details')
            ->group(function (Router $router) {
                $router->get('/', ['uses' => 'Details'])
                    ->name('register.contact-details');
                $router->post('/', ['uses' => 'DetailsPost'])
                    ->name('register.contact-details.post');
            });

        $router->namespace('BusinessAddress')
            ->middleware(['auth', 'has-user-completed-registration-stage:4'])
            ->prefix('business-address')
            ->group(function (Router $router) {
                $router->get('/', ['uses' => 'Details'])
                    ->name('register.business-address');
                $router->post('/', ['uses' => 'DetailsPost'])
                    ->name('register.business-address.post');
            });
    });

Auth::routes(['verify' => true, 'register' => false]);

Route::get('logout', 'Auth\\LoginController@logout')->name('logout');
