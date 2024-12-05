@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add New Product</h1>

            @include('layouts.includes.add-status')
            @include('layouts.includes.error-messages')
            
<div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::to('/admin/storeProduct') }}">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Product Form</h6>
                            <div class="form-floating mb-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Product Name">
                                <label for="floatingInput">Product Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="description" placeholder="Description">
                                <label for="floatingPrice">Product Description</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" name="category_id" aria-label="Floating label select example">
                                    <option value="-1"></option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Category name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingPrice" name="price" placeholder="Price">
                                <label for="floatingPrice">Price</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingPrice" name="quantity" placeholder="Quantity">
                                <label for="floatingPrice">Quantity</label>
                            </div>
                            <div>
                                <input class="form-control form-control-lg mb-3" name="img" placeholder="Product Image" id="formFileLg" type="file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success m-2">Add</button>
                                <button type="reset" class="btn btn-primary m-2">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection