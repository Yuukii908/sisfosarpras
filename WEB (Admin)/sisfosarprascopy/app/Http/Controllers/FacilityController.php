<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        return view('dashboard', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Facility::create($request->all());
        return redirect()->back()->with('success', 'Facility created successfully.');
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $facility->update($request->all());
        return redirect()->back()->with('success', 'Facility updated successfully.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect()->back()->with('success', 'Facility deleted successfully.');
    }
}
