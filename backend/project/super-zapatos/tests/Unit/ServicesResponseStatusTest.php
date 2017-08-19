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
    public function test401UnauthorizedOnStoresJSON() { 
        $response = $this->call('GET', 
            '/services/stores',
            [],[],[],
            ['CONTENT_TYPE'=> 'application/json']
        );
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /services/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnArticlesJSON() { 
        $response = $this->call('GET', 
            '/services/articles',
            [],[],[],
            ['CONTENT_TYPE'=> 'application/json']
        );
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnMArticlesByStoreJSON() {
        $name = 'Unit Has Test Name';
        $address = 'Unit Has Test Address'; 
        $store = Store::create(['name' => $name, 'address'=>$address]); 
        $response = $this->call('GET', 
            '/services/stores/'.$store->id.'/articles',
            [],[],[],
            ['CONTENT_TYPE'=> 'application/json']
        );
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /api/services/stores
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnStoresXML() { 
        $response = $this->call('GET', 
            '/services/stores',
            [],[],[],
            ['CONTENT_TYPE'=> 'application/xml']
        );
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /api/services/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnArticlesXML() { 
        $response = $this->call('GET', 
            '/services/articles',
            [],[],[],
            ['CONTENT_TYPE'=> 'application/xml']
        );
        $this->assertEquals(401, $response->status());
    }

    /**
	 * Unautorized request on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test401UnauthorizedOnArticlesByStoreXML() { 
        $response = $this->call('GET', 
            '/services/stores/1/articles',
            [],[],[],
            ['CONTENT_TYPE'=> 'application/xml']
        );
        $this->assertEquals(401, $response->status());
    }

    ////////
    /**
	 * Autorized request on /services/stores
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnStoresJSON() { 
        $response = $this->call('GET', 
            '/services/stores', 
            [],[],[], 
            [
                'CONTENT_TYPE'=> 'application/json', 
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /services/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnArticlesJSON() { 
        $response = $this->call('GET', 
            '/services/articles', 
            [],[],[], 
            [
                'CONTENT_TYPE'=> 'application/json',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnArticlesByStoreJSON() {
        $name = 'Unit Has Test Name';
        $address = 'Unit Has Test Address'; 
        $store = Store::create(['name' => $name, 'address'=>$address]);
        $response = $this->call('GET', 
            '/services/stores/'.$store->id.'/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/json',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Bad request on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test400BadRequestOnArticlesByStoreJSON() {
    
        $response = $this->call('GET', 
            '/services/stores/123b/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/json',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(400, $response->status());
    }

    /**
	 * Record not found on /services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test404RecordNotFoundOnArticlesByStoreJSON() {
    	$store = Store::all()->last();
        $response = $this->call('GET', 
            '/services/stores/'.($store->id+1).'/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/json',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(404, $response->status());
    }

    /**
	 * Autorized request on /api/services/stores
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnStoresXML() { 
        $response = $this->call('GET', 
            '/services/stores', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/xml',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /api/services/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnArticlesXML() { 
        $response = $this->call('GET', 
            '/services/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/xml',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Autorized request on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test200AuthorizedOnArticlesByStoreXML() {
    	
    	$store = Store::create(['name' => 'Unit Test Store', 'address'=>'Unit Test Address']);
        $response = $this->call('GET', 
            '/services/stores/'.$store->id.'/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/xml',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(200, $response->status());
    }

    /**
	 * Bad request on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test400BadRequestOnArticlesByStoreXML() {
    
        $response = $this->call('GET', 
            '/services/stores/123b/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/xml',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(400, $response->status());
    }

    /**
	 * Record not found on /api/services/stores/:id/articles
	 * @return [type] [description]
	 */
    public function test404RecordNotFoundOnArticlesByStoreXML() {
    	$store = Store::all()->last();

        $response = $this->call('GET', 
            '/services/stores/'.($store->id+1).'/articles', 
            [], [], [], 
            [
                'CONTENT_TYPE'=> 'application/xml',
                'PHP_AUTH_USER' => 'admin', 
                'PHP_AUTH_PW' => '123456', 
                'HTTP_Authorization' => 'Basic ' . base64_encode('admin:123456')
            ]
        );
        $this->assertEquals(404, $response->status());
    }


}
