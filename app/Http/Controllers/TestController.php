<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'case_type' => 'required|string',
            'description' => 'required|string',
            'audio_data' => 'nullable|string',
        ]);

        // Handle audio data
        $audioPath = null;
        if ($request->audio_data) {
            $audioData = $request->audio_data;
            $audioName = 'complaint_audio_' . time() . '.wav';
            $audioPath = 'complaints/audio/' . $audioName;

            // Save audio file
            file_put_contents(
                storage_path('app/public/' . $audioPath),
                base64_decode($audioData)
            );
        }

        // Create complaint record
        $complaint = Complaint::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'case_type' => $validated['case_type'],
            'description' => $validated['description'],
            'audio_path' => $audioPath,
        ]);

        // Send email with attachment
        Mail::to('support@yourdomain.com')->send(new ComplaintRegistered($complaint));

        return redirect()->back()->with('success', 'Your complaint has been submitted successfully!');
    }
}
