@extends('admin.mainlayout.master')
@section('title','Admin : Category')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
         <!-- Add Form Start -->
                    
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Category
                    </div>
                    <div class="panel-body">
                        <form role="form" id="addForm" action="{{route('add.category')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2 col-sm-12">
                                    <label>Category Name</label>
                                </div>
                                <div class="col-lg-3 col-sm-12">                                   
                                    <input type="text" class="form-control" name="name" id="name" required> 
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button type="submit" class="btn btn-outline btn-primary">Add</button>
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                   <button type="reset" class="btn btn-outline btn-default">Reset</button>
                                </div>
                            </div> 
                          
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
    
        <!-- Add Form End --> 
          <!-- Add Form Start -->
           
            <!-- end Edit container  -->
          <div class="row" id="editContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Category
                    </div>
                    <div class="panel-body">
                        <form role="form" id="editForm" action="{{route('update.category')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2 col-sm-12">
                                    <label>Category Name</label>
                                </div>
                                <div class="col-lg-3 col-sm-12">   
                                    <input type="hidden" class="form-control" name="id" id="id" required>                                
                                    <input type="text" class="form-control" name="name" id="name" required> 
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button type="submit" class="btn btn-outline btn-primary">Update</button>
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                   <button type="reset" class="btn btn-outline btn-default">Reset</button>
                                </div>
                            </div> 
                          
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
         <!-- end Edit container  -->
        <div class="row">
           <div class="col-lg-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Category Details
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
                                        <th>S. No</th>
                                        <th>Category Name</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key=>$category)
                                    <tr class="odd gradeX">
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->name}}</td> 
                                        <td class="center"> 
                                            <a href="#" class="btn btn-warning btn-xs  edit-element" data-id="{{$category->id}}">Edit</a>
                                            <a href="{{route('delete.category',$category->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
                                       
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

        $("#tableContainer").on("click",".edit-element",function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/category/get-category/'+id,
                type: 'GET',                
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1){

                        $("#addContainer").slideUp();
                        $("#btnCancel").show();		
                        $("#addToTable").hide();
                        $("#editContainer").slideDown();  
                    
                        $("#editForm input[name='name']").val(data.category.name); 
                        $("#editForm input[name='id']").val(id); 

            
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
            'Your data is safe :)',
            'error'
          )
        }
      })
        });
    });
    
 </script>
@endsection 
 
