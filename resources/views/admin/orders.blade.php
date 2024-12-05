{{-- @extends('layouts.main', ['admin', $admin]) --}}
@extends('layouts.main')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Orders
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Last Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user['name']}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->last_price}}</td>
                                <th scope="row">
                                    <div class="action d-flex flex-row">
                                        <a href="{{URL::to('/admin/orderItems/' . $order->id )}}" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
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
