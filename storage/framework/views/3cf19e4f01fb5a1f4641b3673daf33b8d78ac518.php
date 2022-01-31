<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo e(asset('template/css/bootstrap.min.css')); ?>" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo e(asset('template/css/metisMenu.min.css')); ?>" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="<?php echo e(asset('template/css/timeline.css')); ?>" rel="stylesheet">

         <!-- DataTables CSS -->
         <link href="<?php echo e(asset('template/css/dataTables/dataTables.bootstrap.css')); ?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo e(asset('template/css/startmin.css')); ?>" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo e(asset('template/css/morris.css')); ?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo e(asset('template/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

                <?php echo $__env->make('admin.mainlayout.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                 <?php echo $__env->yieldContent('contents'); ?>

        </div>



        <!---footer----->

        <!-- jQuery -->
        <!-- <script src="<?php echo e(asset('template/js/jquery.js')); ?>"></script> -->
        <script src="<?php echo e(asset('template/js/jquery.min.js')); ?>"></script>
        

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo e(asset('template/js/bootstrap.min.js')); ?>"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo e(asset('template/js/metisMenu.min.js')); ?>"></script>

        <!-- Morris Charts JavaScript -->
        <script src="<?php echo e(asset('template/js/raphael.min.js')); ?>"></script>
        <!-- <script src="<?php echo e(asset('template/js/morris.min.js')); ?>"></script>
        <script src="<?php echo e(asset('template/js/morris-data.js')); ?>"></script> -->

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo e(asset('template/js/startmin.js')); ?>"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo e(asset('template/js/dataTables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('template/js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
 


    </body>
</html>
<?php /**PATH E:\Sarita Pen drive\ecom\resources\views/admin/mainlayout/master.blade.php ENDPATH**/ ?>