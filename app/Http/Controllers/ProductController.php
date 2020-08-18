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
        $page = $request->input('page') ?? 0;
        $name = $request->input('name');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $filters = [];


        if ($name && $name != '') {
            $filters['name'] = $name;
        }
        if ($minPrice && is_numeric($minPrice)) {
            $filters['min_price'] = $minPrice;
        }

        if ($maxPrice && is_numeric($maxPrice)) {
            $filters['max_price'] = $maxPrice;
        }
        $hrefString = '/product?' . http_build_query($filters);


        $result = $this->productService->getProductList($page, $name, $minPrice, $maxPrice);
        $productCount = $result['count']->toArray()[0]->productCount;
        return view('product.index', ['products' => $result['products'], 'count' => $productCount, 'hrefString' => $hrefString, 'currentPage' => $page]);

    }
}
