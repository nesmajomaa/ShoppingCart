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
        <form method="post" enctype="multipart/form-data" action="{{ URL::to('/admin/updateCategory') }}">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Category Form</h6>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingPassword" name="name" value="{{ $category->name }}">
                                <label for="floatingTextarea">Category Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="description" value="{{ $category->description }}">
                                <label for="floatingPrice">Category Description</label>
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