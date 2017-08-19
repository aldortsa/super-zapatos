<?php
namespace App\Http\Traits;

use App\Article;
use App\Store;

trait ArticlesTrait {
    public function load_all_articles() {
        try{
	        $stores = Article::all();
	        $model_name = class_basename(Article::class);
	        $data = array(
	        	(count($stores) > 1 ? str_plural($model_name) : $model_name) => $stores->toArray(),
	        	'success' => true,
	        	'total_elements' => count($stores)
	        );
	        
	    }catch(\Illuminate\Database\QueryException $e){
	    	$data = array(
	    		'success' => false,
	    		'error_code' => 500, 
	    		'error_msg' => $e->getMessage()
	    	);
	    }catch(Exception $e){
	    	$data = array(
	    		'success' => false,
	    		'error_code' => 500, 
	    		'error_msg' => $e->getMessage()
	    	);
	    }
	    return $data;
    }

    public function load_all_articles_by_id_store($id) {
        try{
        	
        	if(!is_numeric($id)){
        		$data = array(
		    		'success' => false,
		    		'error_code' => 400, 
		    		'error_msg' => 'Bad Request'
	    		);
	    		return $data;
        	}
	        $store = Store::with('articles')->find($id);
	        if(!isset($store)){
	    		$data = array(
		    		'success' => false,
		    		'error_code' => 404, 
		    		'error_msg' => 'Record not Found'
	    		);
	    		return $data;	
	        }
	        $articles = $store->articles()->get();
		    $model_name = class_basename(Article::class);
	        $data = array(
	        	(count($articles) > 1 ? str_plural($model_name) : $model_name) => $articles->toArray(),
	        	'success' => true,
	        	'total_elements' => count($articles)
	        );
	        
	    }catch(\Illuminate\Database\QueryException $e){
	    	$data = array(
	    		'success' => false,
	    		'error_code' => 500, 
	    		'error_msg' => $e->getMessage()
	    	);
	    }catch(Exception $e){
	    	$data = array(
	    		'success' => false,
	    		'error_code' => 500, 
	    		'error_msg' => $e->getMessage()
	    	);
	    }
	    return $data;
    }
}