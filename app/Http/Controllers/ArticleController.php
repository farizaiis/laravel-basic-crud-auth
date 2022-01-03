<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Article;
use stdClass;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::all();
        $res = new stdClass();
        $res->message = 'Success to Retrieved data Article';
        $res->data = $article;
        return response()->json($res, 200);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if(is_null($article)) {
            return response()->json('Data not found', 404);
        }

        $res = new stdClass();
        $res->message = 'Success to Retrieved data Article';
        $res->data = $article;
        
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $success = Article::create($request->all());
        if(!$success) {
            return response()->json('Failed to create new Article', 400);
        }

        $res = new stdClass();
        $res->message = 'Success to create new Article';
        $res->data = $success;

        return response()->json($res, 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if(is_null($article)) {
            return response()->json('Data not found', 404);
        }
        
        $article->update($request->all());

        if(!($article->update($request->all()))) {
            return response()->json('Failed to update the data', 400);
        }
        
        $res = new stdClass();
        $res->message = 'Success to update the data';
        $res->data = $article;

        return response()->json($res, 201);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if(is_null($article)) {
            return response()->json('Data not found', 404);
        }

        $success = $article->delete();

        if(!$success) {
            return response()->json('Failed to delete the data', 400);
        }

        return response()->json('Success deleted the data', 201);
    }
    
    public function search($title)
    {
       
        $article = Article::where('title', 'like', '%'.$title.'%')->get();

        $res = new stdClass();
        $res->message = 'Success to Search data Article';
        $res->data = $article;
        
        return response()->json($res, 200);
    }
}
