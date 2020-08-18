<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CoreController;
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
        $page = $request->input('page') ?? 0;
        $name = $request->input('name');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $result = $this->productService->getProductList($page, $name, $minPrice, $maxPrice, true);

        return $this->response($result);
    }
}
