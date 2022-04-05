
@extends('admin.mainlayout.master')
@section('title','Admin : Category')

@section('contents')
 
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">Product</h1>
        </div>
            <!-- /.col-lg-12 -->
        
        <div class="row ">
            <div class="col-md-10">               
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    Manage Products
                    </div>
                    <div class="panel-body" >
                            
                        <a href="{{ route('products.create.step.one') }}" class="btn btn-primary pull-right">Create Product</a>

                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->amount}}</td>
                                    <td>{{$product->status ? 'Active' : 'DeActive'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="float-end">
                        @if(request()->has('trashed'))
                            <a href="{{ route('product.trash.index') }}" class="btn btn-info">Trash </a>
                            <a href="{{ route('posts.restoreAll') }}" class="btn btn-success">Restore All</a>
                        @else
                            <a href="{{ route('product.trash.index') }}" class="btn btn-primary">View Deleted posts</a>
                        @endif
                </div>
            </div>
        </div>
   </div>
</div>