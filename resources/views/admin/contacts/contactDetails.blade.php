@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="editCustomer" name="editCustomer">
        {{ csrf_field() }}
        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $contacts->contactName}}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Phone No</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $contacts->contactPhone }}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Email Address</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $contacts->contactEmail }}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Subject</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger"  name="name" value="{{ $contacts->contactTitle }}" readonly>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

         <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Message</label>
            <div class="col-sm-9">
                <textarea style="min-height: 200px;" class="form-control" readonly>{{ $contacts->contactMessage }}</textarea>
            </div>
        </div>

        <input type="hidden" name="CustomerId" value="{{$contacts->id}}">              
    </form>

@endsection