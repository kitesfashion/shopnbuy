@extends('admin.layouts.master')

@section('content')
     <form class="form-horizontal" action="{{ route('vendor.update') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
            {{ csrf_field() }}                           
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 m-b-20 text-right">
                    <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
                        <span style="font-size: 16px;">
                            <i class="fa fa-save"></i> Update Data
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <input type="hidden" value="{{$vendors->id}}" name="vendorId">

        <div class="row">
            <div class="col-md-6">
                <label for="sl-no">SL No</label>
                <div class="form-group {{ $errors->has('vendor_serial') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" name="vendor_serial" value="{{ $vendors->vendor_serial }}">
                    @if ($errors->has('vendor_serial'))
                        @foreach($errors->get('vendor_serial') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <label for="vendor-name">Vendor Name</label>
                <div class="form-group {{ $errors->has('vendorName') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="vendor name" name="vendorName" value="{{ $vendors->vendorName }}" required>
                    @if ($errors->has('vendorName'))
                        @foreach($errors->get('vendorName') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="contact-person">Contact Person</label>
                <div class="form-group {{ $errors->has('contactPerson') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="contact person" name="contactPerson" value="{{ $vendors->contactPerson }}">
                    @if ($errors->has('contactPerson'))
                        @foreach($errors->get('contactPerson') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <label for="phone-no">Phone No</label>
                <div class="form-group {{ $errors->has('vendorPhone') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control form-control-danger" placeholder="phone no" name="vendorPhone" value="{{ $vendors->vendorPhone }}" required>
                    @if ($errors->has('vendorPhone'))
                        @foreach($errors->get('vendorPhone') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="email-address">Email Address</label>
                <div class="form-group {{ $errors->has('vendorEmail') ? ' has-danger' : '' }}">
                    <input type="email" class="form-control form-control-danger" placeholder="email address" name="vendorEmail" value="{{ $vendors->vendorEmail }}">
                    @if ($errors->has('vendorEmail'))
                        @foreach($errors->get('vendorEmail') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

           <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <label for="oreder-by">Order By</label>
                        <div class="form-group {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
                            <input type="number" class="form-control form-control-danger" placeholder="order by" name="orderBy" value= "{{ $vendors->orderBy }}" required>
                            @if ($errors->has('orderBy'))
                                @foreach($errors->get('orderBy') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-7">
                        <label for="publication-status">Publication status</label>
                        <div class="form-group {{ $errors->has('vendorStatus') ? ' has-danger' : '' }}" style="height: 40px; line-height: 40px;">
                            <div class="form-check-inline">
                                <label class="form-check-label" for="published">
                                    <input type="radio" id="published" name="vendorStatus" checked="" value="1" required> Published
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label" for="unpublished">
                                    <input type="radio" id="unpublished" name="vendorStatus" value="0"> Unpublished
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
       </div>

       <div class="row">
            <div class="col-md-12">
                <label for="address">Address </label>
                <div class="form-group {{ $errors->has('vendorAddress') ? ' has-danger' : '' }}">
                    <textarea class="form-control form-control-danger" name="vendorAddress" rows="5">{{ $vendors->vendorAddress }}</textarea>
                    @if ($errors->has('vendorAddress'))
                        @foreach($errors->get('vendorAddress') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
           </div>
       </div>                
    </form>

@endsection

@section('custom-js')

<script type="text/javascript">
    document.forms['newMenu'].elements['vendorStatus'].value = "{{$vendors->vendorStatus}}";
</script>

@endsection