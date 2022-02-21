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
                        <form role="form" id="addForm" action="{{route('add.size')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Size Number</label>
                                    <input type="number" class="form-control" name="size_no" id="size_no" value="{{old('size_no')}}" required> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Size Value</label>
                                    <input type="text"  class="form-control" name="size_shortcut" id="size_shortcut" value="{{old('size_shortcut')}}" required> 
                                </div>
                            </div> 
                            <div class="row">   
                                <div class="col-lg-3">
                                    <label>Waist</label>
                                    <input type="number"  class="form-control" name="waist_size" id="waist_size" value="{{old('waist_size')}}" required> 
                                    <p class="help-block">(In CM)</p>

                                </div>
                                <div class="col-lg-3">
                                    <label>Hip</label>
                                    <input type="number"  class="form-control" name="hip_size" id="hip_size" value="{{old('hip_size')}}" required> 
                                    <p class="help-block">(In CM)</p>
                                </div>
                                <div class="col-lg-3">
                                    <label>Chest</label>
                                    <input type="number"  class="form-control" name="chest_size" id="chest_size" value="{{old('chest_size')}}" required>
                                    <p class="help-block">(In CM)</p> 
                                </div>
                                <!-- <div class="col-lg-3">
                                    <label>Length</label>
                                    <input type="text"  class="form-control" name="name" id="name">
                                    <p class="help-block">(In CM)</p> 
                                </div> -->
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
                        <form role="form" id="editForm" action="{{route('update.size')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Size Number</label>
                                    <input type="hidden" name="size_id" id="size_id">
                                    <input type="number" class="form-control" name="size_no" id="size_no" value="{{old('size_no')}}" required> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Size Value</label>
                                    <input type="text"  class="form-control" name="size_shortcut" id="size_shortcut" value="{{old('size_shortcut')}}" required> 
                                </div>
                            </div> 
                            <div class="row">   
                                <div class="col-lg-3">
                                    <label>Waist</label>
                                    <input type="number"  class="form-control" name="waist_size" id="waist_size" value="{{old('waist_size')}}" required> 
                                    <p class="help-block">(In CM)</p>

                                </div>
                                <div class="col-lg-3">
                                    <label>Hip</label>
                                    <input type="number"  class="form-control" name="hip_size" id="hip_size" value="{{old('hip_size')}}" required> 
                                    <p class="help-block">(In CM)</p>
                                </div>
                                <div class="col-lg-3">
                                    <label>Chest</label>
                                    <input type="number"  class="form-control" name="chest_size" id="chest_size" value="{{old('chest_size')}}" required>
                                    <p class="help-block">(In CM)</p> 
                                </div>
                                <!-- <div class="col-lg-3">
                                    <label>Length</label>
                                    <input type="text"  class="form-control" name="name" id="name">
                                    <p class="help-block">(In CM)</p> 
                                </div> -->
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
                                        <th>Size No/Size Shortcut</th>
                                        <th>Waist Size</th>
                                        <th>Hip Size</th>
                                        <th>Chest Size</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sizes as $key=>$size)
                                <tr class="odd gradeX">
                                    <td>{{$key+1}}</td>
                                    <td>{{$size->size_no}}/{{$size->size_shortcut}}</td>
                                    <td>{{$size->waist_size}}</td>
                                    <td>{{$size->hip_size}}</td>
                                    <td>{{$size->chest_size}}</td> 
                                    <td class="center"> 
                                    <a href="#" class="btn btn-warning btn-xs  edit-element" data-id="{{$size->id}}">Edit</a>
                                    <a href="{{route('delete.size',$size->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
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
            var size = $(this).attr('data-id');
            $.ajax({
                url: '/size/get-size/'+size,
                type: 'GET',                
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1){

                        $("#addContainer").slideUp();
                        $("#btnCancel").show();		
                        $("#addToTable").hide();
                        $("#editContainer").slideDown();  
                    
                        $("#editForm input[name='size_no']").val(data.size.size_no);
                        $("#editForm input[name='size_shortcut']").val(data.size.size_shortcut);
                        $("#editForm input[name='waist_size']").val(data.size.waist_size);
                        $("#editForm input[name='hip_size']").val(data.size.hip_size);
                        $("#editForm input[name='chest_size']").val(data.size.chest_size); 
                        $("#editForm input[name='size_id']").val(size); 

            
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