<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('profil.index',compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        Alert::error('Success Update', 'Update');
        return redirect('profil');
    }
}
