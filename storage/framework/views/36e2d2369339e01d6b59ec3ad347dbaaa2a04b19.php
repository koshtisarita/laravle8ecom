
<?php $__env->startSection('title','Admin : Size'); ?>

<?php $__env->startSection('contents'); ?>
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
                        <form role="form">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Size Number</label>
                                    <input type="number" class="form-control" name="name" id="name"> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Size Value</label>
                                    <input type="text"  class="form-control" name="name" id="name"> 
                                </div>
                            </div> 
                            <div class="row">   
                                <div class="col-lg-3">
                                    <label>Waist</label>
                                    <input type="text"  class="form-control" name="name" id="name"> 
                                    <p class="help-block">(In CM)</p>

                                </div>
                                <div class="col-lg-3">
                                    <label>Hip</label>
                                    <input type="text"  class="form-control" name="name" id="name"> 
                                    <p class="help-block">(In CM)</p>
                                </div>
                                <div class="col-lg-3">
                                    <label>Chest</label>
                                    <input type="text"  class="form-control" name="name" id="name">
                                    <p class="help-block">(In CM)</p> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Length</label>
                                    <input type="text"  class="form-control" name="name" id="name">
                                    <p class="help-block">(In CM)</p> 
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
                         <form role="form">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Size Number</label>
                                    <input type="number" class="form-control" name="name" id="name"> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Size Value</label>
                                    <input type="text"  class="form-control" name="name" id="name"> 
                                </div>
                            </div> 
                            <div class="row">   
                                <div class="col-lg-3">
                                    <label>Waist</label>
                                    <input type="text"  class="form-control" name="name" id="name"> 
                                    <p class="help-block">(In CM)</p>

                                </div>
                                <div class="col-lg-3">
                                    <label>Hip</label>
                                    <input type="text"  class="form-control" name="name" id="name"> 
                                    <p class="help-block">(In CM)</p>
                                </div>
                                <div class="col-lg-3">
                                    <label>Chest</label>
                                    <input type="text"  class="form-control" name="name" id="name">
                                    <p class="help-block">(In CM)</p> 
                                </div>
                                <div class="col-lg-3">
                                    <label>Length</label>
                                    <input type="text"  class="form-control" name="name" id="name">
                                    <p class="help-block">(In CM)</p> 
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
        <div class="row">
           <div class="col-lg-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        Size Details
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
                                        <th>Size Info</th>
                                        <th>Size Description</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        
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
                                        <td class="center"> 
                                            <button type="button" class="btn btn-warning btn-xs edit-element">Edit</button>
                                            <button type="button" class="btn btn-primary btn-xs delete-element">Delete</button>
                                            <button type="button" class="btn btn-success btn-xs activate-element">Active</button>
                                        </td>
                                    </tr>
                                
                                    <tr class="gradeU">
                                        <td>Other browsers</td>
                                        <td>All others</td> 
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
<script src="<?php echo e(asset('template/js/jquery.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>
 

<?php echo $__env->make('admin.mainlayout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\kosti\LARAVEL PRO\ecom\resources\views/admin/masters/viewsize.blade.php ENDPATH**/ ?>