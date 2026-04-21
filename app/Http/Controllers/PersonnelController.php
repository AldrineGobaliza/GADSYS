<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personnels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'staff_photo' => 'nullable|image',
        ]);

        // Handle image upload
        if ($request->hasFile('staff_photo')) {
            $data['staff_photo'] = $request->file('staff_photo')->store('personnel', 'public');
        }

        Personnel::create($data);

        return redirect()->route('personnel.index')
                         ->with('success', 'Personnel added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personnel $personnel)
    {
        return view('personnel.edit', compact('personnel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personnel $personnel)
    {
        $data = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'staff_photo' => 'nullable|image',
        ]);

        // Update image if new one uploaded
        if ($request->hasFile('staff_photo')) {
            $data['staff_photo'] = $request->file('staff_photo')->store('personnel', 'public');
        }

        $personnel->update($data);

        return redirect()->route('personnel.index')
                         ->with('success', 'Personnel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personnel $personnel)
    {
        $personnel->delete();

        return redirect()->route('personnel.index')
                         ->with('succes', 'Personnel deleted.');
    }
}
