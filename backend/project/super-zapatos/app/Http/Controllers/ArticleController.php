<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Traits\ArticlesTrait;

class ArticleController extends Controller
{
	use ArticlesTrait;

    public function index()
    {
    	$data = $this->load_all_articles();
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
	    return response()->json($data, $response_code);
    }

    public function index_xml()
    { 
    	$data = $this->load_all_articles();
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
	    return response()->xml($data, $response_code);
	}

}
