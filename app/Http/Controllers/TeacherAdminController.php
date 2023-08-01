<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherAdminController extends Controller
{

    public function index()
    {

        $teacher = Teachers::all();

        // $student = Students::with("users")->get();

        return view("admin.guru.index", ["teachers" => $teacher]);
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            "name" => "string|required",
            "status" => "required",
            "number" => "required|integer",
            "password" => "required"
        ]);

        $userCreate =   User::create([
            "username" => $validasi["name"],
            "password" => Hash::make($validasi["password"]),
        ]);

        Teachers::create(
            [
                "name" => $validasi['name'],
                "number" => $validasi['number'],
                "status" => $validasi['status'],
                "user_id" => $userCreate->id
            ]
        );

        return redirect()->back();
    }


    public function update($id, Request $request)
    {
        $validasi = $request->validate([
            "username" => "string",
            'status' => "string",
        ]);

        $validasi["password"] = Hash::make($request->password);
        $validasi["number"] =$request->number;

        $TeacherFind = Teachers::findOrFail($id);
        $UserFind = User::findOrFail($TeacherFind->user_id);

        $UserFind->update([
            "username" => $validasi["username"],
            "password" => $validasi["password"]
        ]);

        $TeacherFind->update([
            "name" => $validasi["username"],
            "status" => $validasi["status"],
            "number" => $validasi["number"],
        ]);

        return redirect()->back();
    }


    public function destroy($id)
    {
        $TeacherFind = Teachers::findOrFail($id);
        $TeacherFind->delete();

        return redirect()->back();
    }


}
