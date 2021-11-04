<?php

use App\Models\Auth\User;
use App\Models\Common\Item;
use Faker\Generator as Faker;

$user = User::first();
$company = $user->companies()->first();

$factory->define(Item::class, function (Faker $faker) use ($company) {
    setting()->setExtraColumns(['company_id' => $company->id]);

    $track_inventory[] = 1;
    $items[0] = [
        'opening_stock' => $faker->randomNumber(),
        'opening_stock_value' => $faker->randomNumber(),
        'reoder_level' => $faker->randomNumber(),
        'warehouse_id' => setting('inventory.default.warehouse')
    ];

    return [
        'company_id' => $company->id,
        'name' => $faker->text(10),
        'sku' => $faker->text(5),
        'purchase_price' => $faker->randomFloat(2, 10, 20),
        'sale_price' => $faker->randomFloat(2, 10, 20),
        'category_id' => $company->categories()->item()->get()->random(1)->pluck('id')->first(),
        'tax_id' => null,
        'description' => $faker->text(20),
        'enabled' => $faker->boolean ? 1 : 0,
        'track_inventory' => $track_inventory,
        'items' => $items
    ];
});
