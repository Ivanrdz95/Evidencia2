<?php

// app/Http/Controllers/StatusController.php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses',
        ]);

        Status::create($request->only('name'));

        return redirect()->route('statuses.index');
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name,' . $status->id,
        ]);

        $status->update($request->only('name'));

        return redirect()->route('statuses.index');
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index');
    }
}
