<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:43 PM
 */

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Traits\serviceResponseTrait;

class ProductService
{

    use serviceResponseTrait;
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function getProductList($page, $name, $minPrice, $maxPrice, $fromApi = false)
    {
        list($count, $products) = $this->productRepository->getProductsByPaginations($page, $name, $minPrice, $maxPrice);
        $finalProducts = [];
        $productIds = [];

        foreach ($products as $product) {

            $productId = $product->id;
            $productName = $product->name;
            if (in_array($productId, $productIds)) {
                foreach ($finalProducts as &$finalProduct) {
                    if ($finalProduct['productId'] == $productId) {
                        $finalProduct['variations'][] = [
                            'id' => $product->variation_id,
                            'name' => $product->variation_name,
                            'price' => $product->variation_price
                        ];
                    }
                }

            } else {
                $productIds[] = $productId;
                $finalProducts[] = [
                    'productId' => $productId,
                    'productName' => $productName,
                    'variations' => [
                        [
                            'id' => $product->variation_id,
                            'name' => $product->variation_name,
                            'price' => $product->variation_price
                        ]

                    ]
                ];
            }


        }

        $data = [
            'count' => $count,
            'products' => $finalProducts
        ];

        if ($fromApi) {
            return $this->success($data);
        }

        return $data;
    }


}
