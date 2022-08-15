<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Pages;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        $articles=Article::all();
        $pages=Pages::all();
        $category=Category::all();
        $hit=Article::sum('hit');
        return view('backend.dashboard',compact('articles','pages','category','hit'));
    }
   
}
