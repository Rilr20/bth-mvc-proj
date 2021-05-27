<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Carbon\Carbon;
use Rilr\Blog\BlogHelp;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $blogs = Blog::all()->where('published', '<=', Carbon::now('Europe/Stockholm'))->where('deleted_at', "=", null)
            ->sortByDesc('published');
        // dd($blogs);
        return view('blog.blog', [
            'title' => 'Mumintrollet',
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $blogHelp = new BlogHelp();
        $published = $blogHelp->checkDateInput($request->input('published-date'),$request->input('published-time'));
        $imageArray = $blogHelp->imageCheck($request->input('image_one'), $request->input('image_two'));
        // dd($published);
        $blog = Blog::make([
            'header' => $request->input('header'),
            'bodytext' => $request->input('bodytext'),
            'image_one' => $imageArray[0],
            'image_two' => $imageArray[1],
            'author' => $request->input('author'),
            'published' => $published
        ]);

        $blog->save();
        return redirect('/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //här är parameter route
        $blogHelp = new BlogHelp();
        $blog = Blog::where('id','=', $id)->where('deleted_at', "=", null)->where('published', '<=', Carbon::now('Europe/Stockholm'))->first();
        
        // $blog = Blog::where('id', $id)->get();
        if ($blog != null) {
            $type = $blogHelp->blogtype($blog);
        } else {
            $type = "none";
        }
        return view('blog.' . $type, [
            "blog" => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd("ok");
        // $blog = Blog::where('id', '=', $id)->firstorfail();
        $blog = Blog::find($id);
        return view('blog.update')->with('blog', $blog);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin() {
        $blogs = Blog::all();

        return view('blog.admin', [
            'blogs' => $blogs
        ]);
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
        //
        $blog = Blog::where('id', $id)
            ->update([
                'header' => $request->input('header'),
                'bodytext' => $request->input('bodytext'),
                'image_one' => $request->input('image_one'),
                'image_two' => $request->input('image_two'),
                'author' => $request->input('author'),
                'published' => $request->input('published')
        ]);

        return redirect('/blog');
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
        $blog = Blog::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return redirect("/blog");
    }
}
