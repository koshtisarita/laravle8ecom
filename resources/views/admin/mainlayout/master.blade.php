
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('template/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('template/css/metisMenu.min.css')}}" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="{{asset('template/css/timeline.css')}}" rel="stylesheet">

         <!-- DataTables CSS -->
         <link href="{{asset('template/css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('template/css/startmin.css')}}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{asset('template/css/morris.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('template/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        
          <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('template/js/summernote/summernote-bs4.css') }}">  
        
         <!-- Livewire style  -->
		 @livewireStyles

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .active{
                color:rgb(88, 3, 67) !important;
            }
        </style>
    </head>
    <body>

        <div id="wrapper">

                @include('admin.mainlayout.topnav')

                 @yield('contents')

        </div>

        @include('sweetalert::alert') 

        <!---footer----->

        <!-- jQuery -->
        <!-- <script src="{{asset('template/js/jquery.js')}}"></script> -->
        <script src="{{asset('template/js/jquery.min.js')}}"></script>
        

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('template/js/bootstrap.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('template/js/metisMenu.min.js')}}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{asset('template/js/raphael.min.js')}}"></script>
        <!-- <script src="{{asset('template/js/morris.min.js')}}"></script>
        <script src="{{asset('template/js/morris-data.js')}}"></script> -->

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('template/js/startmin.js')}}"></script>

        <!-- DataTables JavaScript -->
        <script src="{{asset('template/js/dataTables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('template/js/dataTables/dataTables.bootstrap.min.js')}}"></script>

        <!-- Sweet Alter2  ---->
        <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>

        <!-- Livewire script  -->
        @livewireScripts
      
      <!-- Summernote -->
      <script src="{{ asset('template/js/summernote/summernote-bs4.min.js') }}"></script>
      <script type="text/javascript">
        $(document).ready(function() {
        $('.summernote').summernote();
        });
    </script>
    </body>
</html>
