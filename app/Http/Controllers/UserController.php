<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('created_at', 'DSC')->simplePaginate(15);

        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        try {
            $user = User::create($request->all());
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error!!']);
        }
        return redirect()->route('users.index')->withSuccess('sucess');
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
        //
        $user = User::find($id);

        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ]
        ]);

        try {
            $user = User::find($id);
            $user->update($request->except('password', 'password_confirmation'));

            if ($request->has('password') && $request->get('password') != null) {
                $user->update($request->get('password'));
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error!!']);
        }

        return redirect()->route('users.index')->with('update', 'User was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error!!']);
        }

        return redirect()->route('users.index')->with('delete', 'User was deleted successfully!');
    }
}
