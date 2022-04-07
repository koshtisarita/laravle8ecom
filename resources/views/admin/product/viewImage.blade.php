@extends('admin.mainlayout.master')
@section('title','Admin Product Images')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">
   
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Images : {{$product->title}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
         <!-- Add Form Start -->
        
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Image
                    </div>
                    <div class="panel-body" >
                        <form method="POST" action="{{route('add.image')}}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label>Select Image <span style="color:red">*</span></label>
                                <input type="hidden" name='product_id' id="product_id" value="{{$product->id}}"/>
                                <input type="file" name="image[]" class="form-control" multiple required>
                                <span class="text-danger">You can select multipale images from there</span>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            
                            <input type="submit" class="btn btn-outline btn-primary" value="Submit">
                            <input type="reset" class="btn btn-outline btn-default" value="Reset">
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
       
        
         
        <div class="row">
           <div class="col-lg-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Images
                    </div>
                    <div class="panel-body">
                        <div >
                            <button id="addToTable" class="btn btn-primary btn-xs">Add <i class="fa fa-plus fa-fw"></i></button>
                            <button id="btnCancel" class="btn btn-danger btn-xs" style="display:none;">Cancel</button> 
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tableContainer">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product_images as $key=>$image)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{asset($image->image_path)}}" target="_blank">
                                                    <img src="{{asset($image->image_path)}}" width="100" height="100"/>
                                                </a>   
                                            </td>
                                            <td>
                                            <a href="{{route('delete.image',$image->id)}}" class="btn btn-danger  " id="delete">Delete</a>
                                       
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
            var brand = $(this).attr('data-id');
            $.ajax({
                url: '/brand/get-brand/'+brand,
                type: 'GET',                
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1){

                        $("#addContainer").slideUp();
                        $("#btnCancel").show();		
                        $("#addToTable").hide();
                        $("#editContainer").slideDown();  
                    
                        $("#editForm input[name='brand_name']").val(data.brand.brand_name);
                        $("#editForm textarea[name='brand_short_desc']").val(data.brand.brand_short_desc); 
                        $("#editForm input[name='brand_id']").val(data.brand.id); 

            
                     }
                     else{
                        $("#addContainer").slideDown();
                        $("#btnCancel").hide();
                        $("#addToTable").show();
                        alert(result.message);
                     }
                      

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Some thing went wrong");
                },
            });
           
        });
    });
</script>

<!---------------  delete alert ---------------->
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
            'Your data has been deleted.',
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your data is safe with us :)',
            'error'
          )
        }
      })
        });
    });
    
 </script>
@endsection
 
