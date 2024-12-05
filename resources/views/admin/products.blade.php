{{-- @extends('layouts.main', ['admin', $admin]) --}}
@extends('layouts.main')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Products</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Products
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Product Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sales</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->productCategory['name']}}</td> 
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td> {{$product->sales}} </td>
                                <td><img src= "{{ asset($product->img) }}" width="70" height="70" alt="Product Image"></td>
                                    <th scope="row">
                                        <div class="action d-flex flex-row">
                                            <a href="{{URL::to('/admin/editProduct/' . $product->id )}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                            @if(@empty($product->deleted_at))
                                            <a href="{{URL::to('/admin/destroyProduct/' . $product->id )}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            @else
                                            <a href="{{URL::to('/admin/restoreProduct/' . $product->id )}}" class="btn btn-danger"><i class="fa fa-refresh"></i></a>
                                            @endif
                                        </div>
                                    </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
</main>
@endsection
