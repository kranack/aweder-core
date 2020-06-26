<?php

//This handles the magic for the stores
Route::post('/{merchant}/take-away/add-to-order', 'Store\\Orders\\CreateController')
    ->name('store.order.add');
Route::post('/{merchant}/take-away/{order}/submit-order', 'Store\\Orders\\SubmitController')
    ->name('store.order.submit');

Route::get('/{merchant}/take-away/{order}/order-details', 'Store\\Orders\\OrderDetails\\OrderDetailsController')
    ->middleware(['order-belongs-to-merchant'])
    ->name('store.menu.order-details');

Route::post('/{merchant}/take-away/{order}/order-details', 'Store\\Orders\\OrderDetails\\OrderDetailsPostController')
    ->middleware(['order-belongs-to-merchant'])
    ->name('store.menu.order-details.post');

Route::get('/{merchant}/take-away/{order}/payment', 'Store\\Orders\\Payment\\PaymentController')
    ->name('store.menu.payment');

Route::post('/{merchant}/take-away/{order}/payment', 'Store\\Orders\\Payment\\PaymentPostController')
    ->name('store.menu.payment.post');

Route::post('/{merchant}/take-away/{order}/create-intent', 'Store\\Payments\\CreateController')
    ->name('store.payment.create');

Route::get('/{merchant}/take-away/{order}/thanks', 'Store\\Orders\\ThankYouController')
    ->name('store.menu.order-thank-you');

Route::post('/{merchant}/take-away/{order}/remove', 'Store\\Orders\\RemoveItemController')
    ->name('store.menu.remove-item');

Route::get('/{merchant}/take-away/{order?}', 'Store\\Menu\\ViewController')
    ->name('store.menu.view');

Route::get('/{merchant}', function ($merchant) {
        return redirect()->route('store.menu.view', [$merchant]);
});
