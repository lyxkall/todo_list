<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Todo::all();
        return view('home', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'dead_line' => 'date|nullable',
            'completed' => '',
        ]);

        // Todo::create($request->all());
        Todo::create([
            'name' => $request->name,
            'completed' => false,
            'dead_line' => $request->dead_line,
        ]);
        return redirect()->route('home')->with('success', 'Data todo berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $todo = Todo::findOrFail($id);
    $todo->completed = $request->completed; // ambil value dari hidden input
    $todo->save();

    return redirect()->back()->with('success', 'Todo updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('home')->with('success', 'Data todo berhasil dihapus.');
    }
}
