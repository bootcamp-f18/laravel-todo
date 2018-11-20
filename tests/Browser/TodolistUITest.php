<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TodolistUITest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }

    /**
     * Helper method to create a Todolist for the test user
     * @return \App\Todolist
     */
    protected function createList()
    {
        return $this->user->lists()->save(factory(\App\Todolist::class)->make());
    }

    /**
     * @return void
     */
    public function testCanCreateTodolist()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/home')
                    ->clickLink('Go to your Lists')
                    ->assertPathIs('/lists')
                    ->clickLink('Create a new List')
                    ->assertPathIs('/lists/create')
                    ->type('listname', 'Test the UI')
                    ->press('Add List')
                    ->assertPathIs('/lists')
                    ->assertSee('Test the UI');
        });
    }

    public function testCanEditTodolist()
    {
        $list = $this->createList();

        $this->browse(function (Browser $browser) use($list) {
            $browser->loginAs($this->user)
                    ->visit('/lists')
                    ->assertSee($list->name)
                    ->click('@edit-' . $list->id)
                    ->assertPathIs('/lists/' . $list->id . '/edit')
                    ->type('listname', 'Cookies to Eat')
                    ->press('Update List')
                    ->assertPathIs('/lists')
                    ->assertSee('Cookies to Eat');
        });
    }

    public function testCanDeleteTodolist()
    {
        $list = $this->createList();

        $this->browse(function (Browser $browser) use($list) {
            $browser->loginAs($this->user)
                    ->visit('/lists')
                    ->assertSee($list->name)
                    ->click('@delete-' . $list->id)
                    ->assertPathIs(route('lists.confirmDelete', $list->id, false))
                    ->press('Delete List')
                    ->assertPathIs('/lists');

            // our flash message has the list name in it, so we can't assert the name isn't present
            // so check the DB instead
            $this->assertDatabaseMissing('todolists', ['id' => $list->id]);

        });
    }

    public function testCanAddListItemToList()
    {
        $list = $this->createList();

        $this->browse(function (Browser $browser) use($list) {
            $browser->loginAs($this->user)
                    ->visit('/lists')
                    ->click('@items-' . $list->id)
                    ->assertPathIs(route('lists.show', $list->id, false))
                    ->clickLink('Create a new Task')
                    ->assertPathIs(route('items.create', $list->id, false))
                    ->type('task', 'Automate all the things!')
                    ->press('Add Task')
                    ->assertPathIs(route('lists.show', $list->id, false))
                    ->assertSee('Automate all the things!');
        });
    }

    // TODO: test editing and deleting items from a list
    // TODO: would it be cleaner to move item tests to their own file?
}
