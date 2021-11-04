<?php

namespace Modules\Inventory\Database\Factories;

use App\Abstracts\Factory;
use Modules\Inventory\Models\Option as Model;

class Option extends Factory
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
        $type = ['select', 'radio', 'checkbox', 'text', 'textarea'];

        $items[] = [
            'name' => $this->faker->text(5)
        ];

        return [
            'company_id' => $this->company->id,
            'type'       => $this->faker->randomElement($type),
            'name'       => $this->faker->text(5),
            'enabled'    => $this->faker->boolean ? 1 : 0,
            'items'      => $items,
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
