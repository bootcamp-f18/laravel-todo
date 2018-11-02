<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $janine = \App\User::where('name', 'Janine')->first();
        $bob = \App\User::where('email', 'bob@bob.bob')->first();

        $users = [ $janine, $bob ];

        // SQL way...


        // DB facade way...
        foreach ($users as $user) {
            DB::table('todolists')->insert([
                'name' => $user->id . '-Grocery List',
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        // Model way...
        $list = new \App\Todolist;
        $list->name = $janine->id . '-Cookies To Buy';
        $list->user_id = $janine->id;
        $list->save();


    }
}
