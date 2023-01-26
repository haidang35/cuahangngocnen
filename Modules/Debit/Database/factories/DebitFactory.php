<?php

namespace Modules\Debit\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Debit\Enums\DebitStatus;

class DebitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Debit\Entities\Debit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => rand(700, 900),
            'amount' => rand(50000, 10000000),
            'status' => DebitStatus::from(rand(1, 4))->value,
            'deadline' => Carbon::now()->addDays(rand(0, 30)),
            'payment_date' => Carbon::now()->subDays(rand(0, 60)),
            'note' => $this->faker->realText(200)
        ];
    }
}

