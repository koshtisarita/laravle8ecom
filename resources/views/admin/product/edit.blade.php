@extends('admin.mainlayout.master')
@section('title','Admin : Product')

@section('contents')
<style>
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
               <form  name="add_product" id="add_product" method="POST"  action="{{route('products.update')}}" enctype="multipart/form-data">
                @csrf
                    <div class="panel panel-primary">                            
                        <div class="panel-body" >
                          
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                       
                                            <label for="title">Product Title: <span style="color:red">*</span> </label>
                                            <input type="hidden"  value="{{ $product->id ?? '' }}"  class="form-control" id="id"  name="id" />
                                            <input type="text"  value="{{ $product->title ?? '' }}"  class="form-control" id="title"  name="title"  />
                                            @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="title">Product Sub-Title: <span style="color:red">*</span></label>
                                            <input type="text"  value="{{ $product->subtitle ?? '' }}" class="form-control" id="subtitle"  name="subtitle" >
                                            @error('subtitle')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">                                       
                                            <label for="title">Product Slug: <span style="color:red">*</span></label> 
                                            <input type="text" value="{{ $product->slug ?? '' }}"  class="form-control" id="slug"  name="slug" readonly>
                                            
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
                                            <textarea  class="form-control summernote" id="short_description" name="short_description"  >{{{ $product->short_description ?? '' }}}</textarea>
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
                                            <textarea  class="form-control summernote" id="long_description" name="long_description" >{{{ $product->long_description ?? '' }}}</textarea>
                                        </div>
                                        </div>
                                </div>  
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="description">Product Price:</label>   
                                            @error('actual_price')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <input type="number"  value="{{{ $product->actual_price ?? '' }}}" class="form-control" id="actual_price" name="actual_price"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-1 mt-5" >                                             
                                        <label>Pond</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="description">Apply Discount:</label>
                                            <select id="is_discount" name="is_discount" class="form-control" value="{{old('is_discount')}}" >
                                                <option value="0" {{ ($product->is_discount && $product->is_discount =="0" )?"selected": '' }}>No</option>
                                                <option value="1" {{ ($product->is_discount && $product->is_discount =="1" )?"selected": '' }}>Yes</option>
                                            </select>    
                                        </div>
                                    </div>
                                    <div id="apply-discount" >
                                        <div class="col-lg-3">
                                            <div class="form-group">                           
                                                <label for="discount">Discount Value:</label>
                                                <input type="number"  value="{{{ $product->discount ?? '' }}}"  class="form-control" id="discount" name="discount"  />
                                                @error('discount')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="description">Discount in:</label> 
                                                <select id="discount_in" name="discount_in" class="form-control" value="{{old('discount_in')}}"  >
                                                <option value="0" {{ ($product->discount_in && $product->discount_in =="0" )?"selected": '' }}>Percentage</option>
                                                <option value="1"> {{ ($product->discount_in && $product->discount_in =="1" )?"selected": '' }}Bulk</option>
                                            </select>
                                            @error('discount_in')
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
                                            <label class="radio-inline"><input type="radio" name="status" value="1"  {{{ (isset($product->status) && $product->status == '1') ? "checked" : "" }}}> Active</label>
                                            <label class="radio-inline"><input type="radio" name="status" value="0" {{{ (isset($product->status) && $product->status == '0') ? "checked" : "" }}} > DeActive</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">New Arrival</label><br/>
                                            @error('is_newarrival')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        
                                            <label class="radio-inline"><input type="radio" name="is_newarrival" value="1" {{{ (isset($product->is_newarrival) && $product->is_newarrival == '1') ? "checked" : "" }}} > Active</label>
                                            <label class="radio-inline"><input type="radio" name="is_newarrival" value="0" {{{ (isset($product->is_newarrival) && $product->is_newarrival == '0') ? "checked" : "" }}} > DeActive</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">  
                                                <div class="form-group">
                                                    <label for="description">Brands</label>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <select id="brand_id" name="brand_id" class="form-control" >
                                                            <option value="">Select Brand</option>
                                                            @foreach($brands as $brand)                                        
                                                                 
                                                            <option value="{{$brand->id}}" {{{($product->brand_id==$brand->id)?"selected":""}}}>{{strtoupper($brand->brand_name)}}</option>
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
                                                                @if(isset($product->size_id)))
                                                                    @php $selected_size_array = json_decode($product->size_id) ; @endphp     
                                                                    @if(is_array($selected_size_array))
                                                                    
                                                                        @php $size_select = (in_array($size->id,$selected_size_array)) ? "selected" : ""; @endphp
                                                                    @else
                                                                        @php $size_select = "";  @endphp    
                                                                    @endif
                                                                @else  
                                                                    @php $size_select = ""; @endphp  
                                                                @endif    
                                                            <option value="{{$size->id}}" {{$size_select}}>{{ $size->size_no}}/{{strtoupper($size->size_shortcut)}}</option>
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
                                                            <option value="MIDI"  {{{($product->length=="MIDI")?"selected":""}}}>MIDI</option>
                                                            <option value="LONG"  {{{($product->length=="LONG")?"selected":""}}}>Long</option>
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
                                            @enderror
                                            <br/>
                                            <div class="panel panel-primary" style="height: 30rem;overflow-y: auto;">
                                                <div class="panel-body" style="boadar: 1px;">
                                                @foreach($categories as $category)
                                                          @if(isset($product->categories))
                                                                @php $selected_cat = json_decode($product->categories);@endphp
                                                                @if(is_array($selected_cat) && in_array($category->id,$selected_cat))
                                                                    @php $cat_select = "checked"; @endphp
                                                                @else
                                                                    @php $cat_select = ""; @endphp
                                                                @endif
                                                            @else
                                                                @php $cat_select = ""; @endphp
                                                            @endif
                                                        <div class="cbxTree">
                                                                <!--NODE-1-->
                                                                <div class="cbxTree-node">
                                                                    <a href="#" class="cbxTree-swicth"></a>
                                                                    <label class="cbxTree-label">
                                                                        <input type="checkbox" name="categories[]" value="{{$category->id}}" class="cbxTree-cbx"  {{$cat_select}}/>
                                                                        <span class="cbxTree-txt">{{$category->name}}</span>
                                                                    </label>
                                                                    @php $cat_subcategories = $sub_categories->groupBy('category_id'); @endphp
                                                                    @foreach($cat_subcategories[$category->id] as $key=>$sub_cat) 
                                                                            @if(isset($product->sub_categories))
                                                                                @php $selected_cat = json_decode($product->sub_categories);@endphp
                                                                                @if(is_array($selected_cat) && in_array($category->id,$selected_cat))                                                                               
                                                                                    @php $scat_select = "checked"; @endphp
                                                                                @else
                                                                                    @php $scat_select = ""; @endphp
                                                                                @endif
                                                                            @else
                                                                                @php $scat_select = ""; @endphp
                                                                            @endif
                                                                        <!--NODE-11-->
                                                                        <div class="cbxTree-node">
                                                                            <!-- <a href="#" class="cbxTree-swicth"></a> -->
                                                                            <label class="cbxTree-label">
                                                                                <input type="checkbox" name="sub_categories[]" value="{{$sub_cat->id}}" class="cbxTree-cbx" {{$scat_select}} />
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
                                            <textarea row="2" value="{{{ $product->model_detail ?? '' }}}" name="model_detail" id="model_detail" class="form-control" ></textarea>
                                        </div>    
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
                                            <textarea  class="form-control" id="meta_description" name="meta_description">{{{ $product->meta_description ?? '' }}}</textarea>
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
                                    <button type="submit" class="btn btn-primary" >Submit</button>
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
</script>    @endsection 
 
