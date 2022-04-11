@extends('admin.mainlayout.master')
@section('title','Admin : Settings')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Website Settings</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
         <!-- Add Form Start -->
                    
         <div class="row" id="addContainer">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    {{-- @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{Session::get('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif --}}
                    <div class="panel-body">

                        <form role="form" id="addSettinForm" action="{{route('sitesetting.update')}}" method="POST">
                            @csrf

                            <input type="hidden" value="{{isset($setting->id)? $setting->id : ''}}" name="id">
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 form-group">
                                    <label class="form-control-label">Phone 1: <span class="text-danger">*</span></label>
                                    <input type="text" value="{{isset($setting->phone_one)? $setting->phone_one : ''}}" name="phone_one" required class="form-control">
                                </div>
                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Phone 2:</label>
                                    <input type="text" value="{{isset($setting->phone_two)?$setting->phone_two: ''}}" name="phone_two" class="form-control">
                                </div>

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Company Email: <span class="text-danger">*</span></label>
                                    <input type="email" value="{{isset($setting->email)?$setting->email:''}}" name="email" required class="form-control">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{isset($setting->company_name)?$setting->company_name:''}}" name="company_name" required class="form-control">
                                </div>
                            
                        
                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Company Address <span class="text-danger">*</span></label>
                                    <input type="text" value="{{isset($setting->company_address)?$setting->company_address : ''}}" name="company_address" required class="form-control">
                                </div>
                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Facebook</label>
                                    <input type="text" value="{{isset($setting->facebook)?$setting->facebook :''}}" name="facebook" class="form-control">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">You tube</label>
                                    <input type="text" value="{{isset($setting->youtube)?$settung->youtube:''}}" name="youtube" class="form-control">
                                </div>

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Instagram </label>
                                    <input type="text" value="{{isset($setting->instagram)?$setting->instagram:''}}" name="instagram" class="form-control">
                                </div>
                            

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Twitter</label>
                                    <input type="text" value="{{isset($setting->twitter)?$setting->twitter:''}}" name="twitter" class="form-control">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">Developed By <span class="text-danger">*</span></label>
                                    <input type="text" value="{{isset($setting->created_by_company)?$setting->created_by_company:''}}" required name="created_by_company" class="form-control">
                                </div>

                                <div class="col-lg-4 col-sm-12 form-group">                                   
                                    <label class="form-control-label">URL of IT company<span class="text-danger">*</span></label>
                                    <input type="text" value="{{isset($setting->created_by_company_link)?$setting->created_by_company_link:''}}" required name="created_by_company_link" class="form-control">
                                </div>

                            </div>
                            <div class="row">
                                <br>

                                <div class="col-lg-4 col-sm-12 form-group">
                                   <button type="submit" class="btn btn-outline btn-info">Update</button>
                                </div>
                            </div> 
                          
                        </form>
                     </div>                   
                </div>                
              </div>
         </div>
    
        <!-- Add Form End --> 
         
        
            
                
                <!-- /.panel -->
                
                 
            
        </div>
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
 
