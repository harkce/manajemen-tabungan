<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Student;
use App\Http\Controllers\SavingController;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function create(Request $request) {
		$duplicate = Student::where('id', $request->input('id'))->first();
		if ($duplicate) {
			$message = "Siswa dengan nomor induk <b>" . $duplicate->id . "</b> sudah ada.";
			return redirect('student')->with('warning', $message);
		} else {
			$student = new Student();
			$student->id = $request->input('id');
			$student->name = $request->input('name');
			$student->class = $request->input('class');
			$student->save();
            (new SavingController)->create($student);
			$message = "Siswa berhasil ditambahkan.";
			return redirect('student')->with('success', $message);
		}
	}

    public function getAll() {
    	$students = Student::all();
        $data = array(
            'students' => $students,
            'page' => 'student',
            );
    	return view('student.viewAll', $data);
    }

    public function getStudent($id) {
    	$student = Student::where('id', $id)->first();
        if ($student) {
            $students = Student::all();
            $data = array(
                'student' => $student,
                'students' => $students,
                'page' => 'student',
                );
            return view('student.view', $data);
        } else {
            $message = "Siswa dengan id <b>" . $id . "</b> tidak ditemukan";
            return redirect('student')->with('warning', $message);
        }
    }

    public function updateStudent(Request $request, $id) {
    	$student = Student::where('id', $id)->first();
    	$student->name = $request->input('name');
		$student->class = $request->input('class');
		$student->save();
		$message = "Siswa berhasil diupdate";
		return redirect('student/' . $id)->with('success', $message);
    }

    public function deleteStudent(Request $request) {
    	$student = Student::where('id', $request->id)->first();
    	$student->delete();
    	$message = "Siswa berhasil dihapus";
    	return redirect('student')->with('success', $message);
    }

    public function getApi() {
        $students = Student::all();

        return response()->json(array('students' => $students));
    }

    public function getApiId($id) {
        $student = Student::where('id', $id)->first();
        $student->savings;
        $student->transactions;
        return response()->json(array('student' => $student));
    }
}
