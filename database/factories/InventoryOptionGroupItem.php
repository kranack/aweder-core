<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use Faker\Generator as Faker;

$factory->define(InventoryOptionGroupItem::class, function (Faker $faker) {
    return [
        'inventory_option_group_id' => function () {
            return factory(InventoryOptionGroup::class)->create()->id;
        },
        'name' => $faker->word,
        'price_modified' => 150
    ];
});
