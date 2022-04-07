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
                                <select id="inputState" class="form-control" name="category_id" require>
                                    <option selected>Choose...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Sub-Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" require>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label> 
                                <textarea class="form-control" name="description" id="description" require></textarea>
                            </div>
                            <h5><b>SEO Prameters</b></h5> <hr>
                            <div class="form-group col-md-4">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id="seo_title" name="seo_title" require>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="">Keywords</label>
                                <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" require>
                            </div>
                         
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Description</label> 
                                <textarea name="seo_description" id="seo_description" class="form-control" ></textarea>
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
                       Edit Sub-Category
                    </div>
                    <div class="panel-body">
                        <form role="form" id="editForm" action="{{route('update.subcategory')}}" method="POST">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="inputcategory">Select Category</label>
                                <select id="category_id" class="form-control" name="category_id">
                                    <option selected>Choose...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Sub-Category Name</label>
                                <input type="hidden" class="form-control" id="id" name="id" required>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label> 
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>
                            <h5><b>SEO Prameters</b></h5> <hr>
                            <div class="form-group col-md-4">
                                <label for="seo_title">Title</label>
                                <input type="text" class="form-control" id="seo_title" name="seo_title">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="seo_keywords">Keywords</label>
                                <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" require>
                            </div>
                         
                            <div class="form-group col-md-12">
                                <label for="seo_description">Description</label> 
                                <textarea name="seo_description" id="seo_description" class="form-control"></textarea>
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
                                        <th width="3%">S. No</th>
                                        <th width="8%">Parent Category Name</th> 
                                        <th width="8%">Sub Category Name</th> 
                                        <th width="40%">Description</th> 
                                        <th width="30%">SEO Parameters</th>                                       
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($subcategories as $key=>$subcategory)
                                  <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$categories[$subcategory->category_id]->name}}</td>
                                        <td>{{$subcategory->name}}</td>
                                        <td>{!!$subcategory->description !!}</td>
                                        <td><b>Title: </b>{!!$subcategory->seo_title !!} <br>
                                            <b>Keywords:</b>{!!$subcategory->seo_keyword !!} <br>
                                            <b>Description:</b> {!!$subcategory->seo_description !!}<br>
                                        </td>
                                       
                                        <td> 
                                            <a href="#" class="btn btn-warning  btn-xs  edit-element" data-id="{{$subcategory->id}}">Edit</a>
                                             
                                            <a href="{{route('delete.subcategory',$subcategory->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
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
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/subcategory/get-category/'+id,
                type: 'GET',                
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1){

                        $("#addContainer").slideUp();
                        $("#btnCancel").show();		
                        $("#addToTable").hide();
                        $("#editContainer").slideDown();  
                    
                        $("#editForm select[name='category_id']").val(data.category.category_id); 
                        $("#editForm input[name='name']").val(data.category.name); 
                        $("#editForm textarea[name='description']").val(data.category.description); 
                        $("#editForm input[name='seo_title']").val(data.category.seo_title); 
                        $("#editForm input[name='seo_keywords']").val(data.category.seo_keyword); 
                        $("#editForm textarea[name='seo_description']").val(data.category.seo_description);                         
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
 
