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

        // SQL way (like when we did a pure PHP example)...
        $sql = "
            insert into todolists (name, user_id, created_at, updated_at)
            values ('" . $bob->id . "-Lots of Things To Do', " . $bob->id . ", now(), now())
        ";
        DB::statement($sql);

        // DB facade way...
        foreach ($users as $user) {
            $cdt = Carbon::now()->subDays(7);
            $udt = Carbon::now()->subDays(5);
            DB::table('todolists')->insert([
                'name' => $user->id . '-Old List',
                'user_id' => $user->id,
                'created_at' => $cdt,
                'updated_at' => $udt
            ]);
        }

        // Model way...
        $list = new \App\Todolist;
        $list->name = $janine->id . '-Cookies To Buy';
        $list->user_id = $janine->id;
        $list->save();

    }
}
