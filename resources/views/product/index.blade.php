@extends('layouts.app')

@section('content')
    <form action="/product" method="get">
        <div class="form-group">
        <label for="fname" class="col-form-label">name:</label>
        <input type="text" id="name" name="name">
        <bottun type="submit" class="btn btn-primary" >search</bottun>
            <a href="/product" class="btn btn-danger">Reset Filters</a>
        </div>
    </form>
    @foreach($products as  $product)
        <table class="table table-bordered table-hover">
            <th style="font-size:25px;width: 1000px;text-align:center">{{$product['productName']}}</th>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
            </tr>
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
    @endforeach
    <div class="pagination">
        @for($i=0;$i< ceil($count/2); $i++)
            <a href="{{$hrefString}}&page={{$i}}" class="{{$i==$currentPage ? 'active' : ''}}">{{$i+1}}</a>

        @endfor
    </div>


@endsection
