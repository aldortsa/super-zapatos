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

    public function index()
    {
    	$data = $this->load_all_stores();
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
	    return response()->json($data, $response_code);
    }

    public function index_xml()
    {
    	$data = $this->load_all_stores();
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
	    return response()->xml($data, $response_code);
	}

	public function article_by_store($id){
		$data = $this->load_all_articles_by_id_store($id);
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
		return response()->json($data, $response_code);
	}

	public function article_by_store_xml($id){	
		$data = $this->load_all_articles_by_id_store($id);
		$response_code = isset($data['error_code'])?$data['error_code']: 200;
		return response()->xml($data, $response_code);
	}

}
