@extends('admin.mainlayout.master')
@section('title','Admin : Pincode')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pincode</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
         <!-- Add Form Start -->
                    
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Pincode
                    </div>
                    <div class="panel-body">
                        <form role="form" id="addForm" action="{{route('add.pincode')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2 col-sm-12">
                                    <label>Pincode Number</label>
                                </div>
                                <div class="col-lg-3 col-sm-12">                                   
                                    <input type="number" class="form-control" name="pincode" id="pincode" required> 
                                    @error('pincode')
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
         
        <div class="row">
           <div class="col-lg-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Pincode Details
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
                                        <th>Pincode Number</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pincodes as $key=>$pincode)
                                    <tr class="odd gradeX">
                                        <td>{{$key+1}}</td>
                                        <td>{{$pincode->pincode}}</td> 
                                        <td class="center"> 
                                            <!-- status -->
                                            @if($pincode->status == 1)
                                                <a href="{{route('update-status.pincode',$pincode->id)}}" class="btn btn-success btn-xs status" id="status">Active</a>
                                            @else
                                               <a href="{{route('update-status.pincode',$pincode->id)}}" class="btn btn-danger btn-xs  status" id="status">Inactive</a>
                                            @endif
                                            <!-- status end  -->
                                             <a href="{{route('delete.pincode',$pincode->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
                                       
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
 
