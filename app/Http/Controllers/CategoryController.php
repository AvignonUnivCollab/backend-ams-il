<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index() {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('pages.category', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès !');
    }


    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Catégorie mise à jour avec succès !');
    }
}
