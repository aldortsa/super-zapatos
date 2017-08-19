<?php
namespace App\Http\Traits;

use App\Store;

trait StoresTrait {
    public function load_all_stores() {
        try{
	        $stores = Store::all();
	        $model_name = (new \ReflectionClass($stores->first()))->getShortName();
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
}