<?php

use App\Supplier;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();
        $faker = \Faker\Factory::create();

        // Crear la misma clave para todos los usuarios
        // conviene hacerlo antes del for para que el seeder
        // no se vuelva lento.
        $password = Hash::make('123123');
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@prueba.com',
            'password' => $password,
        ]);

        // Generar algunos usuarios para nuestra aplicacion
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);


            $user->suppliers()->saveMany(
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
