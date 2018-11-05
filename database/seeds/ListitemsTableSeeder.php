<?php

use Illuminate\Database\Seeder;

class ListitemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Make a user
        $user = new \App\User;
        $user->name = 'Chuck';
        $user->email = "chuck@chuck.chuck";
        $user->password = bcrypt('chuck');
        $user->save();

        // Make a list
        $list = new \App\Todolist;
        $list->name = $user->id . '-Homework for Class';
        $list->user_id = $user->id;
        $list->save();

        // Make list items
        $tasks = [
            'Eat Oreos',
            'Drink milk',
            'Meeting with Bob',
            'Take a nap',
            'Work on final project'
        ];

        foreach($tasks as $task) {
            $item = new \App\Todolistitem;
            $item->task = $task;
            $list->items()->save($item);
        }

    }
}
