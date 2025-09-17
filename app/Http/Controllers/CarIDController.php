<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class CarIDController extends Controller
{
    public function index()
    {
        $repairs = Repair::all();
        return view('repairs.index', compact('repairs'));
    }

    public function create()
    {
        return view('repairs.createID');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'car_id' => 'required|string|unique:repairs,car_id',
            'name'   => 'nullable|string',
            'phone'  => 'nullable|string',
            'type'   => 'nullable|string',
        ]);

        Repair::create($data);

        return redirect()->route('repairs.index')->with('success', 'Car added successfully');
    }



    public function show(Repair $repair)
{
    // Load all notes for this car
    $repair->load('notes');

    return view('repairs.show', compact('repair'));
}



    public function edit(Repair $repair)
    {
        return view('repairs.editID', compact('repair'));
    }

  public function update(Request $request, Repair $repair)
{
    $data = $request->validate([
        'car_id' => 'required|string|unique:repairs,car_id,' . $repair->id,
        'name'   => 'nullable|string',
        'phone'  => 'nullable|string',
        'type'   => 'nullable|string',
    ]);

    $repair->update($data);

    return redirect()->route('repairs.index')->with('success', 'Car updated successfully');
}

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->route('repairs.index')->with('success', 'Car deleted successfully');
    }



}
