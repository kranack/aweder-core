<?php

use Illuminate\Routing\Router;

Route::group(['prefix' => 'order'], function (Router $router) {
    $router->post('/', ['uses' => 'Api\\Order\\CreateController'])
        ->name('api.order.create');
    $router->post('/{order}/item', ['uses' => 'Api\\Order\\AddController'])
        ->name('api.order.add');
});
