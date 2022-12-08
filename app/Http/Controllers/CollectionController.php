<?php

namespace App\Http\Controllers;

use App\Models\Collection;
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
            'nama'          => ['required', 'string', 'max:255', 'unique:collections,nama_koleksi'],
            'jumlah'        => ['required', 'gt:0'],
            'jenis'         => ['required', 'gt:0']
        ],
        [
            'nama.unique'   => 'Nama koleksi tersebut sudah ada'
        ]
        );
        
        $collection = [
            'nama_koleksi'           => $request->nama,
            'jenis_koleksi'          => $request->jenis,
            'jumlah_awal'            => $request->jumlah,
            'jumlah_sisa'            => $request->jumlah,
            'jumlah_keluar'          => 0
        ];

        // return redirect()->route("koleksi");

        DB::table('collections')->insert($collection);
        return view('collection.daftarKoleksi');
    }

    public function show(Collection $collection){
        return view('collection.infoKoleksi', compact('collection'));
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
            'jumlah_awal as jumlah_awal',
            'jumlah_sisa as jumlah_sisa',
            'jumlah_keluar as jumlah_keluar'
        )
        ->orderBy('nama_koleksi', 'asc')
        ->get();

        return DataTables::of($collections)
        ->addColumn('action', function ($collection){
            $html = '
            <a href="'.url('koleksiView')."/".$collection->id.'">
                <i class="fas fa-edit"></i>
            </a>
            ';
            return $html;
        })
        ->make(true);
    }

    public function update(Request $request) {
        $request->validate([
            'jenis'         => ['required', 'gt:0'],
            'jumlah_sisa'   => ['required', 'gt:0'],
            'jumlah_keluar' => ['required', 'gt:0']
        ]);
        $affected = DB::table('collections')
        ->where('id', $request->id)
        ->update([
            'jenis_koleksi'         => $request->jenis,
            'jumlah_sisa'   => $request->jumlah_sisa,
            'jumlah_keluar' => $request->jumlah_keluar
        ]);

        return view('collection.daftarKoleksi');
    }
}
