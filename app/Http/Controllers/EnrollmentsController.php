<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use App\Models\Enrollments;

class EnrollmentsController extends Controller
{
    function list() {
        $items = Enrollments::select(
            'enrollments.id as enrollment_id',     // Enrollment ID
            'users.name as username',              // User name
            'users.email as user_email',           // User email
            'courses.title as course_name',        // Course title
            'enrollments.enrolled_at',             // Enrollment date
            'enrollments.status'                   // Enrollment status
        )
        ->join('users', 'enrollments.user_id', '=', 'users.id')
        ->join('courses', 'enrollments.course_id', '=', 'courses.id')
        ->get();
        // dd($items);
        $count = 1;
        return view('admin.layouts.enrollment.list', compact('items', 'count'));
    }




    public function create(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
            'enrolled_at' => 'nullable|date', // Make enrolled_at nullable
            'status' => 'required|in:active,pending,cancelled,complete',
        ], [
            'user_id.exists' => 'The selected user ID does not exist.',
            'course_id.exists' => 'The selected course ID does not exist.',
            'enrolled_at.date' => 'The enrollment date must be a valid date.',
            'status.required' => 'The status is required.',
        ]);

        // Create a new enrollment
        $enrollment = new Enrollments();
        $enrollment->user_id = $request->input('user_id');
        $enrollment->course_id = $request->input('course_id');
        // Use current timestamp if enrolled_at is not provided
        $enrollment->enrolled_at = $request->input('enrolled_at') ?? now();
        $enrollment->status = $request->input('status');

        // Save the enrollment record
        $enrollment->save();

        // Redirect back with a success message
        // return redirect()->back()->with('success', 'Enrollment created successfully.');
        return redirect()->back()->with(['createSuccess' => 'Successfully created ...']);

    }

    public function edit(Request $request) {
        // Validate the form inputs
        $request->validate([
            'enrollment_id' => 'required|integer|exists:enrollments,id',
            'status' => 'required|in:active,pending,cancelled,complete',
        ], [
            'enrollment_id.exists' => 'The selected enrollment ID does not exist.',
            'status.required' => 'The status is required.',
        ]);

        // dd($request->enrollment_id);
        // Find the enrollment record
        $enrollment = Enrollments::find($request->input('enrollment_id'));

        // Update the status
        $enrollment->status = $request->input('status');

        // Save the changes
        $enrollment->save();

        // Redirect back with a success message
        // return redirect()->back()->with('success', 'Enrollment status updated successfully.');
        return redirect()->route('enrollment.list')->with(['updateSuccess' => 'Enrollment status successfully updated ...']);

    }

    // public function delete($id) {
    //     Enrollments::where('id', $id)->delete();
    //     return redirect()->route('user.list')->with(['deleteSuccess' => 'Successfully deleted ...']);
    // }

}
