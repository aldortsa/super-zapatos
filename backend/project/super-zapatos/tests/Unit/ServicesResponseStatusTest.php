<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Store;
use App\Article;
class ServicesResponseStatusTest extends TestCase
{
    use DatabaseTransactions;
	/**
	 * Unautorized request on /services/stores
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMStoresJSON() { 
        $response = $this->call('GET', '/services/stores');
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /services/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMArticlesJSON() { 
        $response = $this->call('GET', '/services/articles');
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMArticlesByStoreJSON() { 
        $response = $this->call('GET', '/services/stores/1/articles');
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /api/services/stores
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMStoresXML() { 
        $response = $this->call('GET', '/api/services/stores');
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /api/services/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMArticlesXML() { 
        $response = $this->call('GET', '/api/services/articles');
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMArticlesByStoreXML() { 
        $response = $this->call('GET', '/api/services/stores/1/articles');
        $this->assertEquals(401, $response->status());
    }

    ////////
    /**
	 * Autorized request on /services/stores
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnMStoresJSON() { 
        $response = $this->call('GET', '/services/stores', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /services/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnMArticlesJSON() { 
        $response = $this->call('GET', '/services/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnMArticlesByStoreJSON() { 
        $response = $this->call('GET', '/services/stores/1/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Bad request on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test400BadRequestOnMArticlesByStoreJSON() {
    
        $response = $this->call('GET', '/services/stores/123b/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(400, $response->status());
    }

    /**
	 * Record not found on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test404RecordNotFoundOnMArticlesByStoreJSON() {
    	$store = Store::all()->last();
        $response = $this->call('GET', '/services/stores/'.($store->id+1).'/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(404, $response->status());
    }

    /**
	 * Autorized request on /api/services/stores
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnMStoresXML() { 
        $response = $this->call('GET', '/api/services/stores', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /api/services/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnMArticlesXML() { 
        $response = $this->call('GET', '/api/services/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnArticlesByStoreXML() {
    	
    	$store = Store::create(['name' => 'Unit Test Store', 'address'=>'Unit Test Address']);
        $response = $this->call('GET', '/api/services/stores/'.$store->id.'/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Bad request on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test400BadRequestOnArticlesByStoreXML() {
    
        $response = $this->call('GET', '/api/services/stores/123b/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(400, $response->status());
    }

    /**
	 * Record not found on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test404RecordNotFoundOnArticlesByStoreXML() {
    	$store = Store::all()->last();

        $response = $this->call('GET', '/api/services/stores/'.($store->id+1).'/articles', [], [], [], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => '123456', "HTTP_Authorization" => "Basic " . base64_encode('admin:123456')]);
        $this->assertEquals(404, $response->status());
    }


}
