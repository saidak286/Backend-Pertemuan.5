<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    function index() 
    {
        $students = Student::all();
        
        $data = [
            'message' => 'Get all students',
            'data' => $students
        ];
        return response()->json($data, 200);
    }

    function store(Request $request)
    {
        # tangkap data
        # input data ke database
        
        $validatedData = $request->validate([
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);

        $student = Student::create($validatedData);

        $data = [
            'message' => 'Student berhasil ditambahkan',
            'data' => $student
        ];

        return response()->json($data, 201);
    }
    
    function show($id)
    {
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => "Get detail student",
                'data' => $student
            ];

            return response()->jason($data, 200);
        } 
        else {
            $data = [
                'message' => "Data not found",
            ];

            return response()->jason($data, 404);
        } 
    }
    function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->update([
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ]);
            $data =[
                'message' => 'Student is update',
                'data' => $student
            ];

            return response()->json($data, 200);
        } 
        else {
            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }
    function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delet();

            $data = [
                'message' => "Student is delete"
            ];

            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data not found'
            ];
            
            return response()->json($data, 404);
        }
    }
}
