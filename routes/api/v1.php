<?php

use Illuminate\Routing\Router;

Route::group(['prefix' => 'order'], function (Router $router) {
    $router->post('/', ['uses' => 'Api\\Order\\CreateController'])
        ->name('api.order.create');
    $router->post('/{order}/item', ['uses' => 'Api\\Order\\AddController'])
        ->name('api.order.add');
    $router->get('/{order}', ['uses' => 'Api\\Order\\ShowController'])
        ->name('api.order.show');
    $router->post('/{order}/table', ['uses' => 'Api\\Order\\UpdateTableController'])
        ->name('api.order.table');
    $router->patch('/{order}/item/{itemId}', ['uses' => 'Api\\Order\\UpdateItemController'])
        ->name('api.order.item.update');
    $router->delete('/{order}/item/{itemId}', ['uses' => 'Api\\Order\\DeleteItemController'])
        ->name('api.order.item.delete');
    $router->post('/{order}/status', ['uses' => 'Api\\Order\\UpdateStatusController'])
        ->name('api.order.status.update');
});

Route::group(['prefix' => 'merchant'], function (Router $router) {
    $router->get('/{merchant}/openinghours', ['uses' => 'Api\\Merchant\\ShowOpeningHoursController'])
        ->name('api.merchant.openinghours.show');
    $router->post('/{merchant}/openinghours', ['uses' => 'Api\\Merchant\\UpdateOpeningHoursController'])
        ->name('api.merchant.openinghours.update');
});
