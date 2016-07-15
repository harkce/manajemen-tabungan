<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function updatePassword(Request $request) {
    	if ($request->input('password') != $request->input('password_verify')) {
    		$message = 'Password tidak sama.';
    		return redirect('/setting')->with('warning', $message);
    	}
    	$user = User::findOrFail(1);
    	$user->fill([
    		'password' => Hash::make($request->input('password')),
    	])->save();
    	$message = "Password sukses diganti.";
    	return redirect('/setting')->with('success', $message);
    }

    public function viewSetting() {
    	$data = array(
    		'page' => 'setting',
    		);
    	return view('setting.view', $data);
    }
}
