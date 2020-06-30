<?php

//This handles the magic for the stores
Route::post('/{merchant}/table-order/add-to-order', 'Store\\Orders\\CreateController')
    ->name('store.table-order.order.add');
Route::post('/{merchant}/table-order/{order}/submit-order', 'Store\\Orders\\SubmitController')
    ->name('store.table-order.order.submit');

Route::get('/{merchant}/table-order/{order}/order-details', 'Store\\Orders\\OrderDetails\\OrderDetailsController')
    ->middleware(['order-belongs-to-merchant'])
    ->name('store.table-order.menu.order-details');

Route::post('/{merchant}/table-order/{order}/order-details', 'Store\\Orders\\OrderDetails\\OrderDetailsPostController')
    ->middleware(['order-belongs-to-merchant'])
    ->name('store.table-order.menu.order-details.post');

Route::get('/{merchant}/table-order/{order}/payment', 'Store\\Orders\\Payment\\PaymentController')
    ->name('store.table-order.menu.payment');

Route::post('/{merchant}/table-order/{order}/payment', 'Store\\Orders\\Payment\\PaymentPostController')
    ->name('store.table-order.menu.payment.post');

Route::post('/{merchant}/table-order/{order}/create-intent', 'Store\\Payments\\CreateController')
    ->name('store.table-order.payment.create');

Route::get('/{merchant}/table-order/{order}/thanks', 'Store\\Orders\\ThankYouController')
    ->name('store.table-order.menu.order-thank-you');

Route::post('/{merchant}/table-order/{order}/remove', 'Store\\Orders\\RemoveItemController')
    ->name('store.table-order.menu.remove-item');

Route::get('/{merchant}/table-order/{order?}', 'Store\\Menu\\ViewController')
    ->name('store.table-order.menu.view');
