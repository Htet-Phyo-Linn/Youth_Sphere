<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list() {
        $items = user::all();
        $count = 1;
        // dd($items);
        return view('admin.layouts.user.list', compact('items', 'count'));
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'user',
        ];

        // dd($data);
        user::create($data);
        return back()->with(['createSuccess' => 'Successfully created ...']);
    }

    function editPage($id) {
        $data = user::where('id', $id)->first();
        // dd($data->id);
        return view('admin.layouts.user.edit', compact('data'));

    }

    public function edit(Request $request) {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6', // Make password nullable
        ]);

        $user = User::find($request->id);

        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash the password
        }

        $user->save();

        return redirect()->route('user.list')->with(['updateSuccess' => 'Successfully updated ...']);
    }


    public function delete($id) {
        user::where('id', $id)->delete();
        return redirect()->route('user.list')->with(['deleteSuccess' => 'Successfully deleted ...']);
    }
}
