<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('contents.data_user');
    }

    public function getDataUser(){
        $userData = User::get();
        return json_encode(array('data'=>$userData));
    }

    public function saveuser(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'level' => 'required',
            'password' => 'required',
        ]);

        if($validation->passes()){
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status'     => 'success',
                'message'   => 'Data Berhasil di Simpan',
            ]);
        }else{
            return response()->json([
                'status'     => 'error',
                'message'   => $validation->errors()->all(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
