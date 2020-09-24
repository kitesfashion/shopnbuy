@extends('admin.layouts.master')


@section('content')
    <form class="form-horizontal" action="{{ route('slider.update') }}" method="POST" enctype="multipart/form-data" id="editSlider" name="editSlider">
        {{ csrf_field() }}
        <input type="hidden" name="sliderId" value="{{$sliders->id}}">
        <div class="row">
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
            </div>
        </div>

        <div class="form-group row {{ $errors->has('title') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Slider Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="Category name" name="title" value="{{ $sliders->title }}">
                @if ($errors->has('title'))
                @foreach($errors->get('title') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('sliderImage') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Slider Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control form-control-danger" placeholder="Slider image" name="sliderImage">
                <span style="color: red;">/* width : 1024 px, Height: 360 px */</span> <br>
                @if ($errors->has('sliderImage'))
                @foreach($errors->get('sliderImage') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif

                <img src="{{ asset('/').$sliders->image }}" style="height: 85px" alt="You Have No Image">
            </div>
        </div>

        <div class="form-group row {{ $errors->has('link') ? ' has-danger' : '' }}">
            <label for="link" class="col-sm-3 col-form-label">Link</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="url link" name="link" value="{{ $sliders->link }}">
                @if ($errors->has('link'))
                @foreach($errors->get('link') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ $sliders->metaTitle }}">
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
                <input type="text" class="form-control form-control-danger" placeholder="Meta Keyword" name="metaKeyword" value="{{ $sliders->metaKeyword }}">
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
                <textarea style="min-height: 100px;" class="form-control" name="metaDescription">{{ $sliders->metaDescription }}</textarea>
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
                <input type="number"   name="orderBy" value="{{ $sliders->orderBy }}" required>
                @if ($errors->has('orderBy'))
                @foreach($errors->get('orderBy') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('status') ? ' has-danger' : '' }}">
            <label class="col-sm-3 col-form-label">Publication status</label>
            <div class="col-sm-9 row">
                <div class="form-control">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="published" name="status" class="custom-control-input" value="1" required>
                        <label class="custom-control-label" for="published">Published</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="unpublished" name="status" class="custom-control-input" checked="" value="0">
                        <label class="custom-control-label" for="unpublished">Unpublished</label>
                    </div>
                </div>                            
            </div>
        </div>                
    </form>

    <script type="text/javascript">
        document.forms['editSlider'].elements['status'].value = "{{$sliders->status}}";
    </script>

@endsection