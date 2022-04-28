
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
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Brand Name</th>
                                <th>Amount</th>
                                <th>Size/Lenght</th>
                                <th>Status/Stock</th>
                                <th>Action</th>
                                <th>Detail Images </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key=>$product)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>
                                    @if($product->default_image)                                     
                                     <img src="{{$product->default_image}}" width="100px" height="100px"><br>         
                                    @endif
                                    <b>{{$product->title}}</b></td>
                                    <td>
                                        {!!$product->short_description !!} <br>
                                        <a href="#" data-id="{{$product->id}}" class="show_long_description">View More</a>
                                   </td>                                   
                                    <td>
                                        @php
                                            $p_categories = json_decode($product->categories);
                                            $p_cat_names ="";
                                            
                                        @endphp
                                        
                                        @foreach($p_categories as $key=>$p_cat)
                                             @if($key < count($p_categories)-1)
                                                {{$categories[$p_cat]->name}}, 
                                             @else
                                                 {{$categories[$p_cat]->name}}
                                             @endif                                              
                                        @endforeach
                                        
                                    </td>
                                    <td>  
                                        @php
                                            $p_categories = json_decode($product->sub_categories);
                                            $p_cat_names ="";
                                            
                                        @endphp
                                        @foreach($p_categories as $key=>$p_cat)
                                             @if($key < count($p_categories)-1)
                                                {{$sub_categories[$p_cat]->name}},
                                             @else
                                                 {{$sub_categories[$p_cat]->name}}
                                             @endif                                              
                                        @endforeach
                                        
                                    </td>
                                    <td>{{$product->brand_name}}</td>
                                    <td>
                                        Actual Price: £{{$product->actual_price}}<br>
                                        <span style="color:blue">Discounted Price: £{{$product->discount}}</span>
                                    </td>
                                    <td>
                                          @php  $p_sizes = json_decode($product->size_id); @endphp
                                          <b>Lenght: </b> {{$product->length}}<br>
                                          <b>Sizes: </b><br> 
                                          @foreach($p_sizes as $key=>$p_size)
                                             @if($key < count($p_sizes)-1)
                                                {{$sizes[$p_size]->size_no}}/{{$sizes[$p_size]->size_shortcut}}, 
                                             @else
                                                {{$sizes[$p_size]->size_no}}/{{$sizes[$p_size]->size_shortcut}}
                                             @endif                                              
                                        @endforeach
                                    </td>
                                    <td>
                                         <!-- status -->
                                         @if($product->status == 1)
                                            <a href="{{route('update-status.product',$product->id)}}" class="btn btn-success btn-xs status" id="status">Active</a>
                                        @else
                                            <a href="{{route('update-status.product',$product->id)}}" class="btn btn-danger btn-xs  status" id="status">Inactive</a>
                                        @endif
                                        <!-- status end  -->
                                        <br><br>
                                        <!-- status -->
                                        @if($product->in_stock == 1)
                                            <a href="{{route('update-stock.product',$product->id)}}" class="btn btn-success btn-xs status" id="status">In Stock</a>
                                        @else
                                            <a href="{{route('update-stock.product',$product->id)}}" class="btn btn-danger btn-xs  status" id="status">Out Of Stock</a>
                                        @endif
                                        <!-- status end  -->
                                    </td>
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
<!-- The Modal -->
<div class="modal" id="description_modal">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Description</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <div id="result"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- jQuery -->
<script src="{{asset('template/js/jquery.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#tableContainer').DataTable({
                responsive: true
        });
    });
</script>
<script>
$(".show_long_description").click(function(){
   var id = $(this).attr('data-id');
 
   $.ajax({
            url: '{{route("get.description.product")}}',
            type: 'POST',   
            data:{'id':id,'_token':"{{ csrf_token() }}"},             
            success: function(data, textStatus, jqXHR) {                   
                  console.log(data);
                  if(data.result == 1){
                    $('#description_modal #result').html(data.long_description);
                    $('#description_modal').modal("show");
                  }
                  else{
                    alert("Some thing went wrong");
                  }
                  

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
});
</script>    
@endsection
