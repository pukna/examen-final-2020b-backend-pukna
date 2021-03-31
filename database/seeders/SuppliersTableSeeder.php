<?php

use App\Supplier;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla categories
        Supplier::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 6; $i++) {
            Supplier::create([
                'name' => $faker->word,
                'registered_by' => $faker->numberBetween(1, 10),

            ]);
        }
    }
}
