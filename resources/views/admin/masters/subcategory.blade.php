@extends('admin.mainlayout.master')
@section('title','Admin : Sub-Category')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sub-Category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
         <!-- Add Form Start -->
                    
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Sub-Category
                    </div>
                    <div class="panel-body">
                        <form role="form" id="addForm" action="{{route('add.subcategory')}}" method="POST">
                            @csrf
                           
                            <div class="form-group col-md-6">
                                <label for="inputState">Select Category</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Sub-Category Name</label>
                                <input type="text" class="form-control" id=" " name="" require>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Description</label> 
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>
                            <h5><b>SEO Prameters</b></h5> <hr>
                            <div class="form-group col-md-4">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id=" " name="" require>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="">Keywords</label>
                                <input type="text" class="form-control" id=" " name="" require>
                            </div>
                         
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Description</label> 
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline btn-primary">Add</button>
                            <button type="reset" class="btn btn-outline btn-default">Reset</button>
                               
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
                       Add Sub-Category
                    </div>
                    <div class="panel-body">
                        <form role="form" id="editForm" action="{{route('update.category')}}" method="POST">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="inputcategory">Select Category</label>
                                <select id="category" class="form-control">
                                    <option selected>Choose...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Sub-Category Name</label>
                                <input type="text" class="form-control" id=" " name="" require>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Description</label> 
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>
                            <h5><b>SEO Prameters</b></h5> <hr>
                            <div class="form-group col-md-4">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id=" " name="" require>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="">Keywords</label>
                                <input type="text" class="form-control" id=" " name="" require>
                            </div>
                         
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Description</label> 
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline btn-primary">Update</button>                        
                            <button type="reset" class="btn btn-outline btn-default">Reset</button>
                                
                          
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
 
