<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Config;
use App\Models\Page;
use App\Models\Pages;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
{
    public function __construct()
    {
        if(Config::find(1)->aktiv==0){
            return redirect()->route('sayt-baximda')->send();
        }
        view()->share('pages', Pages::where('status',1)->get());
        view()->share('config', Config::find(1));
    
    }
    public function index()
    {
        $data['articles'] = Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBydesc('created_at')->paginate(10);
        $data['categories'] = Category::where('status',1)->get();
        return view('frontend.homepage', $data);
    }
    public function single($category, $slug)
    {
        $category = Category::where('slug', $category)->where('status',1)->first() ?? abort(403, "Bele bir kategoria movcud deyil!");
        $article = Article::with('getCategory')->where('slug', $slug)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->where('category_id', $category->id)->where('status',1)->first() ?? abort(403, "Bele bir yazi movcud deyil!");
        $article->increment('hit');
        $data['articles'] = $article;
        $data['categories'] = Category::where('status',1)->get();
        return view('frontend.post', $data);
    }
    public function category($category)
    {
        $data['categories'] = Category::where('slug', $category)->where('status',1)->first();
        $data['categories2'] = Category::where('status',1)->get();
        $name = Category::where('slug', $category)->where('status',1)->first();
        $data['articles'] = Article::with('getCategory')->where('category_id', $name->id)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->where('status',1)->orderBydesc('created_at')->paginate(10) ?? abort(403, 'Bu kategoriada yazi movcud deyil');
        return view('frontend.category', $data);
    }
    public function Page($slug)
    {
        $data['pages'] = Pages::all();
        $page = Page::where('slug', $slug)->first() ?? abort(403, "Bele bir Sehife movcud deyil!");
        $data['page'] = $page;
        return view('frontend.page', $data);
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function contactPost(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'topic' => 'required',
        ]);
        Mail::raw($request->name.' terefinde '.$request->topic.' movsusunda bildiris mesaji gonderilmisdir <hr>'.$request->message, function ($message) use($request) {
            $message->from('rasulrasull530@gmail.com', 'AzBlog.com');
            $message->to('resulresull510@gmail.com', 'AzBlog.com');
            $message->subject($request->name."mesaj gonderdi");
        });
        $contact=new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->message=$request->message;
        $contact->topic=$request->topic;
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->back()->with($contact->save() ? "success":"error",true);

    }
}
