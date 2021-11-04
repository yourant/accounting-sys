<?php

namespace Modules\Inventory\Database\Factories;

use App\Abstracts\Factory;
use Modules\Inventory\Models\ItemGroup;

class ItemGroups extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $option_values = [
            (string)$this->faker->randomNumber(3)
        ];

        $items[0] = [
            'name' => $this->faker->text(5),
            'item_id' => $this->faker->randomNumber(),
            'sku' => $this->faker->randomNumber(),
            'option_value_id' => $option_values[0],
            'opening_stock' => $this->faker->randomNumber(),
            'opening_stock_value' => $this->faker->randomNumber(),
            'sale_price' => $this->faker->randomNumber(),
            'purchase_price' => $this->faker->randomNumber(),
            'reorder_level' => $this->faker->randomNumber()
        ];

        return [
            'company_id' => $this->company->id,
            'name' => $this->faker->text(5),
            'category_id' => $this->faker->randomNumber(),
            'option.*.name' => $this->faker->text(5),
            'enabled' => $this->faker->boolean ? 1 : 0,
            'option_id' => $this->faker->randomNumber(),
            'option_values' => $option_values,
            'items' => $items
        ];
    }

    /**
     * Indicate that the model is enabled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function enabled()
    {
        return $this->state([
            'enabled' => 1,
        ]);
    }

    /**
     * Indicate that the model is disabled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function disabled()
    {
        return $this->state([
            'enabled' => 0,
        ]);
    }
}
