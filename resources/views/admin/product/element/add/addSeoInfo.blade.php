<form class="form-horizontal" action="{{ route($tab4Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
	{{ csrf_field() }}

    <div class="card">
        <div class="card-body">
            <input type="hidden" name="productId" value="{{ @$productId }}">
            <input type="hidden" name="type" value="add">
            <input type="hidden" name="productAdvance" value="{{@$_GET['productAdvance']}}">
            <div class="row">
                <div class="col-md-12 m-b-20 text-right">    
                    <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button> 
                </div>
            </div>  
            <div class="row">
                <div class="col-md-6">
                    <label for="meta-title">Meta Title</label>
                    <div class="form-group {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger" name="metaTitle" value="{{ old('metaTitle') }}" required>
                        @if ($errors->has('metaTitle'))
                            @foreach($errors->get('metaTitle') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="meta-keyword">Meta Keyword</label>
                    <div class="form-group {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger" name="metaKeyword" value="{{ old('metaKeyword') }}" data-role="tagsinput" required>
                        @if ($errors->has('metaKeyword'))
                            @foreach($errors->get('metaKeyword') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="meta-description">Meta Description</label>
                    <div class="form-group {{ $errors->has('metaDescription') ? ' has-danger' : '' }}">
                        <textarea class="form-control" name="metaDescription" rows="5" required>{{ old('metaDescription') }}</textarea>
                        @if ($errors->has('metaDescription'))
                            @foreach($errors->get('metaDescription') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
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