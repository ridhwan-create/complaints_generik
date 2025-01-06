<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\System;

class PublicComplaintController extends Controller
{
    // Paparan borang semakan status aduan
    public function statusCheckForm()
    {
        return view('public_complaints.status_check_form');
    }

    // Proses semakan status aduan berdasarkan emel
    public function checkStatus(Request $request)
    {
        // Validasi emel
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // Cari aduan berdasarkan emel
        $complaints = Complaint::where('email', $request->email)->get();

        if ($complaints->isEmpty()) {
            return redirect()->route('public_complaints.statusCheckForm')
                            ->with('error', 'Tiada aduan ditemui dengan emel ini.');
        }

        // Paparkan senarai aduan berdasarkan emel
        return view('public_complaints.index', compact('complaints'));
    }

    public function index()
    {
        $complaints = Complaint::all(); // Dapatkan semua aduan
        return view('public_complaints.index', compact('complaints')); // Paparkan senarai aduan dalam view
    }

    public function create()
    {
        // Ambil nama sistem
        $systemNames = System::where('status', 'active')->get(['id', 'systems']); // Ambil kolum systems
    
        // Ambil email admin berdasarkan role
        $adminEmails = User::where('role', 1)->pluck('email');
    
        return view('public_complaints.create', compact('adminEmails', 'systemNames'));
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
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            'admin_email' => 'required|array',
        ]);

        $validated['created_by'] = 2; // Simpan nilai 2 untuk created_by

                // Hantar emel kepada admin
                foreach ($validated['admin_email'] as $email) {
                    Mail::raw("New Complaint:\n\nComplainer : {$validated['complainer']}\nSystem : {$validated['system']}\nDetails : {$validated['details']}", function ($message) use ($email) {
                        $message->to($email)
                                ->subject('New Public Complaint');
                    });
                }


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

        // return redirect()->route('public_complaints.create')->with('success', 'Complaint submitted successfully!');
        // Redirect ke halaman welcome dengan mesej kejayaan
        return redirect()->route('welcome')->with('success', 'Complaint submitted successfully!');
    }

    public function edit(Complaint $complaint)
    {
        return view('public_complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'complainer' => 'required|string|max:255',
            'complainer_ic' => 'required|string|max:20',
            'system' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        $complaint->update($validated);

        return redirect()->route('public_complaints.edit', $complaint)->with('success', 'Complaint updated successfully!');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return redirect()->route('public_complaints.create')->with('success', 'Complaint deleted successfully!');
    }

    public function show(Complaint $complaint)
    {
        return view('public_complaints.show', compact('complaint'));
    }
}
