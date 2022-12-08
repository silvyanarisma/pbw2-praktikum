<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index() {
        return view('transaction.daftarTransaksi');
    }

    public function getAllTransactions() {
        $transactions = DB::table('transactions')
        ->select(
            'transactions.id as id',
            'u1.fullname as peminjam',
            'u2.fullname as petugas',
            'tanggal_pinjam as tanggalPinjam',
            'tanggal_selesai as tanggalSelesai',
        )
        ->join('users as u1', 'id_peminjam', '=', 'u1.id')
        ->join('users as u2', 'id_petugas', '=', 'u2.id')
        ->orderBy('tanggal_pinjam', 'asc')
        ->get();

        return DataTables::of($transactions)
        ->addColumn('action', function ($transaction){
            $html = '
            <a href="'.url('transaksiView')."/".$transaction->id.'">
                <i class="fas fa-edit"></i>
            </a>
            ';
            return $html;
        })
        ->make(true);
    }

    public function create() {
        $users = User::get();
        $collections = Collection::where('jumlah_sisa', '>', 0)->get();
        return view('transaction.transaksiTambah', compact('collections',
        'users'));
    }

    public function store(Request $request) {
        $request->validate([
            'idPeminjam'    => 'required|integer|gt:0',
            'koleksi1'      => 'required|integer|gt:0'
        ], [
            'idPeminjam.gt' => 'Pilih satu species',
            'koleksi1.gt'   => 'Pilih jenis item'
        ]);

        //membuat 1 object transaction dan simpan ke dalam tabel transactions
        $transaction = new Transaction;
        $transaction->id_peminjam = $request->idPeminjam;
        $transaction->id_petugas = auth()->user()->id;
        $transaction->tanggal_pinjam = Carbon::now()->toDateString();
        $transaction->save();
        //menggambil last transaction id untuk digunakan pada proses insert detail transaction
        $lastTransactionIdStored = $transaction->id;

        //membuat object detail transaction dan simpan ke dalam tabel detail_transactions

        //peminjaman koleksi 1
        $detilTransaksi1 = new DetailTransaction;
        $detilTransaksi1->id_transaksi = $lastTransactionIdStored;
        $detilTransaksi1->id_koleksi = $request->koleksi1;
        $detilTransaksi1->status = 1;
        $detilTransaksi1->save();
        //mengurangi jumlah stok
        DB::table('collections')->where('id', $request->koleksi1)->decrement('jumlah_sisa');
        DB::table('collections')->where('id', $request->koleksi1)->increment('jumlah_keluar');

        //peminjaman koleksi 2
        if($request->koleksi2 > 0) {
            $detilTransaksi2 = new DetailTransaction;
            $detilTransaksi2->id_transaksi = $lastTransactionIdStored;
            $detilTransaksi2->id_koleksi = $request->koleksi2;
            $detilTransaksi2->status = 1;
            $detilTransaksi2->save();
            //mengurangi jumlah stok
            DB::table('collections')->where('id', $request->koleksi2)->decrement('jumlah_sisa');
            DB::table('collections')->where('id', $request->koleksi2)->increment('jumlah_keluar');
        }

        //peminjaman koleksi 3
        if($request->koleksi3 > 0) {
            $detilTransaksi3 = new DetailTransaction;
            $detilTransaksi3->id_transaksi = $lastTransactionIdStored;
            $detilTransaksi3->id_koleksi = $request->koleksi3;
            $detilTransaksi3->status = 1;
            $detilTransaksi3->save();
            //mengurangi jumlah stok
            DB::table('collections')->where('id', $request->koleksi3)->decrement('jumlah_sisa');
            DB::table('collections')->where('id', $request->koleksi3)->increment('jumlah_keluar');
        }

        return redirect()->route('transaksi')->with('status', 'Peminjaman berhasil');
    }

    public function show(Transaction $transaction) {
        $transactions = DB::table('transactions')
        ->select(
            'transactions.id as id',
            'u1.fullname as fullnamePeminjam',
            'u2.fullname as fullnamePetugas',
            'tanggal_pinjam as tanggalPinjam',
            'tanggal_selesai as tanggalSelesai',
        )
        ->join('users as u1', 'id_peminjam', '=', 'u1.id')
        ->join('users as u2', 'id_petugas', '=', 'u2.id')
        ->where('transactions.id', '=', $transaction->id)
        ->orderBy('tanggal_pinjam', 'asc')
        ->first();

        return view('transaction.transaksiView', compact('transactions'));
    }
}
