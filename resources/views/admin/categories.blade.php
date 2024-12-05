{{-- @extends('layouts.main', ['admin', $admin]) --}}
@extends('layouts.main')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Categories</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Categories
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Products number</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                @if($category->products->isEmpty())
                                    <td>-</td>
                                @else
                                    <td> {{$category->products->count()}} </td>
                                @endif
                                <td><img src= "{{ asset($category->img) }}" width="70" height="70" alt="Category Image"></td>
                                    <th scope="row">
                                        <div class="action d-flex flex-row">
                                            <a href="{{URL::to('/admin/editCategory/' . $category->id )}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                            @if(@empty($category->deleted_at))
                                            <a href="{{URL::to('/admin/destroyCategory/' . $category->id )}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            @else
                                            <a href="{{URL::to('/admin/restoreCategory/' . $category->id )}}" class="btn btn-danger"><i class="fa fa-refresh"></i></a>
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
