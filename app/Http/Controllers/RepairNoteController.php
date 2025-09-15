<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\RepairNote;
use Illuminate\Http\Request;

class RepairNoteController extends Controller
{
    public function create(Repair $repair)
    {
        return view('repairs.create', compact('repair'));
    }

    public function store(Request $request, Repair $repair)
    {
        $data = $request->validate([
            'note' => 'required|string',
            'status' => 'required|string|in:pending,in-progress,completed',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $repair->notes()->create($data);

        return redirect()->route('repairs.show', $repair->id)
                         ->with('success', 'Note added successfully');
    }

    public function edit(RepairNote $note)
    {
        $note->load('repair');
        return view('repairs.edit', compact('note'));
    }

    public function update(Request $request, RepairNote $note)
    {
        $data = $request->validate([
            'note' => 'required|string',
            'status' => 'required|string|in:pending,in-progress,completed',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $note->update($data);

        return redirect()->route('repairs.show', $note->repair_id)
                         ->with('success', 'Note updated successfully');
    }

    public function destroy(RepairNote $note)
    {
        $note->delete();
        return redirect()->route('repairs.show', $note->repair_id)
                         ->with('success', 'Note deleted successfully');
    }
}
