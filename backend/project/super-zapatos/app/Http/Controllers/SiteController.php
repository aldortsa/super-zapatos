<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;


abstract class SiteController extends Controller {

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)//Dependency injection
    {
        $this->request = $request;
    }

}