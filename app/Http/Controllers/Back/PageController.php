<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function indexPages()
    {
        $pages = Page::all();
        return view('backend.pages.index', compact('pages'));
    }
    public function switcPages(Request $request)
    {
        $article=Pages::findOrFail($request->id);
        $article->status=$request->status=='true' ? 1:0;
        $article->save();
    }
    public function deletePages($id)
    {
        $page = Page::findOrFail($id);
        if (file_exists($page->image)) {
            unlink($page->image);
        }
        $page->delete();
        return redirect()->back()->with('success', "Seyfe ugurla silindi.");
    }
    public function indexPagesCreate()
    {
        return view('backend.pages.create');
    }
    public function createPage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imagename = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $directory = 'upload/pages/';
            $request->image->move($directory, $imagename);
            $imagename = $directory . $imagename;
        }
        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $imagename,
            'content' => $request->content,
        ]);
        return redirect()->back()->with('success', 'Meqale ugurla Qeyd edildi.');
    }
    public function editPageShow($id)
    {
        $article = Page::findOrFail($id);
        return view('backend.pages.update', compact('article'));
    }
    public function editPage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $page = Page::findOrFail($request->id);
        if ($request->hasFile('image')) {
            $img_name = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $directory = 'upload/pages/';
            if (file_exists($page->image)) {
                unlink($page->image);
            }
            $request->image->move($directory, $img_name);
            $img_name = $directory . $img_name;
        }
        $page->title = $request->title;
        $page->content = $request->content;
        $page->image =$img_name ?? $page->image;
        $page->save();
        return redirect()->back()->with('success', 'Seyfe ugurla yenilendi');
    }
}
