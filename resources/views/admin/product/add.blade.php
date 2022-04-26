@extends('admin.mainlayout.master')
@section('title','Admin : Product')

@section('contents')
<style>
    .dot {
  height: 25px;
  width: 25px; 
  border-radius: 50%;
  display: inline-block;
}
    .cbxTree {
    font: 12px/1.5em Arial, "Helvetica CY", "Nimbus Sans L", sans-serif;
}
.cbxTree>.cbxTree-node {
    padding-left: 0;
}
.cbxTree-node {
    padding-left: 15px;
}
.cbxTree-swicth {
    width: 10px;
    height: 18px;
    font-size: 16px;
    color: #000;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin-right: -13px;
}
.cbxTree-swicth:before {
    content: "+";
}
.cbxTree-swicth.open:before {
    content: "-";
}
.cbxTree-label {
    margin-left: 15px;
}
.cbxTree-swicth~.cbxTree-node {
    display: none;
}
.cbxTree-swicth.open~.cbxTree-node {
    display: block;
}
.header
{
    background-color:#337ab7;
    color:white;
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
</style>  
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
             <div class="col-lg-12"> 
               <form  name="add_product" id="add_product" method="POST"  action="{{route('add.product')}}" enctype="multipart/form-data">
                @csrf
                    <div class="panel panel-primary"> 
                                          
                        <div class="panel-body" >
                                <div class="row">
                                    <div class="col-lg-12 header">
                                        <h4>Basic Information</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                       
                                            <label for="title">Product Title: <span style="color:red">*</span> </label>
                                            <input type="text" value="{{old('title')}}" class="form-control" id="title"  name="title"  >
                                            @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="title">Product Sub-Title: <span style="color:red">*</span></label>
                                            <input type="text" value="{{old('subtitle')}}" class="form-control" id="subtitle"  name="subtitle" >
                                            @error('subtitle')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">                                       
                                            <label for="title">Product Slug: <span style="color:red">*</span></label> 
                                            <input type="text" value="{{old('subtitle')}}" class="form-control" id="slug"  name="slug" >
                                            
                                            <span id="slug-error" class="text-danger"> @error('slug'){{$message}} @enderror</span>
                                            
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12">  
                                        <div class="form-group">
                                            <label for="description">Product Short Description:</label>
                                            @error('short_description')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <textarea  class="form-control summernote" id="short_description" name="short_description"  >{{{ old('short_description') }}}</textarea>
                                        </div>
                                        </div>
                                </div>  
                                <div class="row">
                                    <div class="col-lg-12">  
                                        <div class="form-group">
                                            <label for="description">Product Long Description:</label>
                                            @error('long_description')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <textarea  class="form-control summernote" id="long_description" name="long_description" >{{{ old('long_description') }}}</textarea>
                                        </div>
                                        </div>
                                </div> 
                                
                                <div class="row">
                                    <div class="col-lg-12 header">
                                        <h4>Specification Information</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="description">Product Price:</label>   
                                            @error('actual_price')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <input type="number"  value="{{old('actual_price')}}" class="form-control" id="actual_price" name="actual_price"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-1 mt-5" >                                             
                                        <label>Pond</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="description">Apply Discount:</label>
                                            <select id="is_discount" name="is_discount" class="form-control" value="{{old('is_discount')}}" >
                                                <option value="0" >No</option>
                                                <option value="1" >Yes</option>
                                            </select>    
                                        </div>
                                    </div>
                                    <div id="apply-discount" >
                                        <div class="col-lg-3">
                                            <div class="form-group">                           
                                                <label for="discount">Discounted Value:</label>
                                                <input type="number"  value="{{old('discount')}}" class="form-control" id="discount" name="discount"  />
                                                @error('discount')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        
                                    </div>
                                </div> 
                                                              
                                <div class="row">
                                    <div class="col-lg-6">  
                                        <div class="form-group">
                                            <label for="description">Product Status</label><br/>
                                            @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <label class="radio-inline"><input type="radio" name="status" value="1"  > Active</label>
                                            <label class="radio-inline"><input type="radio" name="status" value="0"  > DeActive</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">New Arrival</label><br/>
                                            @error('is_newarrival')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        
                                            <label class="radio-inline"><input type="radio" name="is_newarrival" value="1"  > Active</label>
                                            <label class="radio-inline"><input type="radio" name="is_newarrival" value="0"  > DeActive</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">  
                                                <div class="form-group">
                                                    <label for="description">Brands</label>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <select id="color_id" name="color_id[]" class="form-control"  >
                                                            <option value="">Select Brand</option>
                                                            @foreach($brands as $brand)                                        
                                                                
                                                            <option value="{{$brand->id}}" ></span> {{ucfirst($brand->brand_name)}}</option>
                                                            @endforeach
                                                            
                                                    </select>
                                                </div>
                                            </div> 
                                           <!-- color  -->
                                            <div class="col-lg-12">  
                                                <div class="form-group">
                                                    <label for="description">Color</label>
                                                    @error('color_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <select id="brand_id" name="brand_id" class="form-control" multiple >
                                                            <option value="">Select Color</option>
                                                            @foreach($colors as $color)                                        
                                                                
                                                            <option value="{{$color->id}}" style="background:{{$color->color_code}}">  <span class="dot" style="background:{{$color->color_code}}"></span>  {{ucfirst($color->name)}}</option>
                                                            @endforeach
                                                            
                                                    </select>
                                                </div>
                                            </div> 
                                        <div class="col-lg-12">  
                                                <div class="form-group">
                                                    <label for="description">Sizes</label>
                                                    @error('size_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <select id="size_id" name="size_id[]" class="form-control" multiple  >
                                                            <option value="">Select Size</option>
                                                            @foreach($sizes as $size)                                                            
                                                            <option value="{{$size->id}}" >{{ $size->size_no}}/{{strtoupper($size->size_shortcut)}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                        </div> 
                                        <div class="col-lg-12">  
                                                <div class="form-group">
                                                    <label for="description">Length</label>  
                                                    @error('length')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                
                                                    <select id="length" name="length" class="form-control" >
                                                            <option value="">Select Length</option>
                                                            <option value="MIDI" >MIDI</option>
                                                            <option value="LONG" >Long</option>
                                                    </select>
                                                </div>
                                        </div> 
                                    </div>  
                                    </div>
                                    <div class="col-lg-6">  
                                        <div class="form-group">
                                            <label for="description">Product Categories</label>
                                            <span style="float:rigth"><input type="checkbox" name="all_category" id="all_category" /> All</span>
                                            @error('categories')
                                            <span class="text-danger">{{$message}}</span><br>
                                            @enderror
                                            @error('sub_categories')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror$product
                                            <br/>
                                            <div class="panel panel-primary" style="height: 30rem;overflow-y: auto;">
                                                <div class="panel-body" style="boadar: 1px;">
                                                @foreach($categories as $category)
                                                    
                                                        <div class="cbxTree">
                                                                <!--NODE-1-->
                                                                <div class="cbxTree-node">
                                                                    <a href="#" class="cbxTree-swicth"></a>
                                                                    <label class="cbxTree-label">
                                                                        <input type="checkbox" name="categories[]" value="{{$category->id}}" class="cbxTree-cbx" />
                                                                        <span class="cbxTree-txt">{{$category->name}}</span>
                                                                    </label>
                                                                    @php $cat_subcategories = $sub_categories->groupBy('category_id'); @endphp
                                                                    @foreach($cat_subcategories[$category->id] as $key=>$sub_cat) 
                                                                        
                                                                        <!--NODE-11-->
                                                                        <div class="cbxTree-node">
                                                                            <!-- <a href="#" class="cbxTree-swicth"></a> -->
                                                                            <label class="cbxTree-label">
                                                                                <input type="checkbox" name="sub_categories[]" value="{{$sub_cat->id}}" class="cbxTree-cbx" />
                                                                                <span class="cbxTree-txt">{{$sub_cat->name}}</span>
                                                                            </label>
                                                                        
                                                                        </div>
                                                                    
                                                                    @endforeach    
                                                                </div>
                                                            
                                                        </div>
                                                @endforeach     
                                                    </div>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="model_description">Modal Detail</label><br/>
                                            <textarea row="2" name="model_detail" id="model_detail" class="form-control" ></textarea>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 header">
                                        <h4>Meta Data Information</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">                                       
                                            <label for="title">Meta Title:</label>
                                            <input type="text" value="{{ $product->meta_title ?? '' }}" class="form-control" id="meta_title"  name="meta_title">
                                            @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="title">Meta Key Word: </label>
                                            <input type="text" value="{{ $product->meta_keywords ?? '' }}" class="form-control" id="meta_keywords"  name="meta_keywords">
                                            @error('subtitle')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                        
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12">  
                                        <div class="form-group">
                                            <label for="description">Meta Description:</label>
                                            @error('meta_description')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <textarea  class="form-control" id="meta_description" name="meta_description">{{{ $product->short_description ?? '' }}}</textarea>
                                        </div>
                                        </div>
                                </div>  
                                <div class="row">
                                    <div class="col-lg-12 header">
                                        <h4>Default Image</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">                                       
                                            <label for="title">Select Image:</label>
                                            <input type="file"  class="form-control" id="image"  name="image">
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                               
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" >Submit</button>
                                </div>
                                </div>
                            
                                </div>
                           
                        </div>

                        
                    </div>
                </form>
             </div>
        </div>
        <!-- /.row -->
      
    </div>
</div>
<!-- jQuery -->
<script src="{{asset('template/js/jquery.js')}}"></script>
<script>
    $(document).on({
    click: function(){
        $('body').toggleClass('fcd-ie8'); //For the stupid ie8
        $(this).toggleClass('open');
        return false;
    }
}, ".cbxTree-swicth");
$(document).on({
    change: function(){
        var $node = $(this).closest('.cbxTree-node');
        if($(this).is(':checked')){
            $node.children('.cbxTree-swicth').addClass('open');
        }
        $node.find('.cbxTree-cbx').prop({checked : $(this).is(':checked')});
    }
}, ".cbxTree-cbx");
</script>   
<script>
    var onload_discount= "@php if(isset($product->is_discount) && $product->is_discount != null){ echo $product->is_discount; }else{echo 0;} @endphp";
   
    if(onload_discount ==  "1"){ $("#apply-discount").show();}
    else{
        $("#apply-discount").hide();
        $("#discount").val("");
        $("#discount_in").val("");
    }

    $("#is_discount").on("change",function(){
        var val = $(this).val();        
        if(val == "1")
        {
            $("#apply-discount").show();
        }           
        else
        {
            $("#discount").val("");
            $("#discount_in").val("");
            $("#apply-discount").hide();
        }
           
    });
</script> 
<script>
   $("#slug").on('change', function(e) {
            focus++;
            newslug = $(this).val();
            $.ajax({
                url: '/products/slug/validate',
                type: 'GET',
                data: 'slug=' + newslug,

                success: function(data, textStatus, jqXHR) {
                    $('#slug-error').text('');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#slug-error').text(jqXHR.responseJSON.error);
                },
            });
        });
</script>

@endsection 
 
