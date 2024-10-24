<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeArticlerequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function storeArticle(storeArticlerequest $storeArticlerequest)
    {
      dd($storeArticlerequest->all());
    }
}
