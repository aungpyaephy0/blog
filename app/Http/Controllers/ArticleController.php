<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(['index', 'detail']);
    }
    public function index()
    {
        $data = Article::latest()->paginate(5);
        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $data = Article::find($id);
        return view('articles.detail', ['article' => $data]);
    }
    public function add()
    {
        $data = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"],
        ];
        return view('articles.add', [
            'categories' => $data
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');

    }
    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::find($id);

        return view("articles.edit", [
            "categories" => $categories,
            "article" => $article,
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = Article::find($id);

        if(Gate::allows('edit-article', $article)) {
            $article->title = request()->title;
            $article->body = request()->body;
            $article->category_id = request()->category_id;
            $article->user_id = auth()->user()->id;
            $article->save();

            return redirect("/articles/detail/$id");
        }

        return redirect("/articles/detail/$id")->with("info", "Permission Denied");
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('delete-article', $article)) {
            $article->delete();
            return redirect('/articles')->with('info', 'Article deleted successfully');
        }
        return back()->with('info', 'Unauthorized User');
    }

}

