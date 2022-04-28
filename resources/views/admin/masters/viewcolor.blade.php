@extends('admin.mainlayout.master')
@section('title','Admin : Size')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Size</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
         <!-- Add Form Start -->
                    
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Size
                    </div>
                    <div class="panel-body">
                        <form role="form" id="addForm" action="{{route('add.color')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Colour name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Color Code</label>
                                    <input type="color"  class="form-control" name="code" id="code" value="{{old('code')}}" required> 
                                </div>
                            </div> 
                     
                            <div class="row">   
                                <div class="col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-outline btn-primary">Add</button>
                                    <button type="reset" class="btn btn-outline btn-default">Reset</button>
                                </div>
                            </div>
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
    
        <!-- Add Form End --> 
        <!-- Edit Form Start -->
        
        <div class="row" id="editContainer" style="display:none;">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Edit Size
                    </div>
                     <div class="panel-body">
                        <form role="form" id="editForm" action="{{route('update.color')}}" method="POST">
                            @csrf
                            <div class="row">
                              
                                <div class="col-lg-3">
                                    <label>Colour name</label>
                                    <input type="hidden" name="color_id" id="color_id">
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Color Code</label>
                                    <input type="color"  class="form-control" name="code" id="code" value="{{old('code')}}" required> 
                                </div>
                            </div> 
                          
                            <div class="row">   
                                <div class="col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-outline btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline btn-default">Reset</button>
                                </div>
                            </div>
                        </form>
                     </div>                   
                </div>                
            </div>
        </div>
        <div class="row">
           <div class="col-lg-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Size Details
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
                                        <th>Color Name</th>
                                        <th>Color Code</th>
                                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($colors as $key=>$color)
                                <tr class="odd gradeX">
                                    <td>{{$key+1}}</td>
                                    <td>{{$color->name}}</td>
                                    <td>{{$color->color_code}}</td>
                                   
                                    <td class="center"> 
                                    <a href="#" class="btn btn-warning btn-xs  edit-element" data-id="{{$color->id}}">Edit</a>
                                    <a href="{{route('delete.color',$color->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
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
<!-- Get the size data -->
<script>
    $("#tableContainer").on("click",".edit-element",function(e){
            e.preventDefault();
            var color = $(this).attr('data-id');
            $.ajax({
                url: '/color/get-color/'+color,
                type: 'GET',                
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1){

                        $("#addContainer").slideUp();
                        $("#btnCancel").show();		
                        $("#addToTable").hide();
                        $("#editContainer").slideDown();  
                    
                        $("#editForm input[name='name']").val(data.color.name);
                        $("#editForm input[name='code']").val(data.color.color_code);                      
                        $("#editForm input[name='color_id']").val(color); 

            
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