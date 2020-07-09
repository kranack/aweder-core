<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inventory;
use App\InventoryVariant;
use Faker\Generator as Faker;

$factory->define(InventoryVariant::class, function (Faker $faker) {
    return [
        'inventory_id' => function () {
            return factory(Inventory::class)->create()->id;
        },
        'name' => $faker->word,
        'price' => 400,
    ];
});
