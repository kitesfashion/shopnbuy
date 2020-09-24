@extends('admin.layouts.master')

@section('content')

<?php
    $actionStatus = array('1' => 'Add', '2' => 'Edit', '3' => 'Publication Status', '4' => 'Delete', '5' => 'Permission',
        '6' => 'Changepassword', '7' => 'View PopUp', '8' => 'View','9'=>'Shipping Status','10'=>'Product List','11'=>'View PDF');
?>
    <form class="form-horizontal" action="{{ route('userMenu.ActionLinkUpdate',$parentMenuId) }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12 m-b-20 text-right">
                <button type="submit" class="btn btn-outline-info waves-effect">Save</button>
            </div>
        </div>

        <input type="hidden" name="actionId" value="{{$menuItem->id}}">

        <div class="row">
            <div class="col-md-6">
                <label for="menu-type">Menu Type</label>
                <div class="form-group {{ $errors->has('menuType') ? ' has-danger' : '' }}">
                    <select class="form-control chosen-select" name="menuType">
                        @foreach ($actionStatus as $key => $value)
                            @php
                                if($menuItem->menuType == $key)
                                {
                                    $selected = "selected";
                                }
                                else
                                {
                                    $selected = "";
                                }                                                            
                            @endphp
                            <option {{$selected}} value="{{$key}}">{{$value}}</option>
                        @endforeach
                        <option value=" ">Select Menu Type</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="name">Name</label>
                <div class="form-group {{ $errors->has('actionName') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="Add" name="actionName" value="{{ $menuItem->actionName }}" required>
                    @if ($errors->has('actionName'))
                        @foreach($errors->get('actionName') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="link">Link</label>
                <div class="form-group {{ $errors->has('actionLink') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="menu.add" name="actionLink" value="{{ $menuItem->actionLink }}" required>
                    @if ($errors->has('actionLink'))
                        @foreach($errors->get('actionLink') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <label for="order-by">Order By</label>
                    <div class="form-group {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
                        <input type="number" class="form-control form-control-danger" placeholder="order by" name="orderBy" value="{{ $menuItem->orderBy }}" required>
                        @if ($errors->has('orderBy'))
                            @foreach($errors->get('orderBy') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <label for="publication-status">Publication Status</label>
                <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}" style="height: 40px; line-height: 40px;">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" id="published" name="actionStatus" class="form-check-input" checked="" value="1" required>Published
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" id="unpublished" name="actionStatus" class="form-check-input" value="0">Unpublished
                        </label>
                    </div>                           
                </div>
            </div>
        </div>
    </form>
<script type="text/javascript">
    document.forms['newMenu'].elements['actionStatus'].value = "{{$menuItem->actionStatus}}";
</script>
@endsection