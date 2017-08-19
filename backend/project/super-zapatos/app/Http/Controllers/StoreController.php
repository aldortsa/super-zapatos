<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Http\Traits\StoresTrait;
use App\Http\Traits\ArticlesTrait;

class StoreController extends Controller
{
	use StoresTrait;
	use ArticlesTrait;

    public function index(\Illuminate\Http\Request $request)
    {
    	$data = $this->load_all_stores();
    	
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
	    if (strpos($request->headers->get('Content-Type'), 'application/json') === 0){
	       return response()->json($data, $response_code);
        }else{
           return response()->xml($data, $response_code);
        }
    }

	public function article_by_store(\Illuminate\Http\Request $request, $id){
		$data = $this->load_all_articles_by_id_store($id);
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
		if (strpos($request->headers->get('Content-Type'), 'application/json') === 0){
	       return response()->json($data, $response_code);
        }else{
           return response()->xml($data, $response_code);
        }
	}

}
