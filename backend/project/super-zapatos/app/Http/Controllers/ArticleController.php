<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Traits\ArticlesTrait;

class ArticleController extends Controller
{
    use ArticlesTrait;

    public function index(\Illuminate\Http\Request $request)
    {
        $data = $this->load_all_articles();
        $response_code = isset($data['error_code'])?$data['error_code']: 200;
        if (strpos($request->headers->get('Content-Type'), 'application/json') === 0){
           return response()->json($data, $response_code);
        }else{
           return response()->xml($data, $response_code);
        }
    }
}
