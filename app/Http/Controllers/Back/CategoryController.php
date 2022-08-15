<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function indexCategories()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }
    public function switchcategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
    }
    public function createCategory(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->back()->with('success', true);
    }
    public function deleteCategory(Request $request)
    {
        $category = Category::findOrFail($request->delete_id);
        if ($category->id == 1) {
            return redirect()->back()->with('error', 'Bu kategoria siline bilmez!');
        }
        if ($category->articleCount() > 0) {
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
        }
        $category->delete();
        return redirect()->back()->with('success', true);
    }
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', true);
    }
    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function changeData(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::findOrFail($request->id);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->back()->with('success', 'Kategoriya Yenilendi.');
    }
}
