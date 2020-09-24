@extends('admin.layouts.master')

@section('content')
<?php
    use App\UserMenu;
    $userMenus = UserMenu::orderBy('id','DESC')->first();
    $orderBy = $userMenus->orderBy+1;
?>

    <form class="form-horizontal" action="{{ url('/admin/user-menu/save') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
        {{ csrf_field() }}
        <div class="row">                                
            <div class="col-md-12 m-b-20 text-right">    
               <button type="submit" class="btn btn-outline-info waves-effect">Save</button> 
           </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="parent">Parent</label>
                <div class="form-group {{ $errors->has('parent') ? ' has-danger' : '' }}">
                    <select class="form-control chosen-select" name="parentMenu">
                        <option value=" ">Select Parent</option>
                        @foreach ($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->menuName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="menu-name">Menu Name</label>
                <div class="form-group {{ $errors->has('menuName') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="Menu name" name="menuName" value="{{ old('menuName') }}" required>
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
                <label for="menu-link">Menu Link</label>
                <div class="form-group {{ $errors->has('menuLink') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="Menu link" name="menuLink" value="{{ old('menuLink') }}" required>
                    @if ($errors->has('menuLink'))
                        @foreach($errors->get('menuLink') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <label for="menu-icon">Menu Icon</label>
                <div class="form-group {{ $errors->has('menuIcon') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="fa fa-icon" name="menuIcon" value="{{ old('menuIcon') }}">
                    @if ($errors->has('menuIcon'))
                        @foreach($errors->get('menuIcon') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="order-by">Order By</label>
                <div class="form-group {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
                    <input type="number" class="form-control form-control-danger" placeholder="order by" name="orderBy" value="{{ $orderBy }}" required>
                    @if ($errors->has('orderBy'))
                        @foreach($errors->get('orderBy') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <label for="publication-status">Publication Status</label>
                <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}" style="height: 40px; line-height: 40px;">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" id="published" name="menuStatus" class="form-check-input" checked="" value="1" required>Published
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" id="unpublished" name="menuStatus" class="form-check-input" value="0">Unpublished
                        </label>
                    </div>
                        {{-- <div class="custom-control custom-radio">
                            <input type="radio" id="published" name="menuStatus" class="custom-control-input" checked="" value="1" required>
                            <label class="custom-control-label" for="published">Published</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="unpublished" name="menuStatus" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="unpublished">Unpublished</label>
                        </div> --}}                           
                </div>
            </div>
        </div>

        <div class="row">                                
            <div class="col-md-12 m-b-20 text-right">    
               <button type="submit" class="btn btn-outline-info waves-effect">Save</button> 
           </div>
        </div>
    </form>


@endsection