<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inventory;
use App\InventoryOptionGroup;
use Faker\Generator as Faker;

$factory->define(InventoryOptionGroup::class, function (Faker $faker) {
    return [
        'inventory_id' => function () {
            return factory(Inventory::class)->create()->id;
        },
        'name' => $faker->word,
        'title' => $faker->word
    ];
});
