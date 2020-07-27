<?php

use Illuminate\Routing\Router;

Route::group(['prefix' => 'order'], function (Router $router) {
    $router->post('/{order}/add', ['uses' => 'Api\\Order\\AddController'])
        ->middleware(['api-with-merchant'])
        ->name('api.order.add');
});
