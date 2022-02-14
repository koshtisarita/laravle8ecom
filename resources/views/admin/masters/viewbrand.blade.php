@extends('admin.mainlayout.master')
@section('title','Admin Brands')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">
   
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Brands</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        @if(Session::has('addmessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{Session::get('addmessage')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if(session('editmessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{session('editmessage')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
         <!-- Add Form Start -->
        
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                       Add Brand
                    </div>
                    <div class="panel-body" >
                        <form method="POST" action="{{route('add.brand')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Brand Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="brand_name" autocomplete="off"> 
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
                                <textarea class="form-control" rows="3" name="brand_short_desc" autocomplete="off"></textarea>
                                @error('brand_short_desc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <input type="submit" class="btn btn-outline btn-primary" value="submit">
                            <input type="reset" class="btn btn-outline btn-default" value="update">
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
    
       
        <div class="row">
           <div class="col-lg-10">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Brand List
                    </div>
                    <div class="panel-body">
                        <div >
                            <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus fa-fw"></i></button>
                            <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button> 
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tableContainer">
                                <thead>
                                    <tr>
                                        <th>Brands</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @foreach($brands as $brand)  
                                        <tr class="gradeU">
                                        <td>{{$brand->brand_name}}</td>
                                        <td><img src="{{asset($brand->brand_image)}}" style="width:70px;height:40px"></td>
                                        <td>{{$brand->brand_short_desc}}</td>
                                        <td>
                                            <a href="{{route('edit.brand',$brand->id)}}" class="btn btn-warning">Edit</a>
                                            <a href="{{route('delete.brand',$brand->id)}}" class="btn btn-danger" id="delete">Delete</a>
                                        </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>     
                </div>
            </div>
            <!-- /.col-lg-8 -->   
        <!-- /.panel -->
                
                 
            
        </div>
        <!-- /.row -->
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
<script type="text/javascript">
    $(function(){
        $(document).on('click','#delete',function(e){
            e.preventDefault();
            var link=$(this).attr("href");
            const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      })
        });
    });
    
      </script>
@endsection
 
