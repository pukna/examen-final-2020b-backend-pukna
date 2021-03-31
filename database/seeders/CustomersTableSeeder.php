<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Vaciar la tabla.
        Customer::truncate();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
        Customer::create([
            'name' => $faker->firstName,
            'lastname' => $faker->lastName,
            'document' => $faker->uuid,
        ]); }
}
}
