<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class ResumeController extends Controller
{
    public function viewPdf($filename)
    {
        $filename = str_replace('resumes/', '', $filename);
        $path = storage_path('app/public/resumes/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    // Save to database
    public function saveResume(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'linkedin' => 'nullable|url',
            'address' => 'required|nullable|string|max:500',
            'summary' => 'nullable|string',
            'experience' => 'nullable|array',
            'education' => 'nullable|array',
            'skills' => 'nullable|string',
            'certifications' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        // Convert skills string to array
        if (isset($data['skills'])) {
            $data['skills'] = array_map('trim', explode(',', $data['skills']));
        }

        $resume = Resume::updateOrCreate(
            ['user_id' => Auth::id()],
            array_merge($data, ['user_id' => Auth::id()])
        );

        return response()->json([
            'success' => true,
            'message' => 'Resume saved successfully',
            'resume_id' => $resume->id,
        ]);
    }

    public function preview(Resume $resume)
    {
        // $resume = Resume::findOrFail($id);

        // $experience = $resume->experience;
        // $education = $resume->education;
        // $certifications = $resume->certifications;

        return view('preview', compact('resume'));
    }

    public function downloadPdf(Resume $resume)
    {
        $pdf = PDF::loadView('pdf', compact('resume'));

        return $pdf->download('pdf');
    }

    public function delete(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $resume->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resume deleted successfully'
        ]);
    }

    public function getResume(Request $request)
    {
        $resume = Resume::where('user_id', Auth::id())->first();
        return response()->json(['resume' => $resume]);
    }
}
