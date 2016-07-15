<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Saving extends Model
{
    public function student() {
    	return $this->belongsTo('App\Student');
    }

    public function transactions() {
    	return $this->hasMany('App\Transaction');
    }

    public function getTotalMasuk($id) {
        $totalMasuk = DB::table('transactions')
            ->where([
                ['student_id', $id],
                ['type', 1],
            ])->sum('amount');
        if (empty($totalMasuk)) {
            return 0;
        }
        return $totalMasuk;
    }

    public function getTotalKeluar($id) {
        $totalKeluar = DB::table('transactions')
            ->where([
                ['student_id', $id],
                ['type', 0],
            ])->sum('amount');
        if (empty($totalKeluar)) {
            return 0;
        }
        return $totalKeluar;
    }

    public function getTotalSaldo($id) {
        $totalSaldo = $this->getTotalMasuk($id) - $this->getTotalKeluar($id);
        if (empty($totalSaldo)) {
            return 0;
        }
        return $totalSaldo;
    }
}
