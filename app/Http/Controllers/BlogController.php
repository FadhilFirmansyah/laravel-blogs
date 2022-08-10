<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function home():Response{
        return response()->view("home", [
           "title" => "Home",
           "active" => "home"
        ]);
    }

    public function about():Response{
        return response()->view("about", [
            "title" => "About",
            "active" => "about",
            "name" => "Fadhil Firmansyah",
            "email" => "fadhilexample@sample.go",
            "image" => "pp.png"
        ]);
    }

    public function blog():Response{

        $title = "";

        if(request("category")){
            $category = Category::firstWhere("slug", request("category"));
            $title = "about " . $category->name;
        }

        if(request("author")){
            $author = User::firstWhere("username", request("author"));
            $title = "from " . $author->name;
        }
        
        return response()->view("blog", [
            "title" => "Blog",
            "active" => "blog",
            "sub" => "All Blogs " . $title,
            "blogs" => Blog::latest()->filter(request(["search", "category", "author"]))->paginate(7)
                             ->withQueryString()
        ]);
    }

    public function content(Blog $slugContent):Response{
        return response()->view("content", [
            "title" => "Content",
            "active" => "blog",
            "content" => $slugContent
        ]);
    }
    
    public function categories():Response{
        return response()->view("categories", [
            "title" => "List Category",
            "active" => "category",
            "categories" => Category::all()
        ]);
    }
}
