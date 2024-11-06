<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use App\Models\Categories;

class CoursesController extends Controller
{
    // view courses list
    public function list() {
        $items = Courses::select('courses.*',
        'courses.title as course_title',
        'users.name as instructor_name',
        'categories.name as category_name')
    ->join('users', 'courses.instructor_id', '=', 'users.id')
    ->join('categories', 'courses.category_id', '=', 'categories.id')
    ->get();

    $categories = categories::all();


        $count = 1;
        return view('admin.layouts.course.list', compact('items', 'categories', 'count'));
    }

    public function create(Request $request) {
        // Validate the input data
        $validatedData = $request->validate([
            'instructor_id' => 'required|exists:users,id|integer',
            'category' => 'required|exists:categories,id|integer',
            'course_title' => 'required|string|max:255',
            'description' => 'string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        // Prepare the data for saving
        $data = [
            'instructor_id' => (int) $request->instructor_id,
            'category_id' => (int) $request->category,
            'title' => $request->course_title,
            'description' => $request->description,
            'price' => (int) $request->price,
            'image' => $request->image,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/courses', 'public');
            $data['image'] = $imagePath;
        }

        // Verify instructor existence
        $instructorExists = User::where('id', (int) $request->instructor_id)->exists();
        if (!$instructorExists) {
            return back()->withErrors(['instructor_id' => 'Instructor ID not found']);
        }
        // Create the course record
        Courses::create($data);

        // Redirect with success message
        return back()->with(['createSuccess' => 'Course successfully created ...']);
    }


    public function editPage($id) {
        $data = courses::where('id', $id)->first();

        $categories = Categories::all();
        $count = 1;
        return view('admin.layouts.course.edit', compact('data', 'categories','count'));
    }


    public function edit(Request $request) {
        // Validate the input data
        $validatedData = $request->validate([
            'instructor_id' => 'required|exists:users,id|integer',
            'category' => 'required|exists:categories,id|integer',
            'title' => 'required|string|max:255',
            // 'description' => 'string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        // Find the instructor
        $user = User::find($request->instructor_id);
        if (!$user) {
            return redirect()->route('course.list')
                ->with('instructor_id_error', 'Instructor ID not found')
                ->withInput();
        }

        // Find the course to update
        $course = Courses::find($request->id);
        if (!$course) {
            return redirect()->route('course.list')
                ->with('course_id_error', 'Course not found')
                ->withInput();
        }

        // Prepare the data for updating
        $data = [
            'instructor_id' => (int) $request->instructor_id,
            'category_id' => (int) $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'price' => (int) $request->price,
        ];

        // Check if a new image is uploaded and store it
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/courses', 'public');
            $data['image'] = $imagePath;
        }

        // Update the course with new data
        $course->update($data);

        // Redirect with success message
        return redirect()->route('course.list')->with(['updateSuccess' => 'Course updated successfully.']);
    }



    public function delete($id) {
        courses::where('id', $id)->delete();
        return redirect()->route('course.list')->with(['deleteSuccess' => 'Course successfully deleted ...']);
    }

}
