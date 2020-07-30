<?php

Route::group(['prefix' => 'v1'], function () {
    require base_path('routes/api/v1.php');
});
