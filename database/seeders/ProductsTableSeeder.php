<?php

use App\Article;
use App\Product;
use App\Supplier;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla articles.
        Product::truncate();

        $faker = \Faker\Factory::create();

        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear artículos en su nombre
        $users = \App\User::all();

        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            // Y ahora con este usuario creamos algunos articulos

            for ($i = 0; $i < 5; $i++) {
                $product = Product::create([
                    'name' => $faker->firstName,
                    'code' => $faker->uuid,
                    'price' => $faker->randomNumber(2),
                    'status' => 'active',
                    'user_id' => $faker->numberBetween(1, 10),


                ]);
                $product->suppliers()->saveMany(
                    $faker->randomElements(
                        array(
                            Supplier::find(1),
                            Supplier::find(2),
                            Supplier::find(3),
                            Supplier::find(4),
                            Supplier::find(5),
                            Supplier::find(6)
                        ), $faker->numberBetween(1, 6), false
                    )
                );
            }
        }
    }
}
