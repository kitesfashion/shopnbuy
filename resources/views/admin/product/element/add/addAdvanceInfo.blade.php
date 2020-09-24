<form class="form-horizontal" action="{{ route($tab2Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
	{{ csrf_field() }}

    <div class="card">
        <div class="card-body">
            <input type="hidden" name="productId" value="{{ $productId }}">
            <input type="hidden" name="type" value="add">
            <div class="row">
                <div class="col-md-12 m-b-20 text-right">    
                    <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button> 
                </div>
            </div>  
            <div class="row">
            	<div class="col-md-6">
            		<label for="product-section">Product Section</label>
            		<select class="form-control chosen-select" name="sections[]" data-placeholder="Select Product Section" multiple>
            			@foreach ($productSections as $key => $value)
            				<option value="{{ $key }}">{{ $value }}</option>
            			@endforeach
            		</select>
            	</div>

                <div class="col-md-6">
                    <label for="related-product">Related Product</label>
                    <div class="form-group">
                        <select name="related_product[]" data-placeholder="Select Related Products" class="form-control chosen-select" multiple>
                            @foreach($relatedProducts as $products)
                                <option value="{{ $products->id }}">{{ $products->name }}({{ $products->deal_code }})</option>
                            @endforeach
                        </select>

                        @if ($errors->has('related_product'))
                            @foreach($errors->get('related_product') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                	<label for="pre-order">Preorder</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-danger" placeholder="Preorder Duration" name="pre_orderDuration">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="free-shippimg">Shipping</label>
                    <div class="form-group" style="height: 40px; line-height: 40px;">
                        <div class="form-check-inline">
                            <label class="form-check-label" for="free_shipping">
                                <input class="form-check-input" type="checkbox" name="free_shipping" id="free_shipping" value="free">Free Shipping
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hot Deal Section -->
            <div class="row" style="height: 45px;">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check-inline">
                                <label class="form-check-label" for="hotInput">
                                    <input class="form-check-input" type="checkbox" name="hotDeal" value="{{ old('hotDeal') }}" id="hotInput">
                                    Hot Deal
                                </label>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <span style="display: none;" id="hotDeal" class="hotDeal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-danger" placeholder="Discount For Hot Deal" name="hotDiscount" value="{{ old('hotDiscount') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-danger datepicker" placeholder="Date" name="hotDate" value="{{ old('hotDate') }}" readonly="">
                                        </div>
                                    </div>                                                
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check-inline">
                                <label class="form-check-label" for="specialInput">
                                    <input class="form-check-input" type="checkbox" id="specialInput" name="specialDeal" value="{{ old('specialDeal') }}">
                                    Special Deal
                                </label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <span style="display: none;" id="specialDeal" class="specialDeal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-danger" placeholder="Discount For Special Deal" name="specialDiscount" value="{{ old('specialDiscount') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-danger datepicker" placeholder="Date" name="specialDate" value="{{ old('specialDate') }}" readonly="">
                                        </div>
                                    </div>
                                </span>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <style type="text/css">
                            .chosen-single{
                                padding: 5px 16px !important;
                                height: 37px !important;
                            }
                        </style>

                        <span class="customerGroupRow">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Customer Group Name</label>
                                </div>
                                <div class="col-md-6">
                                    <label>Price</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <select name="customerGroupId[]" data-placeholder="Select Group" class="form-control chosen-select customerGroup">
                                        <option value="">Select Any Group</option>
                                        @foreach($customer_groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->groupName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="customerGroupPrice[]" class="form-control" placeholder="price for customer group" value="">
                                </div>
                            </div>
                        </span>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="group_count" value="1"> 
                                <p align="right"> <span class="btn btn-success add_customer_group"><i class="fa fa-plus"></i> Add Group</span></p>
                            </div>
                        </div>
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

<div id="customer_group" style="display:none">
        <div class="input select">
            <select>
                <option value="">Select Client Group</option>
                @foreach($customer_groups as $group)
                    <option value="{{ $group->id }}">{{ $group->groupName }}</option>
                @endforeach
            </select>
        </div>
    </div>