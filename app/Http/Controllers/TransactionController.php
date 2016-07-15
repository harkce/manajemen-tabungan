<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaction;
use App\Saving;
use App\Student;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getAllTransaction() {
    	$transactions = Transaction::all();
    	$data = array(
    		'transactions' => $transactions,
    		'page' => 'transaction',
    		);
    	return view('transaction.viewAll', $data);
    }

    public function viewAdd() {
    	$savings = Saving::all();
    	$data = array(
            'savings' => $savings,
            'page' => 'add_transaction',
            );
        return view('transaction.add', $data);
    }

    public function addTransaction(Request $request) {
    	$student = Student::where('id', $request->input('id'))->first();
    	if (empty($student)) {
    		$message = 'Siswa dengan nomor induk <b>' . $request->input('id') . '</b> tidak ditemukan.';
    		return redirect('transaction/add')->with('warning', $message);
    	} else {
    		if (($request->input('type') == 0) && ($request->input('amount') > $student->savings->getTotalSaldo($student->id))) {
    			$message = "Saldo tidak cukup!";
    			return redirect('transaction/add')->with('warning', $message);
    		} else {
    			$transaction = new Transaction();
    			$transaction->student_id = $student->id;
    			$transaction->saving_id = $student->savings->id;
    			$transaction->amount = $request->input('amount');
    			$transaction->type = $request->input('type');
    			$transaction->save();
    			$message = "Transaksi sukses.";
    			return redirect('transaction/add')->with('success', $message);
    		}
    	}
    }
}
