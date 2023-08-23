<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use Illuminate\Http\Request;


class ExcuseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $excuses = Excuse::all();
        return view('home.excuse.index', compact('excuses'));

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
            'comment' => 'required|string|max:255',
            'archive' => 'required|file|mimes:pdf,docx,jpg,jpeg,png',
        ]);
    
        // Subir el archivo al sistema de archivos (por ejemplo, almacenamiento público)
        $archivePath = $request->file('archive')->store('excuse_files', 'public');
    
        Excuse::create([
            'comment' => $request->input('comment'),
            'archive' => $archivePath,
        ]);
    
        session()->flash('success', 'Excusa creada exitosamente.');
    
        return redirect()->route('excuse.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Excuse $excuse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Excuse $excuse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Excuse $excuse)
    {
        //

        $request->validate([
            'comment' => 'required|string|max:255',
            'archive' => 'required|file|mimes:pdf,docx,jpg,jpeg,png',
        ]);
        
        $archivePath = $request->file('archive')->store('excuse_files', 'public');

        $excuse->update([
            'comment' => $request->input('comment'),
            'archive' => $archivePath,
        ]);

        session()->flash('success', 'Excusa actualizada exitosamente.');

        return redirect()->route('excuse.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Excuse $excuse)
    {
        //
        $excuse->delete();

        session()->flash('delete', 'ok');
        return redirect()->route('excuse.index');
    }
}
