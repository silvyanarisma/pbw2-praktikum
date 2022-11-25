<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){
        return view('user.daftarPengguna');
    }

    public function create(){
        return view('user.registrasi');
    }

    public function getAllUsers() {
        $users = DB::table('users')
        ->select(
            'id as id',
            'fullname as fullname',
            'email as email',
            'username as username',
            'address as address',
            'phone_number as phone_number',
            'birth_date as birth_date',
        )
        ->orderBy('fullname', 'asc')
        ->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user){
            $html = '
            <a href="'.url('userView')."/".$user->id.'">
                <i class="fas fa-edit"></i>
            </a>
            ';
            return $html;
        })
        ->make(true);
    }

    public function store(Request $request){
        //dd($request->all());
        
        $request->validate([
            'username'          => ['required', 'string', 'max:255', 'unique:users'],
            'fullname'          => ['required', 'string', 'max:255'],
            'email'             => ['email'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'address'           => ['required', 'string'],
            'birth_date'        => ['required', 'date', 'before:today'],
            'phone_number'      => ['required']
        ],
        [
            'username.required' => 'Username harus diisi',
            'username.unique'   => 'Username telah digunakan',
            'birth_date.before' => 'Tanggal lahir harus diisi'
        ]);

        $user = [
            'username'      => $request->username,
            'fullname'      => $request->fullname,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'address'       => $request->address,
            'birth_date'    => $request->birth_date,
            'phone_number'  => $request->phone_number,
        ]; 

        // return redirect()->route("user");

        DB::table('users')->insert($user);
        return view('user.daftarPengguna');
    }

    public function show(User $user){
        return view('user.infoPengguna', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'fullname'      => ['required'],
            'password'      => ['nullable'],
            'address'       => ['required'],
            'phone_number'  => ['required']

        ]);
        $affected = DB::table('users')
        ->where('id', $request->id)
        ->update([
            'fullname'      => $request->fullname,
            'address'       => $request->address,
            'phone_number'  => $request->phone_number
        ]);

        if($request->password){
            $affected = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password'      => Hash::make($request->password),
            ]);
        }

        return view('user.daftarPengguna');
    }
}
