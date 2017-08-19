<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Store;
use App\Article;
class ServicesResponseDataTest extends TestCase
{
    use DatabaseTransactions;

 	/**
	 * If returns data after created.
	 * @return [type] [description]
	 */
    public function testAllStoresNotEmpty() {
    	
    	factory(Store::class, 10)->create();
        $response = $this->call('GET', '/services/stores', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $stores = $response->getData()->Stores;

        $this->assertEquals(true, (count($stores) > 0));
    }   

    /**
	 * If has the store created
	 * @return [type] [description]
	 */
    public function testHasStore() {
    	$name = 'Unit Has Test Name';
    	$address = 'Unit Has Test Address';
    	$store = Store::create(['name' => $name, 'address'=>$address]);
    	
    	
        $response = $this->call('GET', '/services/stores', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $stores = $response->getData()->Stores;
		$store = end($stores);
        $this->assertEquals(true, ($store->name == $name && $store->address == $address));
    }

    /**
	 * If returns data after created.
	 * @return [type] [description]
	 */
    public function testAllArticlesNotEmpty() {
    	
    	factory(Store::class, 10)->create();
    	factory(Article::class, 100)->create();
        $response = $this->call('GET', '/services/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $articles = $response->getData()->Articles;

        $this->assertEquals(true, (count($articles) > 0));
    }

    /**
	 * If the method contains an article created.
	 * @return [type] [description]
	 */
    public function testHasArticle() {
    	$name = 'Unit Has Test Name';
    	$address = 'Unit Has Test Address';
    	$description = 'Description';
    	$price = 1.20;
    	$total_shelf = 1;
    	$total_vault = 1;
    	$store = Store::create(['name' => $name, 'address'=>$address]);
    	$article = Article::create([
    		'store_id' => $store->id,
    		'name'    => $name,
    		'description'  => $description,
    		'price' => $price,
    		'total_in_shelf' => $total_shelf,
    		'total_in_vault' => $total_vault,
    		]);
    	$store = Store::all()->last();
        $response = $this->call('GET', '/services/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $articles = $response->getData()->Articles;
        $article = end($articles);

        $this->assertEquals(true, ($article->name == $name && 
        		$article->description == $description &&
        		$article->price == $price &&
        		$article->total_in_shelf == $total_shelf &&
        		$article->total_in_vault == $total_vault
        ));
    }   

    /**
	 * Returns all the articles related to store
	 * @return [type] [description]
	 */
    public function testHasRelatedArticleToStore() {
    	$name = 'Unit Has Test Name';
    	$address = 'Unit Has Test Address';
    	$description = 'Description';
    	$price = 1.20;
    	$total_shelf = 1;
    	$total_vault = 1;
    	$store = Store::create(['name' => $name, 'address'=>$address]);
    	$article = Article::create([
    		'store_id' => $store->id,
    		'name'    => $name,
    		'description'  => $description,
    		'price' => $price,
    		'total_in_shelf' => $total_shelf,
    		'total_in_vault' => $total_vault,
    		]);
    	$store = Store::all()->last();
        $response = $this->call('GET', '/services/stores/'.$store->id.'/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $articles = $response->getData()->Article;
        
        $article = end($articles);

        $this->assertEquals(true, ($article->name == $name && 
        		$article->description == $description &&
        		$article->price == $price &&
        		$article->total_in_shelf == $total_shelf &&
        		$article->total_in_vault == $total_vault
        ));
    } 
}