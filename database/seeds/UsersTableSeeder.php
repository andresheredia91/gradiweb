<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'heredia',
            'email' => 'heredia@gmail.com',
            'password' => bcrypt('root'),
        ]);

        factory(App\Models\User::class, 50)->create();
    }
}
