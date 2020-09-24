@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data" id="editBanner" name="editBanner">
        {{ csrf_field() }}
        <input type="hidden" name="bannerId" value="{{$banners->id}}">
        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> 
                UPDATE
            </button> 
        </div>
       
        <div class="form-group row {{ $errors->has('title') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="banner title" name="title" value="{{ $banners->title }}" required>
                @if ($errors->has('title'))
                @foreach($errors->get('title') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('bannerImage') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Banner Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control form-control-danger" name="bannerImage">
                <span class="imageSizeInfo">/* Standard Image Size : 200*200 */ <br></span>
                @if ($errors->has('bannerImage'))
                @foreach($errors->get('bannerImage') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif

                <img src="{{ asset('/').$banners->bannerImage }}" style="height: 85px" alt="You Have No Image">
            </div>
        </div>

        <div class="form-group row {{ $errors->has('urlLink') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">URL Link</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="banner url link" name="urlLink" value="{{ $banners->urlLink }}">
                @if ($errors->has('urlLink'))
                @foreach($errors->get('urlLink') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ $banners->metaTitle }}">
                @if ($errors->has('metaTitle'))
                @foreach($errors->get('metaTitle') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta keyword</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="Meta Keyword" name="metaKeyword" value="{{ $banners->metaKeyword }}">
                @if ($errors->has('metaKeyword'))
                @foreach($errors->get('metaKeyword') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('description') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta description</label>
            <div class="col-sm-9">
                <textarea style="min-height: 100px;" class="form-control" name="metaDescription">{{ $banners->metaDescription }}</textarea>
                @if ($errors->has('metaDescription'))
                @foreach($errors->get('metaDescription') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

         <div class="form-group row {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Order By</label>
            <div class="col-sm-9">
                <input type="number"   name="orderBy" value="{{ $banners->orderBy }}" required>
                @if ($errors->has('orderBy'))
                @foreach($errors->get('orderBy') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('bannerStatus') ? ' has-danger' : '' }}">
            <label class="col-sm-3 col-form-label">Publication status</label>
            <div class="col-sm-9 row">
                <div class="form-control">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="published" name="bannerStatus" class="custom-control-input" value="1" required>
                        <label class="custom-control-label" for="published">Published</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="unpublished" name="bannerStatus" class="custom-control-input" checked="" value="0">
                        <label class="custom-control-label" for="unpublished">Unpublished</label>
                    </div>
                </div>                            
            </div>
        </div>   

         <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> 
                UPDATE
            </button> 
        </div>           
    </form>

     <script type="text/javascript">
        document.forms['editBanner'].elements['bannerStatus'].value = "{{$banners->bannerStatus}}";
    </script>
@endsection