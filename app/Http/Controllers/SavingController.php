<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Saving;
use App\Student;
use DB;

class SavingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Student $student) {
        $saving = new Saving();
        $saving->balance = 0;
        $saving->student_id = $student->id;
        $saving->save();
        return true;
    }

    public function getAllSaving() {
    	$savings = Saving::all();
    	$data = array(
            'savings' => $savings,
            'page' => 'saving',
            );
        return view('saving.viewAll', $data);
    }

    public function getSaving($id) {
    	$saving = Saving::where('student_id', $id)->first();
    	echo $saving->student->name;
    }
}
