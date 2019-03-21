<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::truncate();
        $roles = ['superuser', 'administrator', 'member'];
        foreach ($roles as $role) {
            User::create([
                'name' => ucfirst($role),
                'email' => $role . '@system.com',
                'password' => 'password',
                'phone' => $faker->tollFreePhoneNumber,
            ]);
        }

        factory(App\User::class, 50)->create();
    }
}
