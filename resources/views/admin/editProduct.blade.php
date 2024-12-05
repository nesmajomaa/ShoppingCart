@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Edit Product Form</li>
            </ol>

            @include('layouts.includes.update-status')
            @include('layouts.includes.error-messages')
            
<div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::to('/admin/updateProduct') }}"">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Product Form</h6>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingPassword" name="name" value="{{ $product->name }}">
                                <label for="floatingTextarea">Product Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="description" value="{{ $product->description }}">
                                <label for="floatingPrice">Product Description</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" name="category_id" aria-label="Floating label select example">
                                    @foreach($categories as $category)
                                    @if($category->id == $product->productCategory['id'])
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Category Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingPrice" name="price" value="{{ $product->price }}">
                                <label for="floatingTextarea">Price</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingPrice" name="quantity" value="{{ $product->quantity }}">
                                <label for="floatingTextarea">Quantity</label>
                            </div>
                            <div>
                                <input class="form-control form-control-lg bg-dark mb-3" name="img" placeholder="Photo" id="formFileLg" type="file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success m-2">Update</button>
                                <button type="reset" class="btn btn-primary m-2">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection