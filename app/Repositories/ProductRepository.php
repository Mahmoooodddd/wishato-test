<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:42 PM
 */

namespace App\Repositories;


use App\Book;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRepository extends CoreRepository
{

    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;

    }


    public function getProductsByPaginations($page, $name, $minPrice, $maxPrice)
    {
        $pageSize = 10;
        $products = DB::table('products')
            ->select('products.*', 'pv.id as variation_id', 'pv.name as variation_name', 'pv.price as variation_price');

        $paginationJoin = DB::table('products');
//            ->select(DB::raw('DISTINCT(products.id)'));



        if ($name != "") {
            $products->where('products.name', 'like', '%' . $name . '%');
            $paginationJoin->where('products.name', 'like', '%' . $name . '%');
        };

        $paginationJoin->join(
            'product_variations as pv', function ($join) use ($minPrice, $maxPrice) {
            $join->on('products.id', '=', 'pv.product_id');
            if ($minPrice && is_numeric($minPrice)) {
                $join->where('pv.price', '>=', $minPrice);
            }

            if ($maxPrice && is_numeric($maxPrice)) {
                $join->where('pv.price', '<=', $maxPrice);
            }
        });

        $paginationJoinCount=clone $paginationJoin;
        $count=$paginationJoinCount->addSelect(DB::raw('count(DISTINCT(products.id)) as productCount'))->get();


        $paginationJoin->select((DB::raw('DISTINCT(products.id)')));
        $paginationJoin->orderBy('id', 'desc')->skip($page * $pageSize)->take($pageSize);


        $products->join(
            'product_variations as pv', function ($join) use ($minPrice, $maxPrice) {
            $join->on('products.id', '=', 'pv.product_id');
            if ($minPrice && is_numeric($minPrice)) {
                $join->where('pv.price', '>=', $minPrice);
            }

            if ($maxPrice && is_numeric($maxPrice)) {
                $join->where('pv.price', '<=', $maxPrice);
            }
        });




        $products->joinSub($paginationJoin, 'pagination_join', function ($join) {
            $join->on('products.id', '=', 'pagination_join.id');
        });
        $products = $products->get();
        return [$count,$products];

    }


}
