<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.blog.index", [
            "blogs" => Blog::where("user_id", auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.blog.create", [
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataBlog = $request->validate([
            "title" => "required|max:255",
            "slug" => "required|unique:blogs",
            "category_id" => "required",
            "image" => "image|file|max:1024",
            "body" => "required"
        ]);

        if($request->file("image")){
            $dataBlog["image"] = $request->file("image")->store("blog-image");
        }

        $dataBlog["user_id"] = auth()->user()->id;
        $dataBlog["excerpt"] = Str::limit(strip_tags($request->body), 150);

        Blog::create($dataBlog);

        return redirect("/dashboard/blog")->with("success", "New Blog has been uploaded");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view("dashboard.blog.show", [
            "blog" => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view("dashboard.blog.edit", [
            "blog" => $blog,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $rules = [
            "title" => "required|max:255",
            "category_id" => "required",
            "image" => "image|file|max:1024",
            "body" => "required"
        ];

        if($request->slug != $blog->slug){
            $rules["slug"] = "required|unique:blogs";
        }

        $dataBlog = $request->validate($rules);

        if($request->file("image")){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $dataBlog["image"] = $request->file("image")->store("blog-image");
        }

        

        $dataBlog["user_id"] = auth()->user()->id;
        $dataBlog["excerpt"] = Str::limit(strip_tags($request->body), 150);

        Blog::where("id", $blog->id)->update($dataBlog);

        return redirect("/dashboard/blog")->with("success", "a Blog has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if($blog->image){
            Storage::delete($blog->image);
        }
        Blog::destroy($blog->id);
        return redirect("/dashboard/blog")->with("success", "Blog success delete it");
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Blog::class, "slug", $request->title);
        return response()->json(["slug" => $slug]);
    }
}
