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
        'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 🔹 Save the uploaded image
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('images', 'public');
    }

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
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If new image uploaded
        if ($request->hasFile('image')) {
            if ($repair->image) {
                Storage::disk('public')->delete($repair->image);
            }
            $data['image'] = $request->file('image')->store('repairs', 'public');
        }

        $repair->update($data);

        return redirect()->route('repairs.index')->with('success', 'Car updated successfully');
    }
    public function destroy(Repair $repair)
{
    if ($repair->notes()->exists()) {
        return redirect()
            ->route('repairs.index')
            ->with('error', 'Cannot delete this car because it has notes.');
    }

    $repair->delete();

    return redirect()
        ->route('repairs.index')
        ->with('success', 'Car deleted successfully');
}



}
