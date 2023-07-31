<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class StudentsAdminController extends Controller
{

    public function index()
    {

        $user = User::all();

        $student = Students::with("users")->get();

        return view("admin.siswa.index", ["user" => $user, "students" => $student]);
    }

    // store siswa to database
    public function create(Request $request)
    {
        $validasi = $request->validate([
            "name" => "string|required",
            "status" => "required",
            "password" => "required"
        ]);

        $userCreate =   User::create([
            "username" => $validasi["name"],
            "password" => Hash::make($validasi["password"]),
        ]);

        Students::create(
            [
                "name" => $validasi['name'],
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

        $StudentFind = Students::findOrFail($id);
        $UserFind = User::findOrFail($StudentFind->user_id);

        $UserFind->update([
            "username" => $validasi["username"],
            "password" => $validasi["password"]
        ]);

        $StudentFind->update([
            "name" => $validasi["username"],
            "status" => $validasi["status"]
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $StudentFind = Students::findOrFail($id);
        $StudentFind->delete();

        return redirect()->back();
    }
}
