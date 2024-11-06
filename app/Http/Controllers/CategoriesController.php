<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    // view categories list
    public function list() {
        $items = categories::all();
        $count = 1;
        // $page = 'categoryList';
        // dd($items);
        return view('admin.layouts.category.list', compact('items', 'count'));
    }

    public function create(Request $request) {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        // dd($data);
        categories::create($data);
        return back()->with(['createSuccess' => 'Successfully created ...']);
    }

    public function editPage($id) {
        $data = categories::where('id', $id)->first();
        // dd($data->name);
        return view('admin.layouts.category.edit', compact('data'));
    }

    public function edit(Request $request) {
        $data = [
            'name' => $request->name,
            'description'=> $request->description,
        ];
        // dd($data);
        categories::where('id', $request->id)->update($data);
        return redirect()->route('category.list')->with(['updateSuccess' => 'Successfully updated ...']);
    }

    public function delete($id) {
        categories::where('id', $id)->delete();
        return redirect()->route('category.list')->with(['deleteSuccess' => 'Successfully deleted ...']);
    }
}
