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
    public function index($list_id, $item_id)
    {
        return redirect("/lists/$list_id");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($list_id)
    {
        $list = \App\Todolist::find($list_id);
        return view('items.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $list_id)
    {
        $item = new \App\Todolistitem;
        $item->task = $request->input('task');
        $item->is_completed = $request->has('is_completed') ? true: false;
        $item->todolist_id = $list_id;
        $item->save();
        $request->session()->flash('status', "Task <strong>{$item->task}</strong> was added!");
        return redirect("/lists/{$item->todolist_id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($list_id, $item_id)
    {
        return redirect("/lists/$list_id");
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
    public function destroy(Request $request, $list_id, $item_id)
    {
        $item = \App\Todolistitem::find($item_id);
        $item->delete();
        $request->session()->flash('status', "Task <strong>{$item->task}</strong> was deleted!");
        return redirect("/lists/{$item->todolist_id}");
    }

    public function confirmDelete($list_id, $item_id) {
        $item = \App\Todolistitem::find($item_id);
        return view('items.confirmDelete', compact('item'));
    }

}
