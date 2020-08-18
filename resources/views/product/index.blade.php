@extends('layouts.app')

@section('content')
    <form action="/product" method="get">
        <div class="form-group">
            <label for="fname" class="col-form-label">name:</label>
            <input type="text" id="name" name="name">
            <button type="submit" class="btn btn-primary">search</button>
            <a href="/product" class="btn btn-danger">Reset Filters</a>
        </div>
    </form>
    <div class="all-products">
        @foreach($products as  $product)
            <div class="card">
                <img src="/product.png" alt="Denim Jeans" style="width:100%">
                <h1>{{$product['productName']}}</h1>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product['variations'] as $productVariation)
                        <tr>
                            <td>{{$productVariation['id']}}</td>
                            <td>{{$productVariation['name']}}</td>
                            <td>{{$productVariation['price']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>


        @endforeach
    </div>
    <div class="pagination">
        @for($i=0;$i< ceil($count/2); $i++)
            <a href="{{$hrefString}}&page={{$i}}" class="{{$i==$currentPage ? 'active' : ''}}">{{$i+1}}</a>

        @endfor
    </div>


@endsection
