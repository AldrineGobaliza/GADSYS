<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{  
    public function store(Request $request)
        {
            $request->validate([
                'name' => 'required'
            ]);

            Folder::create([
                'name' => $request->name,
                'user_id' => Auth::id()
            ]);

            return back()->with('success', 'Folder created');
        }
}
