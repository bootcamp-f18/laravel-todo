<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Todolist;

class TodolistTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserIdIncludedInName()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);

        $todolist = new Todolist();
        $todolist->name = "Test List";
        $todolist->user_id = $user->id;
        $todolist->save();

        $this->assertDatabaseHas('todolists', ['name' => $user->id . '-Test List']);
    }

    public function testUserIdOmittedWhenNameIsAccessed()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);

        $todolist = new Todolist();
        $todolist->name = "Test List";
        $todolist->user_id = $user->id;
        $todolist->save();

        $this->assertEquals($todolist->name, "Test List");
    }

    public function testCanRetrieveUser()
    {
        $user = factory(\App\User::class)->create();
        $todolist = new Todolist();
        $todolist->name = "Test List";
        $todolist->user_id = $user->id;
        $todolist->save();

        $this->assertEquals($todolist->user->id, $user->id);
    }

    public function testCanRetrieveItems()
    {
        $user = factory(\App\User::class)->create();
        $todolist = new Todolist();
        $todolist->name = "Test List";
        $todolist->user_id = $user->id;
        $todolist->save();

        $item1 = new \App\Todolistitem();
        $item1->task = "Do something";
        $item1->todolist_id = $todolist->id;
        $item1->save();

        $item2 = new \App\Todolistitem();
        $item2->task = "Do something";
        $item2->todolist_id = $todolist->id;
        $item2->save();

        $this->assertEquals($todolist->items->count(), 2);
    }
}
