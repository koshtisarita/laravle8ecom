<form  name="add_product" id="add_product" method="POST"  action="{{route('add.product')}}">
@csrf
<div class="panel panel-primary">                            
     <div class="panel-body" >
        
        @if($currentstep == 1)
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">                                       
                        <label for="title">Product Title: <span style="color:red">*</span> </label>
                        <input type="text" value="{{old('title')}}" class="form-control" id="title"  name="title" wire:model.defer="title">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="title">Product Sub-Title: <span style="color:red">*</span></label>
                        <input type="text" value="{{old('subtitle')}}" class="form-control" id="subtitle"  name="subtitle" wire:model.defer="subtitle">
                        @error('subtitle')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">                                       
                        <label for="title">Product Slug: <span style="color:red">*</span></label> 
                        <input type="text" value="{{old('subtitle')}}" class="form-control" id="slug"  name="slug" wire:model.defer="slug">
                        
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
                        <textarea  class="form-control summernote" id="short_description" name="short_description" wire:model.defer="short_description">{{{ old('short_description') }}}</textarea>
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
                        <textarea  class="form-control summernote" id="long_description" name="long_description" wire:model.defer="long_description">{{{ old('long_description') }}}</textarea>
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
                        <input type="number"  value="{{old('actual_price')}}" class="form-control" id="actual_price" name="actual_price" wire:model.defer="actual_price"/>
                    </div>
                </div>
                <div class="col-lg-1 mt-5" >                                             
                    <label>Pond</label>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="description">Apply Discount:</label>
                        <select id="is_discount" name="is_discount" class="form-control" value="{{old('is_discount')}}" wire:model.defer="is_discount">
                            <option value="0" >No</option>
                            <option value="1" >Yes</option>
                        </select>    
                    </div>
                </div>
                <div id="apply-discount" >
                    <div class="col-lg-3">
                        <div class="form-group">                           
                            <label for="discount">Discount Value:</label>
                            <input type="number"  value="{{old('discount')}}" class="form-control" id="discount" name="discount" wire:model.defer="discount" />
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="description">Discount in:</label> 
                            <select id="discount_in" name="discount_in" class="form-control" value="{{old('discount_in')}}" wire:model.defer="discount" >
                            <option value="0">Percentage</option>
                            <option value="1">Bulk</option>
                        </select>
                        @error('discount_in')
                        <span class="text-danger">{{$message}}</span>
                        @enderror    
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row  text-center">
                <button type="button" class="btn btn-primary"  wire:click="first_step()">Next</button>
            </div>   
        @endif
      
        @if($currentstep == 2)
            <div class="row">
                <div class="col-lg-6">  
                    <div class="form-group">
                        <label for="description">Product Status</label><br/>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label class="radio-inline"><input type="radio" name="status" value="1" wire:model.defer="status" > Active</label>
                        <label class="radio-inline"><input type="radio" name="status" value="0" wire:model.defer="status" > DeActive</label>
                    </div>
                    <div class="form-group">
                        <label for="description">New Arrival</label><br/>
                        @error('is_newarrival')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    
                        <label class="radio-inline"><input type="radio" name="is_newarrival" value="1" wire:model.defer="is_newarrival" > Active</label>
                        <label class="radio-inline"><input type="radio" name="is_newarrival" value="0" wire:model.defer="is_newarrival" > DeActive</label>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">  
                            <div class="form-group">
                                <label for="description">Brands</label>
                                @error('brand_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <select id="brand_id" name="brand_id" class="form-control" wire:model.defer="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)                                        
                                            
                                        <option value="{{$brand->id}}" >{{strtoupper($brand->brand_name)}}</option>
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
                                <select id="size_id" name="size_id[]" class="form-control" multiple wire:model.defer="size_id[]">
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
                               
                                <select id="length" name="length" class="form-control" wire:model.defer="length">
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
                        @enderror
                        <br/>
                        <div class="panel panel-primary" style="height: 30rem;overflow-y: auto;">
                            <div class="panel-body" style="boadar: 1px;">
                            @foreach($categories as $category)
                                   
                                    <div class="cbxTree">
                                            <!--NODE-1-->
                                            <div class="cbxTree-node">
                                                <a href="#" class="cbxTree-swicth"></a>
                                                <label class="cbxTree-label">
                                                    <input type="checkbox" name="categories[]" value="{{$category->id}}" class="cbxTree-cbx" wire:model.defer="categories_id[]"/>
                                                    <span class="cbxTree-txt">{{$category->name}}</span>
                                                </label>
                                                @php $cat_subcategories = $sub_categories->groupBy('category_id'); @endphp
                                                @foreach($cat_subcategories[$category->id] as $key=>$sub_cat) 
                                                    
                                                    <!--NODE-11-->
                                                    <div class="cbxTree-node">
                                                        <!-- <a href="#" class="cbxTree-swicth"></a> -->
                                                        <label class="cbxTree-label">
                                                            <input type="checkbox" name="sub_categories[]" value="{{$sub_cat->id}}" class="cbxTree-cbx" wire:model.defer="sub_categories_id"/>
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
                        <textarea row="2" name="model_detail" id="model_detail" class="form-control" wire:model.defer="model_detail"></textarea>
                    </div>    
                </div>
            </div>
            <div class="row">
            <div class="col-lg-6  text-center">
                <button type="button" class="btn btn-primary" wire:click="previous()">Previous</button>
            </div>
            <div class="col-lg-6 ">
                <button type="button" class="btn btn-primary" wire:click="second_step()">Next</button>
            </div>
            </div>
        @endif
        <!-- End of second step -->
        <!-- start of third step  (metadata information)     -->
        @if($currentstep == 3)
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
                <div class="col-lg-12">  
                    <b>Images</b><hr>
                    </div>
            </div>  
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="description">Product Images:<span style="color:red">*</span></label>   
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="file"  class="form-control" id="images" name="image"/>
                    </div>
                </div>                                 
            </div> 
            <div class="row">
            <div class="col-lg-6  text-center">
                <button type="button" class="btn btn-primary" wire:click="previous()">Previous</button>
            </div>
            <div class="col-lg-6  text-center">
                <button type="submit" class="btn btn-primary" wire:click="third_step()">Next</button>
            </div>
            </div>
        @endif
        <!-- End of third step -->
     </div>

    
</div>
</form>
