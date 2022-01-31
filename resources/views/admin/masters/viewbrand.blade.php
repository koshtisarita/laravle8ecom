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
         <!-- Add Form Start -->
                    
         <div class="row" id="addContainer" style="display:none;">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Add Brand
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <input class="form-control" name="name" id="name"> 
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Brand Image</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label>Brand Detail</label>
                                <textarea class="form-control" rows="3" name="bdetail" id="bdetail"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-outline btn-primary">Add</button>
                            <button type="reset" class="btn btn-outline btn-default">Reset</button>
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
                        Edit Brand
                    </div>
                     <div class="panel-body">
                            <form role="form">
                                <div class="form-group">
                                    <label>Brand Name</label>
                                    <input class="form-control" name="name" id="name"> 
                                    <input class="form-control hidden" name="id" id="id"> 
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>Brand Image</label>
                                    <input type="file" name="image" id="image">
                                </div>
                                <div class="form-group">
                                    <label>Brand Detail</label>
                                    <textarea class="form-control" rows="3" name="bdetail" id="bdetail"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-outline btn-primary">Update</button>
                                <button type="reset" class="btn btn-outline btn-default">Reset</button>
                            </form>
                     </div>                   
                </div>                
            </div>
        </div>
        <div class="row">
           <div class="col-lg-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Brand Details
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
                                        <th>S. No</th>
                                        <th>Brands</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                        <td>Gecko</td>
                                        <td>Mozilla 1.0</td>
                                        <td>Win 95+ / OSX.1+</td>
                                        <td class="center">1</td>
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                    <tr class="gradeA">
                                        <td>Gecko</td>
                                        <td>Mozilla 1.1</td>
                                        <td>Win 95+ / OSX.1+</td>
                                        <td class="center">1.1</td>
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                    <tr class="gradeA">
                                        <td>Gecko</td>
                                        <td>Mozilla 1.2</td>
                                        <td>Win 95+ / OSX.1+</td>
                                        <td class="center">1.2</td>
                                        <td class="center"> 
                                        <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                    <tr class="gradeA">
                                        <td>Gecko</td>
                                        <td>Mozilla 1.3</td>
                                        <td>Win 95+ / OSX.1+</td>
                                        <td class="center">1.3</td>
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                    <tr class="gradeA">
                                        <td>Gecko</td>
                                        <td>Mozilla 1.4</td>
                                        <td>Win 95+ / OSX.1+</td>
                                        <td class="center">1.4</td>
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                
                                    <tr class="gradeU">
                                        <td>Other browsers</td>
                                        <td>All others</td>
                                        <td>-</td>
                                        <td class="center">-</td>
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
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
@endsection
 
