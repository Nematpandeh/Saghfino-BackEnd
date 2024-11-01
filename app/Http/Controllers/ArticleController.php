<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function StoreArticle(StoreArticleRequest $storeArticleRequest)
    {
        $article = Article::create($storeArticleRequest->all());
        if ($storeArticleRequest->hasFile('picture'))
        {
            $pictureUrl = Storage::putFile('/article',$storeArticleRequest->picture);
            $article->update([
                'url_picture'=>$pictureUrl
            ]);
        }
        return response()->json([
            "message" => "اطلاعات املاک در سامانه درج گردید",
            "data" => new ArticleResource($article)
        ],200);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article == null)
        {
            return response()->json(
                [
                    'message' => "اطلاعات موردنظر یافت نشد",
                ]
            ,404);
        }
        else
        {
            return response()->json([
                "message" => "اطلاعاتموردنظرپیدا شد",
                "data" => new ArticleResource($article)
            ]);
        }
/*        return new ArticleResource($article);*/
    }

    public function showList($perpage)
    {
        $articles = DB::table('articles')->simplePaginate(1);
        if ($articles == null)
        {
            return response()->json(
                [
                    'message' => "متاسفانه هنوز اطلاعات ایجاد نشده است",
                ]
                ,404);
        }
        else
        {
            return response()->json([
                "message" => "لیست اطلاعات با موفقیت دریافت شد",
                "data" => ArticleResource::collection($articles)
            ]);
        }
    }
}
