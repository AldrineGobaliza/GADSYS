<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $folders = Folder::all();

        $documents = Document::with('folder')
            ->when($request->folder_id, function ($query) use ($request) {
                $query->where('folder_id', $request->folder_id);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where('file_name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->get();

        return view('documents.index', compact('documents', 'folders'));
    }

    public function store(Request $request)
    {
            $request->validate([
        'file.*' => 'required|file|max:2048', // each file validation
    ]);

    if ($request->hasFile('file')) {
        foreach ($request->file('file') as $file) {

            $path = $file->store('documents', 'public');

            Document::create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'user_id' => Auth::id(),
                'folder_id' => $request->folder_id,
            ]);
        }
    }

        return back()->with('success', 'File uploaded successfully');
    }

    public function download($id)
    {
        $doc = Document::findOrFail($id);

        return response()->download(
            storage_path('app/public/' . $doc->file_path),
            $doc->file_name
        );
    }


    public function destroy($id)
    {
        $doc = Document::findOrFail($id);

        Storage::disk('public')->delete($doc->file_path);
        $doc->delete();

        return back()->with('success', 'File deleted');
    }
}