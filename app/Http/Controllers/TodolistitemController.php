<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodolistitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Here is the item index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Create a new item";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "Save a new item";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Display an item (no edit)";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($list_id, $item_id)
    {
        $item = \App\Todolistitem::find($item_id);
        $list = $item->list()->first();
        return view('items.edit', compact('item', 'list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $list_id, $item_id)
    {
        $item = \App\Todolistitem::find($item_id);
        $item->task = $request->input('task');
        $item->is_completed = $request->has('is_completed') ? true: false;
        $item->save();
        $request->session()->flash('status', "Task <strong>{$item->task}</strong> was updated!");
        return redirect("/lists/{$item->todolist_id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "Delete an item";
    }

    public function confirmDelete($id) {
        return "Confirming the deletion of an item";
    }

}
