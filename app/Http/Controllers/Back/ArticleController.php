<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'ASC')->get();
        return view("backend.articles.articles", compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("backend.articles.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $directory = 'upload/blog/';
            $imageName = Str::slug($request->title) . "." . $request->image->getClientOriginalExtension();
            $request->image->move($directory, $imageName);
            $imageName = $directory . $imageName;
        }
        $article=Article::create([
            'title'=>$request->title,
            'name'=>$request->title,
            'category_id'=>$request->category,
            'content'=>$request->content,
            'slug'=>Str::slug($request->title),
            'image'=>$imageName,
        ]);
       
       
        
        return redirect()->back()->with('success',true);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        $categories = Category::all();
        return view("backend.articles.update", compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $article =Article::find($id);
        $article->title = $request->title;
        $article->name = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $directory = 'upload/blog/';
            $imageName = Str::slug($request->title) . "." . $request->image->getClientOriginalExtension();
            $request->image->move($directory, $imageName);
            $imageName = $directory . $imageName;
            $article->image = $imageName;
        }
        
        return redirect()->back()->with($article->save() ? "success" : 'error',true);
    }
    public function switch(Request $request){
        $article=Article::findOrFail($request->id);
        $article->status=$request->status=='true' ? 1:0;
        $article->save();
    }
    public function sil($id){
        $article=Article::findOrFail($id);
        $article->delete();
        return redirect()->back()->with('success','Melumat silindi');
    }
    public function trashed(){
        $data['articles']=Article::onlyTrashed()->orderBy('deleted_at','desc');
        return view('backend.articles.trashed',$data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
