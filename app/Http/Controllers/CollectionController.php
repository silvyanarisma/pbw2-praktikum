<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    public function index(){
        return view('collection.daftarKoleksi');
    }

    public function create(){
        return view('collection.registrasi');
    }

    public function store(Request $request){
        $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'jumlah'        => ['required', 'numeric'],
            'jenis'         => ['required', 'numeric'],
        ]
        );

        $user = Collection::create([
            'nama_koleksi'         => $request->nama,
            'jumlah_koleksi'       => $request->jumlah,
            'jenis_koleksi'        => $request->jenis,
        ]); 

        return redirect()->route("koleksi");
    }

    public function show(User $user){
        return view('collection.infoKoleksi');
    }

    public function getAllCollections() {
        $collections = DB::table('collections')
        ->select(
            'id as id',
            'nama_koleksi as judul',
            DB::raw('
            (CASE
            WHEN jenis_koleksi="1" THEN "Buku"
            WHEN jenis_koleksi="2" THEN "Majalah"
            WHEN jenis_koleksi="3" THEN "Cakram Digital"
            END) AS jenis
            '),
            'jumlah_koleksi as jumlah'
        )
        ->orderBy('nama_koleksi', 'asc')
        ->get();

        return DataTables::of($collections)
        ->addColumn('action', function ($collection){
            $html = '
            <center>
                <button
                    data-rowid="" class="btn btn-xs btn-light" data-toggle="tooltip" data-placement="top"
                    data-container="body" title="Edit Koleksi" onclick="infoKoleksi('."'".$collection->id."'".')">
                    <i class="fa fa-edit"></i>
                </button>
            </center>
            ';
            return $html;
        })
        ->make(true);
    }
}
