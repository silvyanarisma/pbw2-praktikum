<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DetailTransactionController extends Controller
{
    public function getAllDetailTransactions($transactionId) {
        $detail_transactions = DB::table('detail_transactions as dt')
        ->select(
            'dt.id',
            'dt.tanggal_kembali as tanggalKembali',
            't.tanggal_pinjam as tanggalPinjam',
            'dt.status as statusType',
            DB::raw('(CASE WHEN dt.status="1" THEN "Pinjam"
            WHEN dt.status="2" THEN "Kembali"
            WHEN dt.status="3" THEN "Hilang"
            END) as status'
            ),
            'c.nama_koleksi as koleksi'
        )
        ->join('collections as c', 'c.id', '=', 'id_koleksi')
        ->join('transactions as t', 't.id', '=', 'dt.id_transaksi')
        ->where('id_transaksi', '=', $transactionId)->get();

        return DataTables::of($detail_transactions)
        ->addColumn('action', function ($detail_transaction) {
            $html='';
            if ($detail_transaction->statusType == "1") {
                $html = '
                <a href="'.url('detailTransactionKembalikan')."/".$detail_transaction->id.'">
                <i class="fas fa-edit"></i>
                </a>';
            }
            return $html;
        })
        ->make(true);
    }

    public function detailTransactionKembalikan($detailTransactionId) {
        $detailTransaction = DB::table('detail_transactions as dt')
        ->select(
            't.id as idTransaksi',
            'dt.id as id',
            'dt.tanggal_kembali as tanggalKembali',
            't.tanggal_pinjam as tanggalPinjam',
            'dt.status',
            'uPinjam.fullname as namaPeminjam',
            'uTugas.fullname as namaPetugas',
            'c.nama_koleksi as koleksi'
        )
        ->join('collections as c', 'c.id', '=', 'id_koleksi')
        ->join('transactions as t', 't.id', '=', 'dt.id_transaksi')
        ->join('users as uPinjam', 't.id_peminjam', '=', 'uPinjam.id')
        ->join('users as uTugas', 't.id_petugas', '=', 'uTugas.id')
        ->where('dt.id', '=', $detailTransactionId)->first();

        return view('detailTransaction.detailTransactionKembalikan', compact('detailTransaction'));
    }

    public function update(Request $request) {
        if ($request->status == 1) {

        } else {
            $affected = DB::table('detail_transactions')
            ->where('id', $request->idDetailTransaksi)
            ->update([
                'status'            => $request->status,
                'tanggal_kembali'    => Carbon::now()->toDateString()
            ]);

            if ($request->status == 2) {
                //kalau dikembalikan
                DB::table('collections')->increment('jumlah_sisa');
                DB::table('collections')->decrement('jumlah_keluar');
            } else {
                //kalau hilang
                DB::table('collections')->increment('jumlah_sisa');
            }
        }
        $transaction = Transaction::where('id', '=', $request->idTransaksi)->first();

        return redirect('transaksiView/'.$request->idTransaksi)->with('transaction', $transaction);
    }
}
