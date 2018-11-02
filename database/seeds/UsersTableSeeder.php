<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Using the DB facade...
        DB::table('users')->insert([
            'name' => 'Janine',
            'email' => 'jhempy@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Using the user model...
        $user = new \App\User;
        $user->name = 'Bob';
        $user->email = "bob@bob.bob";
        $user->password = bcrypt('bob');
        $user->save();

    }
}
