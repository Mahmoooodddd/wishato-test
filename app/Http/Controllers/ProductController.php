<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends CoreController
{
    protected $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page');
        $name = $request->input('name');
        $minPrice=$request->input('min_price');
        $maxPrice=$request->input('max_price');

        $result =$this->productService->getProductList($page,$name,$minPrice,$maxPrice);
        return $this->response($result);

    }
}
