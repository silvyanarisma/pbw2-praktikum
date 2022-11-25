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
            <center>
                <button
                    data-rowid="" class="btn btn-xs btn-light" data-toggle="tooltip" data-placement="top"
                    data-container="body" title="Edit Koleksi" onclick="infoKoleksi('."'".$user->id."'".')">
                    <i class="fa fa-edit"></i>
                </button>
            </center>
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

        $user = User::create([
            'username'      => $request->username,
            'fullname'      => $request->fullname,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'address'       => $request->address,
            'birth_date'    => $request->birth_date,
            'phone_number'  => $request->phone_number,
        ]); 

        return redirect()->route("user");
    }

    public function show(User $user){
        return view('user.infoPengguna');
    }
}
