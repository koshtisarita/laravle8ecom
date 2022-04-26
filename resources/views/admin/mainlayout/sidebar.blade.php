@php
    $prefix=Route::current()->getName();
    //dd($prefix); 
@endphp  


<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{route('admindashboard')}}" class="{{($prefix=='admindashboard')?'active':''}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#" class=""><i class="fa fa-life-ring  fa-fw"></i>Masters<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>                         
                        <a href="{{route('viewbrand')}}" class="{{($prefix=='viewbrand')?'active':''}}">Brands  </a>
                    </li> 
                    <li>                         
                        <a href="{{route('viewsize')}}" class="{{($prefix=='viewsize')?'active':''}}" >Sizes  </a>
                    </li> 
                    <li>                         
                        <a href="{{route('viewcolor')}}" class="{{($prefix=='viewcolor')?'active':''}}" >Colors  </a>
                    </li> 
                    <li>                         
                        <a href="{{route('viewslider')}}">Slider </a>
                    </li>  
                    <li>                         
                        <a href="{{route('viewpincode')}}">Pincode </a>
                    </li> 
                    <li>                         
                        <a href="{{route('viewcategory')}}">Category</a>
                    </li>
                    <li>                         
                        <a href="{{route('viewsubcategory')}}">Sub-Category</a>
                    </li>   
                    <li>                         
                        <a href="{{route('viewsitesetting')}}">Site Settings </a>
                    </li>  
                    
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#" class=""><i class="fa fa-product-hunt fa-fw"></i>Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>                         
                        <a href="{{route('products.create.step.one')}}" class="{{($prefix=='create.step.one')?'active':''}}">New  </a>
                    </li> 
                    <li>                         
                        <a href="{{route('viewproduct')}}" class="{{($prefix=='viewproduct')?'active':''}}">View  </a>
                    </li>
                </ul>   
            </li>
         
         
        </ul>
    </div>
</div>