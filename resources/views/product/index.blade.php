@extends('layouts.app')

@section('content')
    @foreach($products as  $product)
        <p>{{$product['productId']}}</p>
        <p>{{$product['productName']}}</p>

        <table>
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
    @endforeach



@endsection
