<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodolistTest extends TestCase
{
    use RefreshDatabase;

    protected $user = null;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexListsUsersTodolists()
    {
        $list = factory(\App\Todolist::class)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get('/lists');
        $response->assertStatus(200);
        $response->assertSeeText($list->name);
    }

    public function testCanCreateTodolist()
    {
        $response = $this->actingAs($this->user)->post('/lists', ['listname' => 'Test List']);
        $response->assertRedirect('/lists');
        $this->assertDatabaseHas('todolists', ['name' => $this->user->id . '-Test List']);
    }

    public function testCanEditTodolist()
    {
        $list = factory(\App\Todolist::class)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->put(route('lists.update', $list->id), ['listname' => 'Toast list']);
        $response->assertRedirect('/lists');
        $this->assertDatabaseHas('todolists', ['name' => $this->user->id . '-Toast list']);
    }

    public function testCanDeleteTodolist()
    {
        $list = factory(\App\Todolist::class)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete(route('lists.destroy', $list->id));
        $response->assertRedirect('/lists');
        $this->assertDatabaseMissing('todolists', ['name' => $this->user->id . '-' . $list->name]);
    }

    // TODO: should we ensure that a list with items cannot be deleted? We enforce in the UI but may not in controller

    public function testUnauthenticatedUserCannotCreateTodolist()
    {
        $response = $this->post('/lists', ['listname' => 'Test List']);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('todolists', ['name' => 'Test List']);
    }

    // TODO: prevent users from editing other user's lists, then uncomment this test
    // public function testUserCannotEditAnotherUsersTodolist()
    // {
    //     $user2 = factory(\App\User::class)->create();
    //     $list = factory(\App\Todolist::class)->create(['user_id' => $this->user->id]);
    //     $response = $this->actingAs($user2)->put(route('lists.update', $list->id), ['listname' => 'New Name']);
    //     $response->assertStatus(401);
    //     $this->assertDatabaseMissing('todolists', ['name' => $user2->id . '-New Name']);
    // }
}
