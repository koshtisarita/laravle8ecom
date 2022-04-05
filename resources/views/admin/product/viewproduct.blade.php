
@extends('admin.mainlayout.master')
@section('title','Admin : Products')

@section('contents')
 
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-8 page-header">
                    <h1 class="">Products</h1>
                   
                </div>
                <div class="col-lg-2 page-header">
                    <a href="{{ route('products.create.step.one') }}" class="btn btn-primary pull-right">Create Product</a>                 
                </div>
                <div class="col-lg-2 page-header">                   
                     <a href="{{ route('product.trash.index') }}" class="btn btn-primary">View Deleted posts</a>                   
                </div>
        </div>
            <!-- /.col-lg-12 -->
        
        <div class="row ">
            <div class="col-md-12">               
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Manage Products 
                     
                    </div>    
                    <div class="panel-body" >
                            
                         <br>
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="tableContainer">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">S. No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Image </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key=>$product)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$product->title}}</td>
                                    <td>{!!$product->long_description !!}</td>
                                    <td>{{$product->brand_id}}</td>
                                    <td>{{$product->actual_price}}</td>
                                    <td>{{$product->status ? 'Active' : 'DeActive'}}</td>
                                    <td class="center"> 
                                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning btn-xs  edit-element" target="_blank">Edit</a>
                                            <a href="{{route('product.destroy',$product->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
                                    </td>               
                                    <td class="center"> 
                                            <a href="{{route('product.image.view',$product->id)}}" class="btn btn-warning btn-xs  edit-element" target="_blank">Add/Delete</a>
                                          
                                    </td> 
                                    </tr>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="float-end">
                      
                </div>
            </div>
        </div>
   </div>
</div>