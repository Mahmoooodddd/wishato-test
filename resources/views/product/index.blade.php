@extends('layouts.app')

@section('content')
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
    </table>
    @foreach($products as $product)
        <table>
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
            </tr>
        </table>

    @endforeach

    {{$products->render()}}



@endsection
