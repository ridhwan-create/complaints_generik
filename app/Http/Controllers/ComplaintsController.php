<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintsController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        // Define the directory to store the files
        $directory = storage_path('app/uploads');

        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        // Validasi input
        $validated = $request->validate([
            'complainer' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'system' => 'required|string|max:255',
            'details' => 'required|string',
            'response' => 'nullable|string', // Add validation for response
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);
    
        $validated['created_by'] = auth()->id();
    
        // Handle the image upload
        // if ($request->hasFile('image')) {
        //     // Store image in 'complaints' folder under 'storage/app' (private)
        //     $validated['image'] = $request->file('image')->store('complaints', 'local');
        // }

        if ($request->hasFile('image')) {
            $file_name = 'complaints' . time() . '.' . $request->image->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move($directory, $file_name);
            $validated['image'] = $file_name;
        }
    
        Complaint::create($validated);
    
        return redirect()->route('complaints.index')->with('success', 'Complaint created successfully.');
    }

    public function edit(Complaint $complaint)
    {
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        // Define the directory to store the files
        $directory = storage_path('app/uploads');

        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        // Validasi input
        $validated = $request->validate([
            'complainer' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'system' => 'required|string|max:255',
            'details' => 'required|string',
            'response' => 'nullable|string', // Add validation for response
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);
    
        $validated['edited_by'] = auth()->id();
    
        // Handle the image upload
        // if ($request->hasFile('image')) {
        //     // If there's an existing image, delete it from the storage
        //     if ($complaint->image) {
        //         Storage::disk('local')->delete($complaint->image);
        //     }
        //     $validated['image'] = $request->file('image')->store('complaints', 'local'); // Store new image
        // }
        if ($request->hasFile('image')) {
            $file_name = 'complaints' . time() . '.' . $request->image->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move($directory, $file_name);
            $validated['image'] = $file_name;
        }
    
        $complaint->update($validated);
    
        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully.');
    }

    public function destroy(Complaint $complaint)
    {
        // Padamkan gambar jika ada
        if ($complaint->image) {
            Storage::disk('local')->delete($complaint->image);
        }

        // Padamkan aduan
        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }

    public function showImage($id)
    {
        $complaint = Complaint::findOrFail($id);

        // Laluan lengkap ke fail gambar
        $path = storage_path('app/uploads/' . $complaint->image);

        // Semak kewujudan fail
        if (file_exists($path)) {
            return response()->file($path);
        }

        // Abort 404 jika gambar tidak dijumpai
        return abort(404, 'Image not found');
    }
}
