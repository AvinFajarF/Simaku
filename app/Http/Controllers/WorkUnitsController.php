<?php

namespace App\Http\Controllers;

use App\Models\WorkUnits;
use Illuminate\Http\Request;

class WorkUnitsController extends Controller
{

    public function index(){

        $workUnits = WorkUnits::all();

        return view("admin.unit_kerja.index", [
            "workUnits" => $workUnits
        ]);
    }

    public function create(Request $request){
        $validasi = $request->validate([
            "name" => "required"
        ]);

        WorkUnits::create($validasi);

        return redirect()->back();
    }

    public function update($id, Request $request) {
        $validasi = $request->validate([
            "name" => "string"
        ]);

        $workUnitsFind = WorkUnits::findOrFail($id);

        $workUnitsFind->update($validasi);

        return redirect()->back();

    }

    public function destroy($id) {

        $workUnitsFind = WorkUnits::findOrFail($id);

        $workUnitsFind->delete();

        return redirect()->back();

    }


}
