<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $data = User::paginate(15);
        return view('superadmin.user.index', compact('data'));
    }

    public function create()
    {
        $role = Role::get();
        return view('superadmin.user.create', compact('role'));
    }
    public function store(Request $req)
    {
        $checkUsername = User::where('username', $req->username)->first();
        if ($checkUsername == null) {
            $role = Role::find($req->role_id);
            $n = new User;
            $n->name = $req->name;
            $n->nama_kelompok = $req->nama_kelompok;
            $n->username = $req->username;
            $n->password = bcrypt($req->password);
            $n->save();

            $n->roles()->attach($role);

            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/user');
        } else {
            Session::flash('error', 'Username sudah ada, silahkan gunakan yang lain');
            return back();
        }
    }
    public function edit($id)
    {
        $role = Role::get();
        $data = User::find($id);
        return view('superadmin.user.edit', compact('role', 'data'));
    }
    public function update(Request $req, $id)
    {
        $role = Role::find($req->role_id);
        $user = User::find($id);
        if ($req->password == null) {
            $user->update(['name' => $req->name, 'nama_kelompok' => $req->nama_kelompok]);
        } else {
            $user->update(['name' => $req->name, 'nama_kelompok' => $req->nama_kelompok, 'password' => bcrypt($req->password)]);
        }
        $user->roles()->sync($role);
        Session::flash('success', 'Berhasil Di update');
        return redirect('/superadmin/user');
    }
    public function delete($id)
    {
        if (User::find($id)->username == 'superadmin') {
            Session::flash('warning', 'Superadmin tidak dapat di hapus');
            return back();
        } else {

            $user = User::find($id)->delete();
            Session::flash('success', 'Berhasil Di hapus');
            return back();
        }
    }
}
