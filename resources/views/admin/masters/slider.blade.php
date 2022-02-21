@extends('admin.mainlayout.master')
@section('title','Admin Sliders')

@section('contents')
<div id="page-wrapper">
    <div class="container-fluid">
   
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sliders</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
       

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible show" role="alert">
                 {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
         <!-- Add Form Start -->
        
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Banner
                    </div>
                    <div class="panel-body" >
                        <form method="POST" action="{{route('add.slider')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Title <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{old('title')}}" autocomplete="off" required> 
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Sub-Title <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="sub_title" value="{{old('sub_title')}}" autocomplete="off" required> 
                                @error('sub_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Slider Image <span style="color:red">*</span></label>
                                <span class="text-danger">Image size should be equalt or grater than 2000px X 930px.</span>
                                <input type="file" name="image" class="form-control" value="{{old('image')}}" required>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hyperlink </label>
                                <input type="link" class="form-control" name="hyperlink" value="{{old('vyperlink')}}" autocomplete="off"> 
                                @error('hyperlink')
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
       
         <div class="row" id="editContainer" style="display:none">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Edit Slider
                    </div>
                    <div class="panel-body" >
                        <form method="POST" id="editForm" name="editForm" action="{{route('update.slider')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Title <span style="color:red">*</span></label>
                                <input type="hidden" name="slider_id">
                                <input type="text" class="form-control" name="title" autocomplete="off" required> 
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Sub-Title <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="sub_title" autocomplete="off" required> 
                                @error('sub_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Slider Image </label>
                                <span class="text-danger">Image size should be equalt or grater than 2000px X 930px.</span>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hyperlink </label>
                                <input type="link" class="form-control" name="hyperlink" autocomplete="off" > 
                                @error('hyperlink')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <input type="submit" class="btn btn-outline btn-primary" value="Update">
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
                        Slider List
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
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Image</th>
                                        <th>Hyperlink</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($sliders as $slider)  
                                        <tr class="gradeU">
                                        <td>{!! $slider->title !!}</td>
                                        <td>{!! $slider->sub_title !!}</td>
                                        <td><img src="{{asset($slider->image_path)}}" style="width:70px;height:40px"></td>
                                        <td>{{$slider->hyperlink}}</td>
                                        <td>
                                            <!-- status -->
                                            @if($slider->status == 1)
                                                <a href="{{route('update-status.slider',$slider->id)}}" class="btn btn-success btn-xs status" id="status">Active</a>
                                            @else
                                               <a href="{{route('update-status.slider',$slider->id)}}" class="btn btn-danger btn-xs  status" id="status">Inactive</a>
                                            @endif
                                            <!-- status end  -->
                                            <a href="#" class="btn btn-warning  btn-xs  edit-element" data-id="{{$slider->id}}">Edit</a>
                                          
                                            <a href="{{route('delete.slider',$slider->id)}}" class="btn btn-danger btn-xs " id="delete">Delete</a>
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
            var slider = $(this).attr('data-id');
            $.ajax({
                url: '/slider/get-slider/'+slider,
                type: 'GET',                
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1){

                        $("#addContainer").slideUp();
                        $("#btnCancel").show();		
                        $("#addToTable").hide();
                        $("#editContainer").slideDown();  
                    
                        $("#editForm input[name='slider_id']").val(data.id); 
                        $("#editForm input[name='title']").val(data.title);
                        $("#editForm input[name='sub_title']").val(data.sub_title);
                        $("#editForm input[name='hyperlink']").val(data.hyperlink); 
                       

            
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
        confirmButtonText: 'Change Status!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
          {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your Data is safe with us :)',
            'error'
          )
        }
      })
        });
    });
    
 </script>
 <!---------------  update status alert ---------------->
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
            'Your data is safe with us:)',
            'error'
          )
        }
      })
        });
    });
    
    
 </script>
@endsection
 
