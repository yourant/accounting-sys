<?php

namespace Modules\Inventory\Database\Factories;

use App\Abstracts\Factory;
use Modules\Inventory\Models\Item;
use Modules\Inventory\Models\TransferOrder as Model;
use Modules\Inventory\Models\Warehouse;

class TransferOrder extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $source_warehouse = Warehouse::create([
            'company_id'                => $this->company->id,
            'name'                      => $this->faker->text(5),
            'email'                     => $this->faker->email,
            'enabled'                   => $this->faker->boolean ? 1 : 0,
            'default_warehouse'         => true
        ]);

        $destination_warehouse = Warehouse::create([
            'company_id'                => $this->company->id,
            'name'                      => $this->faker->text(5),
            'email'                     => $this->faker->email,
            'enabled'                   => $this->faker->boolean ? 1 : 0,
            'default_warehouse'         => false
        ]);

        $item = Item::create([
            'company_id'                => $this->company->id,
            'item_id'                   => $this->faker->randomNumber(),
            'sku'                       => $this->faker->text(5),
            'opening_stock'             => $this->faker->randomNumber(),
            'opening_stock_value'       => $this->faker->randomNumber(),
            'reoder_level'              => $this->faker->randomNumber(),
            'warehouse_id'              => $source_warehouse->id
        ]);

        return [
            'company_id'                => $this->company->id,
            'transfer_order'            => $this->faker->text(5),
            'reason'                    => $this->faker->text(5),
            'item_id'                   => $item->item_id,
            'date'                      => $this->faker->date(),
            'source_warehouse_id'       => $source_warehouse->id,
            'destination_warehouse_id'  => $destination_warehouse->id,
            'transfer_quantity'         => $this->faker->randomNumber()
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
