@extends('admin.layouts.master')

@section('content')
@php
   use App\Product;
    $product = Product::where('id',$reviews->productId)->first();
@endphp

    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="editCustomer" name="editCustomer">
        {{ csrf_field() }}
        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $reviews->name}}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Product</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $product->name}}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Product Code</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $product->deal_code}}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

         <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Review</label>
            <div class="col-sm-7">
                <textarea style="min-height: 200px;" class="form-control" readonly>{{ $reviews->review }}</textarea>
            </div>
        </div>

        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Rating</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $reviews->star }}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <input type="hidden" name="CustomerId" value="{{$reviews->id}}">               
    </form>

@endsection