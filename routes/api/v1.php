<?php

use Illuminate\Routing\Router;

Route::group(['prefix' => 'order'], function (Router $router) {
    $router->post('/{order}/item', ['uses' => 'Api\\Order\\AddController'])
        ->middleware(['api-with-merchant'])
        ->name('api.order.add');
});
