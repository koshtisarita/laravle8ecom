@extends('admin.mainlayout.master')
@section('title','Admin Brands')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">
   
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Brands</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!------------------ SUCCESS MESSAGE-------------------->
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

         <!--------------- EDIT FORM START OF CODE ----------------->
        
         <div class="row" id="editContainer">
              <div class="col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                       Edit Brand
                    </div>
                    <div class="panel-body" >
                        <form method="POST" action="{{route('update.brand',$brand->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$brand->brand_image}}" name="old_image">

                            <div class="form-group">
                                <label>Brand Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="brand_name" autocomplete="off" value="{{$brand->brand_name}}"> 
                                @error('brand_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Brand Image <span style="color:red">*</span></label>
                                <input type="file" name="brand_image" class="form-control">
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Brand Short Description <span style="color:red">*</span></label>
                                <textarea class="form-control" rows="3" name="brand_short_desc" autocomplete="off">{{$brand->brand_short_desc}}</textarea>
                                @error('brand_short_desc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <input type="submit" class="btn btn-outline btn-primary" value="Update">
                            
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
    <!-----------------------------------END OF EDIT FORM CODE---------------------->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->






<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<!-- jQuery -->
<script src="{{asset('template/js/jquery.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#tableContainer').DataTable({
                responsive: true
        });
     
        $("#addToTable").click(function(){
            
            $("#addContainer").slideDown();
            $("#editContainer").slideUp();
            $(this).hide();
            $("#btnCancel").show();
        });


        $("#btnCancel").click(function(){
            $("#addContainer").slideUp();
            $("#editContainer").slideUp();
            $(this).hide();
            $("#addToTable").show();
        
        });
        $("#tableContainer").on("click",".edit-element",function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $("#addContainer").slideUp();
            $("#btnCancel").show();		
            $("#addToTable").hide();
            $("#editContainer").slideDown();
        });
    });
</script>
@endsection
 
