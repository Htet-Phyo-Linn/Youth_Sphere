<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{

    function index() {
        // Retrieve courses with category name using a join
        $courses = DB::table('courses')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->select('courses.*', 'categories.name as category_name')
            ->paginate(8);

        // Fetch categories for the filter buttons
        $categories = DB::table('categories')->get();

        // Return view with courses and categories
        return view('user.layouts.courses', compact('courses', 'categories'));
    }


    public function filter(Request $request) {
        // If category_id is null (i.e., "All" button clicked), fetch all courses
        if ($request->category_id === null) {
            $courses = DB::table('courses')
                ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
                ->select('courses.*', 'categories.name as category_name')
                ->paginate(8);
        } else {
            // Otherwise, filter by the selected category_id
            $courses = DB::table('courses')
                ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
                ->select('courses.*', 'categories.name as category_name')
                ->where('courses.category_id', $request->category_id)
                ->paginate(8); // Paginate the results
        }

        // Fetch all categories for the filter buttons
        $categories = DB::table('categories')->get();

        // Return the filtered courses (partial view) and categories
        return view('user.layouts.partials.coursesCard', compact('courses', 'categories'));
    }



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
            $course->update(['image' => $imagePath]);
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
