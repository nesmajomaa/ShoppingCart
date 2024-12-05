@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add New Category</h1>
            @include('layouts.includes.add-status')
            @include('layouts.includes.error-messages')

            <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::to('/admin/storeCategory') }}">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Category Form</h6>
                            <div class="form-floating mb-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Category Name">
                                <label for="floatingInput">Category Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="description" placeholder="Description">
                                <label for="floatingPrice">Category Description</label>
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
   
