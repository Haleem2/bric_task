<?php

namespace App\Http\Controllers;

use App\Data;
use App\Http\Requests\CustomRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Data::all();
        return view('index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomRequest $request)
    {
        $details =['process'=>'Create query','details'=>'new data created'];
        $data = new Data();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        Mail::to('derk@bric.solutions')->send(new \App\Mail\CrudMail($details));
        return back()->with('success', 'data created successfully');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Data::findOrFail($id);
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Data $data)
    {
        $details =['process'=>'Update query','details'=>'data updated'];
        $input = $request->except('_token');
        if (!$data->update($input))
            return back()->with('error', 'error occured please try again');
        Mail::to('derk@bric.solutions')->send(new \App\Mail\CrudMail($details));
        return back()->with('success', 'data updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        if (!$data->delete())
            return back()->with('error', 'error occured please try again');
        return back()->with('success', 'data deleted successfuly');
    }
}
