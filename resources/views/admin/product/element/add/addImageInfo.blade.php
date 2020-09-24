<form class="form-horizontal" action="javascript:void(0)" method="POST" id="image-form" name="image-form" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="card">
        <div class="card-body">
            <input type="hidden" name="productId" value="{{ $productId }}">
            <div class="row">
                <div class="col-md-12 m-b-20 text-right">    
                    <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button> 
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <label for="product-image">Product Image</label>
                    <div class="form-group {{ $errors->has('productImage') ? ' has-danger' : '' }}">
                        <input type="file" class="form-control" id="productImage" aria-describedby="fileHelp" name="productImage" >
                        <span style="color: red;"> 
                            <br> ( Min Width: 800px, Min Height:  800px )
                        </span>

                        @if ($errors->has('productImage'))
                            @foreach($errors->get('productImage') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <p class="uploadImage">
                        </p>
                    </div>
                </div>
            </div>

            @php
                use App\ProductImage;
               $images = ProductImage::where('productId',$productId)->where('section','original')->get();
            @endphp

            <div id="images">
                @foreach ($images as $image)
                    <div class="card card_image_{{ $image->id }}" style="width: 200px; display: inline-block;" align="center">
                        <img class="card-img-top" src="{{ url($image->images) }}" alt="Card image" style="width:150px; height: 150px;">
                        <div class="card-body">
                            <a href="javascript:void(0)" data-id="{{ $image->id }}" data-token="{{ csrf_token() }}" class="btn btn-outline-danger" onclick="removeImage({{ $image->id }})" style="width: 100%;">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 m-b-20 text-right">    
                    <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button> 
                </div>
            </div>              
        </div>
    </div>
</form>