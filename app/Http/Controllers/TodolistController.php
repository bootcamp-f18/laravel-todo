<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lists = \App\Todolist::where('user_id', \Auth::id())->orderBy('updated_at', 'desc')->get();
        $lists = \Auth::user()->lists()->orderBy('updated_at', 'desc')->get();
        return view('lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $list = new \App\Todolist;
        $list->name = $request->input('listname');
        $list->user_id = \Auth::id();
        $list->save();

        $request->session()->flash('status', "A new list called <strong>{$list->name}</strong> was added!");
        return redirect('/lists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return "I should show you a list (specifically, number {$id}).";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = \App\Todolist::find($id);
        return view('lists.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $list = \App\Todolist::find($id);
        $list->name = $request->input('listname');
        $list->save();

        $request->session()->flash('status', "The list is now called <strong>{$list->name}</strong>.");
        return redirect('/lists');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $list = \App\Todolist::find($id);
        $list->delete();

        $request->session()->flash('status', "The list called <strong>{$list->name}</strong> was deleted.");
        return redirect('/lists');
    }

    public function confirmDelete($id)
    {
        $list = \App\Todolist::find($id);
        return view('lists.confirmDelete', compact('list'));

    }
}
