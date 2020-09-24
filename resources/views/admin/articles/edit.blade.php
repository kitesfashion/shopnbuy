@extends('admin.layouts.master')

@section('content')
@php
    use App\Article;
    use App\Menu;

    $exsitMenu = Menu::where('id',$articles->menuId)->first();
@endphp
<form class="form-horizontal" action="{{ route('articles.edit',$articles->id) }}" method="POST" enctype="multipart/form-data" name="form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('parentMenu') ? ' has-danger' : '' }}">
                <label for="parentMenu">Parent Menu</label>
                <select class="form-control chosen-select" name="parentMenu">
                    <option value=" ">Select Parent Menu</option>
                    <?php
                        foreach ($menus as $menu) {
                            if(@$exsitMenu->parent == $menu->id){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                    ?>
                        <option {{@$selected}} value="{{$menu->id}}">{{$menu->menuName}}</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('menuName') ? ' has-danger' : '' }}">
                <label for="menuName">Menu Name</label>
                <input type="text" class="form-control form-control-danger" placeholder="menu name" name="menuName" value="{{ @$exsitMenu->menuName }}">
                @if ($errors->has('menuName'))
                    @foreach($errors->get('menuName') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('parentArticle') ? ' has-danger' : '' }}">
                <label for="parentArticle">Article Parent</label>
                <select class="form-control chosen-select" name="parentArticle">
                        <option value=" ">Select Article Parent</option>
                    @php
                       foreach ($articleList as $parentArticle) {
                        if($parentArticle->id == $articles->parentArticle){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                    @endphp
                        <option {{@$selected}} value="{{$parentArticle->id}}">{{$parentArticle->articleName}}
                        </option>
                    @php } @endphp
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('articleName') ? ' has-danger' : '' }}">
                <label for="articleName">Article Name</label>
                <input type="text" class="form-control form-control-danger" placeholder="article name" name="articleName" value="{{ $articles->articleName }}">
                @if ($errors->has('articleName'))
                    @foreach($errors->get('articleName') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('firstHomeTitle') ? ' has-danger' : '' }}">
                <label for="firstHomeTitle">Title 1</label>
                <input type="text" class="form-control form-control-danger" placeholder="title 1" name="firstHomeTitle" value="{{ $articles->firstHomeTitle }}">
                @if ($errors->has('firstHomeTitle'))
                    @foreach($errors->get('firstHomeTitle') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('secondHomeTitle') ? ' has-danger' : '' }}">
                <label for="secondHomeTitle">Title 2</label>
                <input type="text" class="form-control form-control-danger" placeholder="title 2" name="secondHomeTitle" value="{{ old('secondHomeTitle') }}">
                @if ($errors->has('secondHomeTitle'))
                    @foreach($errors->get('secondHomeTitle') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div> --}}
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('firstInnerTitle') ? ' has-danger' : '' }}">
                <label for="firstInnerTitle">Tittle 1</label>
                <input type="text" class="form-control form-control-danger" placeholder="Tittle 1" name="firstInnerTitle" value="{{ $articles->firstInnerTitle }}">
                @if ($errors->has('firstInnerTitle'))
                    @foreach($errors->get('firstInnerTitle') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('secondInnerTitle') ? ' has-danger' : '' }}">
                <label for="secondInnerTitle">Tittle 2</label>
                <input type="text" class="form-control form-control-danger" placeholder="Tittle 2" name="secondInnerTitle" value="{{ $articles->secondInnerTitle }}">
                @if ($errors->has('secondInnerTitle'))
                    @foreach($errors->get('secondInnerTitle') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('firstHomeImage') ? ' has-danger' : '' }}">
                <label for="firstHomeImage">Home Image</label>
                <input type="file" class="form-control form-control-danger" name="firstHomeImage">
                  <span class="imageSizeInfo">/* Standard Image Size : 200*200 */ <br></span>

                <?php if (file_exists(@$articles->firstHomeImage)) { ?> 
                    <img src="{{asset('/').@$articles->firstHomeImage}}" style="height: 90px;">
                <?php }else{ ?>
                    <img src="{{$noImage}}" style="height: 94px;">
                <?php } ?>
                @if ($errors->has('firstHomeImage'))
                    @foreach($errors->get('firstHomeImage') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('firstInnerImage') ? ' has-danger' : '' }}">
                <label for="firstInnerImage">Inner Image</label>
                <input type="file" class="form-control form-control-danger" name="firstInnerImage">
                 <span class="imageSizeInfo">/* Standard Image Size : 200*200 */ <br></span>

                <?php if (file_exists(@$articles->firstInnerImage)) { ?> 
                    <img src="{{asset('/').@$articles->firstInnerImage}}" style="height: 90px;">
                <?php }else{ ?>
                    <img src="{{$noImage}}" style="height: 94px;">
                <?php } ?>
                @if ($errors->has('firstInnerImage'))
                    @foreach($errors->get('firstInnerImage') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('homeDescription') ? ' has-danger' : '' }}">
                <label for="homeDescription">Home Description</label>
                <textarea class="form-control tinymce" name="homeDescription" style="min-height: 250px">{{ $articles->homeDescription }}</textarea>
                @if ($errors->has('homeDescription'))
                    @foreach($errors->get('homeDescription') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('innerDescription') ? ' has-danger' : '' }}">
                <label for="innerDescription" class="col-sm-3 col-form-label">Inner Description</label>
                <textarea class="form-control tinymce" name="innerDescription" style="min-height: 250px">{{ $articles->innerDescription }}</textarea>
                @if ($errors->has('innerDescription'))
                    @foreach($errors->get('innerDescription') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('urlLink') ? ' has-danger' : '' }}">
                <label for="urlLink">Url Link</label>
                <input type="text" class="form-control form-control-danger" placeholder="any url link" name="urlLink" value="{{ $articles->urlLink }}">
                @if ($errors->has('urlLink'))
                    @foreach($errors->get('urlLink') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('articleIcon') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger">Icon</label>
                 <input type="text" class="form-control form-control-danger" placeholder='<i class="fa fa-icon"></i>' name="articleIcon" value="{{ $articles->articleIcon }}">
                @if ($errors->has('articleIcon'))
                    @foreach($errors->get('articleIcon') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
                        <label for="meta-title">Meta Title</label>
                        <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ $articles->metaTitle }}">
                        @if ($errors->has('metaTitle'))
                            @foreach($errors->get('metaTitle') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                     <div class="form-group {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
                        <label for="meta-keyword">Meta keyword</label>
                        <input type="text" class="form-control form-control-danger" name="metaKeyword" value="{{ $articles->metaKeyword }}" data-role="tagsinput">
                        @if ($errors->has('metaKeyword'))
                            @foreach($errors->get('metaKeyword') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                <label for="meta-description">Meta description</label>
                <textarea style="min-height: 182px;" class="form-control" name="metaDescription">{{ $articles->metaDescription }}</textarea>
                @if ($errors->has('metaDescription'))
                    @foreach($errors->get('metaDescription') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
                <label for="orderBy">Order By</label>
                <input type="number"  name="orderBy" class="form-control" value="{{ @$articles->orderBy }}" required>
                @if ($errors->has('orderBy'))
                    @foreach($errors->get('orderBy') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-md-6">
           <div class="form-group row {{ $errors->has('articleStatus') ? ' has-danger' : '' }}">
                <label class="col-sm-3 col-form-label">Publication status</label>
                <div class="col-sm-9 row">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="published" name="articleStatus" class="custom-control-input" checked="" value="1" required>
                            <label class="custom-control-label" for="published">Published</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="unpublished" name="articleStatus" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="unpublished">Unpublished</label>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-b-20 text-right">    
        <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
    </div>               
</form>
                       
<script type="text/javascript">
    document.forms['form'].elements['articleStatus'].value = "{{$articles->articleStatus}}";
</script>
@endsection



