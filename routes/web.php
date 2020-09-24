<?php

//admin panel start here

Auth::routes();

Route::prefix('admin')->group(function()
{
	Route::middleware('auth:admin')->group(function(){
	Route::group(['middleware'=>'menuPermission'],function(){
		Route::get('/','Admin\AdminHomeController@index')->name('admin.index');

		/*Dashboard Link*/
		Route::get('/running-product', 'Admin\ProductController@runningProduct')->name('product.running');
		Route::get('/monthly-sales/{id}', 'Admin\OrderController@MonthlySales');

		//route for pending, complete, processing, shipping orders
		Route::get('/new-order','Admin\OrderController@NeworderList')->name('order.new');
		Route::get('/processing-order', 'Admin\OrderController@ProcessingOrder')->name('order.processing');
		Route::get('/shipping-order', 'Admin\OrderController@ShippingOrder')->name('order.shipping');
		Route::get('/complete-orderlist', 'Admin\OrderController@CompleteOrderList')->name('orderlist.complete');
		Route::get('/order/status/{id}', 'Admin\OrderController@status')->name('order.status');
		Route::post('/order-delete', 'Admin\OrderController@DeleteOrder')->name('order.delete');

		//route for order list of each order
		Route::get('/list-product/{id}', 'Admin\OrderController@ListProduct')->name('list.product');
		Route::get('/ordersQuantity/{rowId}/update/{quantity}', 'Admin\OrderController@updateQuantity')->name('orders.updateQuantity');
		Route::get('/ordersPrice/{rowId}/update/{price}', 'Admin\OrderController@updatePrice')->name('orders.updatePrice');
		
		//View Invoice Section
		Route::get('/invoices/{id}', 'Admin\OrderController@invoices')->name('view.invoices');
		Route::get('/download-invoices/{checkoutId}', 'Admin\OrderController@downloadInvoices')->name('download.invoices');
		Route::get('/view-pdf/{checkoutId}', 'Admin\OrderController@viewPdf')->name('view.pdf');

		Route::get('/add-to-invoice/{orderId}', 'Admin\InvoiceController@addtoInvoice');
		Route::get('/remove-from-invoice/{orderId}', 'Admin\InvoiceController@deletefromInvoice');
		Route::get('/view-invoice/{invoiceId}', 'Admin\InvoiceController@viewInvoice');
		Route::get('/view-invoice-pdf/{invoiceId}', 'Admin\InvoiceController@manualInvoicePdf')->name('manualInvoice.pdf');
		
		//Start Category Section
		Route::resource('categories', 'Admin\CategoryController');
		Route::get('/category-add', 'Admin\CategoryController@addcategory')->name('categoryadd.page');

		Route::post('/category-save', 'Admin\CategoryController@savecategory')->name('category.save');

		Route::get('/categories/status/{id}', 'Admin\CategoryController@changecategoryStatus')->name('categories.changecategoryStatus');

		Route::get('/category-edit/{id}', 'Admin\CategoryController@editCategory')->name('category.edit');

		Route::post('/category-update', 'Admin\CategoryController@updateCategory')->name('category.update');

		Route::match(['GET', 'POST'], '/category-delete/{id}', 'Admin\CategoryController@delete')->name('category.delete');

		//End Category Section

		//Start Shipping charge configuration

		Route::resource('shippingCharges', 'Admin\ShippingChargeController');
		Route::get('/shipping-charge-add', 'Admin\ShippingChargeController@addcharge')->name('chargeadd.page');
		Route::post('/shipping-charge-save', 'Admin\ShippingChargeController@savecharge')->name('shippingCharge.save');

		Route::get('/shipping-charge/status/{id}', 'Admin\ShippingChargeController@shippingChargeStatus')->name('shippingCharge.shippingChargeStatus');

		Route::get('/shipping-charge-edit/{id}', 'Admin\ShippingChargeController@editCharge')->name('shippingCharge.edit');

		Route::post('/shipping-charge-update', 'Admin\ShippingChargeController@updateCharge')->name('shippingCharge.update');

		Route::get('/shipping-charge-delete/{id}', 'Admin\ShippingChargeController@deleteCharge')->name('shippingCharge.delete');
		Route::post('/shipping-charge-delete', 'Admin\ShippingChargeController@destroy')->name('shippingCharges.deletes');

		Route::post('/get-delivery-area', 'Admin\ShippingChargeController@GetDeliveryArea')->name('getDeliveryArea');

		//End Shipping charge configuration

		//Start Customer Group Section
		Route::resource('customerGroups', 'Admin\CustomerGroupController');
		Route::get('/customer-group-add', 'Admin\CustomerGroupController@addCustomerGroup')->name('customerGroup.add');
		Route::post('/save-customer-group', 'Admin\CustomerGroupController@saveCustomerGroup');
		Route::get('/customer-groups/status/{id}', 'Admin\CustomerGroupController@status')->name('customerGroup.status');

		Route::get('/edit-customer-group/{id}', 'Admin\CustomerGroupController@edit')->name('customerGroup.edit');

		Route::post('/update-customer-group', 'Admin\CustomerGroupController@updateCustomerGroup');

		Route::get('/shipping-charge-delete/{id}', 'Admin\CustomerGroupController@deleteCustomerGroup')->name('customerGroup.delete');
		Route::post('/customer-group-delete', 'Admin\CustomerGroupController@destroy')->name('customerGroup.deletes');

		//End Customer Group Section

		//Start Product Section
		Route::resource('products', 'Admin\ProductController');

		Route::get('/product-add', 'Admin\ProductController@addproduct')->name('productadd.page');

		Route::get('/products/status/{id}', 'Admin\ProductController@changeStatus')->name('products.changeStatus');	

		Route::post('/product-save', 'Admin\ProductController@saveProduct')->name('productSetupBasicInfo.save');

		Route::post('/advanceproduct-save', 'Admin\ProductController@advnceProduct')->name('productadvance.save');

		Route::post('/productseo-save', 'Admin\ProductController@productSeo')->name('productseo.save');

		Route::post('/productprice-save', 'Admin\ProductController@productPrcie')->name('productPrice.save');

		Route::post('/productothers-save', 'Admin\ProductController@productOthers')->name('productOthers.save');

		Route::get('/product-edit/{id}', 'Admin\ProductController@editProduct')->name('product.edit');

		Route::post('/product-update', 'Admin\ProductController@updateProduct')->name('productSetupBasicInfo.update');

		Route::post('/single-product-destroy', 'Admin\ProductController@destroy')->name('single-product-destroy');

		//route for flash sell
		Route::get('/flash-sell', 'Admin\ProductController@FlashSell')->name('flashSell');
		Route::post('/flash-sell-update', 'Admin\ProductController@FlashSellUpdate')->name('flashSell.update');

		//image upload from ajax request
		Route::post('/upload-image', 'Admin\ProductController@saveProductImage')->name('productImage.save');
		Route::post('/remove-image', 'Admin\ProductController@deleteProductImage')->name('productImage.delete');

		Route::post('/productadvance-update', 'Admin\ProductController@updateProductAdvanceInfo')->name('productSetupAdvanceInfo.update');

		Route::post('/productseo-update', 'Admin\ProductController@updateProductSeoInfo')->name('productSetupSeoInfo.update');
		Route::post('/productothers-update', 'Admin\ProductController@updateProductOthers')->name('productOthers.update');

		Route::get('/product-delete/{id}', 'Admin\ProductController@deleteProduct')->name('product.delete');

		//end Product Section

		//Checkout section

		Route::resource('checkouts', 'Admin\CheckoutController');
		Route::get('/checkouts/{id}/status', 'Admin\CheckoutController@status')->name('checkouts.status');

		
		//end Checkout section

		//Customer Section
		Route::resource('customers', 'Admin\CustomerController');
		// Route::get('/customer-add', 'Admin\CustomerController@customerAdd')->name('customer.customerAdd');
		// Route::post('/customer-save', 'Admin\CustomerController@customerSave')->name('customer.customerSave');
		// Route::get('/customer-edit/{id}', 'Admin\CustomerController@customerEdit')->name('customer.customerEdit');
		// Route::post('/customer-update', 'Admin\CustomerController@customerUpdate')->name('customer.customerUpdate');
		Route::post('/customer-delete', 'Admin\CustomerController@customerDelete')->name('customer.customerDestroy');

		Route::get('/customer-details/{id}', 'Admin\CustomerController@customerDetails')->name('customer.customerDetails');
		Route::post('/update-clientGroup', 'Admin\CustomerController@updateClientGroup')->name('update.clientGroup');

		//end customer section


		/*
			All Setings start here
		*/

		//Start Menu Section
		Route::get('/menu', 'Admin\MenuController@index')->name('menu.index');
		Route::match(['GET', 'POST'], '/menu/add', 'Admin\MenuController@add')->name('menuadd.page');
		Route::match(['GET', 'POST'],'/menu/edit/{id}', 'Admin\MenuController@edit')->name('menu.edit');
		Route::get('/menu/status/{id}', 'Admin\MenuController@changeStatus')->name('menu.changeStatus');
		Route::get('/menu/delete/{id}', 'Admin\MenuController@delete')->name('menu.delete');
		Route::post('/menu/delete', 'Admin\MenuController@delete')->name('menu.destroy');


		//Sliders Section
		Route::resource('sliders', 'Admin\SliderController');
		Route::get('/slider-add', 'Admin\SliderController@addslider')->name('slideradd.page');
		Route::post('/slider-save', 'Admin\SliderController@saveslider')->name('slider.save');

		Route::get('/sliders/status/{id}', 'Admin\SliderController@changeStatus')->name('sliders.changeStatus');

		Route::get('/slider-status/{id}', 'Admin\SliderController@sliderStatus')->name('slider.status');

		Route::get('/slider-edit/{id}', 'Admin\SliderController@editSlider')->name('slider.edit');
		Route::post('/slider-update', 'Admin\SliderController@updateSlider')->name('slider.update');
		Route::get('/slider-delete/{id}', 'Admin\SliderController@deleteSlider')->name('slider.delete');
		
		/*Route::resource('featuredSliders', 'FeaturedSliderController');
		Route::resource('featuredImages', 'FeaturedImageController');*/

		//Site Information section

		Route::get('/website-information', 'Admin\SettingsController@information')->name('site.info');
		Route::post('/update-information', 'Admin\SettingsController@updatSettings')->name('settings.update');
		Route::get('/admin-logo', 'Admin\SettingsController@adminLogo')->name('admin.logo');
		Route::post('/adminLogo-update', 'Admin\SettingsController@updatadminLogo')->name('adminLogo.update');

		// policies section such as : money back, free shipping, online support

		Route::resource('policies', 'Admin\PoliciesController');
		Route::get('/policies-add', 'Admin\PoliciesController@addpolicies')->name('policyadd.page');

		Route::post('/policy-save', 'Admin\PoliciesController@savepolicy')->name('policy.save');

		Route::get('/policies/status/{id}', 'Admin\PoliciesController@changepolicyStatus')->name('policies.changepolicyStatus');

		Route::get('/policy-edit/{id}', 'Admin\PoliciesController@editPolicy')->name('policy.edit');

		Route::post('/policy-upate', 'Admin\PoliciesController@updatePolicy')->name('policy.update');
		Route::match(['GET', 'POST'], '/policy-delete/{id}', 'Admin\PoliciesController@delete')->name('policy.delete');

		// Banner advertize section
		Route::get('/banners', 'Admin\BannersController@index')->name('banners.index');
		Route::get('/banners-add', 'Admin\BannersController@addbanner')->name('banneradd.page');

		Route::post('/banner-save', 'Admin\BannersController@savebanner')->name('banner.save');

		Route::get('/banners/status/{id}', 'Admin\BannersController@status')->name('banners.changebannerStatus');

		Route::get('/banner-edit/{id}', 'Admin\BannersController@editBanner')->name('banner.edit');

		Route::post('/banner-upate', 'Admin\BannersController@updateBanner')->name('banner.update');
		Route::post('/banner-delete', 'Admin\BannersController@deleteBanner')->name('banner.delete');

		//Social Link section
		Route::get('/social-lniks', 'Admin\SocialLinkController@index')->name('social.index');
		Route::match(['GET', 'POST'], '/social-lniks/add', 'Admin\SocialLinkController@add')->name('social.add');
		Route::match(['GET', 'POST'], '/social-lniks/edit/{id}', 'Admin\SocialLinkController@edit')->name('social.edit');
		Route::get('/social-lniks/status/{id}', 'Admin\SocialLinkController@status')->name('social.status');
		Route::match(['GET', 'POST'], '/social-lniks/delete/{id}', 'Admin\SocialLinkController@delete')->name('social.delete');

		//Contact Information
		
		Route::resource('contacts', 'Admin\ContactController');
		Route::get('/contact-details/{id}', 'Admin\ContactController@contactDetails')->name('contact.contactDetails');

		//Customer Review Here
		Route::resource('reviews', 'Admin\ReviewController');
		Route::get('/review-details/{id}', 'Admin\ReviewController@reviewDetails')->name('review.reviewDetails');
		Route::get('/review/status/{id}', 'Admin\ReviewController@changereviewStatus')->name('reviews.changereviewStatus');

		//Start Blog Section
		Route::get('/blogs', 'Admin\BlogController@index')->name('blogs.index');
		Route::get('/blog-add', 'Admin\BlogController@addblog')->name('blogs.add');

		Route::post('/blog-save', 'Admin\BlogController@saveblog')->name('blogs.save');

		Route::get('/blog-edit/{id}', 'Admin\BlogController@editBlog')->name('blogs.edit');

		Route::post('/blog-update/{id}', 'Admin\BlogController@updateBlog')->name('blogs.update');

		Route::get('/blogs/status/{id}', 'Admin\BlogController@status')->name('blogs.status');
		Route::match(['GET', 'POST'], '/blogs/delete/{id}', 'Admin\BlogController@delete')->name('blogs.delete');

		//End Blog Section

		//Article Section
		Route::get('/articles', 'Admin\ArticleController@index')->name('articles.index');
		Route::match(['GET', 'POST'], '/articles/add', 'Admin\ArticleController@add')->name('articles.add');
		Route::match(['GET', 'POST'], '/articles/edit/{id}', 'Admin\ArticleController@edit')->name('articles.edit');
		Route::get('/articles/status/{id}', 'Admin\ArticleController@status')->name('articles.status');
		Route::match(['GET', 'POST'], '/articles/delete/{id}', 'Admin\ArticleController@delete')->name('articles.delete');

		//Delivery Zone Setup
		Route::get('/delivery-zone', 'Admin\DeliveryZoneController@index')->name('deliveryZone.index');
		Route::get('/delivery-zone-add', 'Admin\DeliveryZoneController@add')->name('deliveryZone.add');
		Route::post('/delivery-zone-save', 'Admin\DeliveryZoneController@save')->name('deliveryZone.save');
		Route::get('/delivery-zone-edit/{id}', 'Admin\DeliveryZoneController@edit')->name('deliveryZone.edit');
		Route::post('/delivery-zone-update', 'Admin\DeliveryZoneController@update')->name('deliveryZone.update');
		Route::post('/delivery-zone-destroy', 'Admin\DeliveryZoneController@destroy')->name('deliveryZone.destroy');

		//Area Setup
		Route::get('/area', 'Admin\AreaController@index')->name('area.index');
		Route::get('/area-add', 'Admin\AreaController@add')->name('area.add');
		Route::post('/area-save', 'Admin\AreaController@save')->name('area.save');
		Route::get('/area-edit/{id}', 'Admin\AreaController@edit')->name('area.edit');
		Route::post('/area-update', 'Admin\AreaController@update')->name('area.update');
		Route::post('/area-destroy', 'Admin\AreaController@destroy')->name('area.destroy');

		//Header Block of any section
		Route::match(['GET', 'POST'], '/header-block/article/{section}', 'Admin\HeaderBlockController@HeaderBlockInfo')->name('headerArticle.block');

		//News letter subscribe section here

		Route::resource('subscribers', 'Admin\NewsletterController');

		//User Menu 
		Route::get('/user-menu', 'Admin\UserMenuController@index')->name('usermenu.index');
		Route::get('/user-menu/add', 'Admin\UserMenuController@add')->name('usermenu.add');
		Route::post('/user-menu/save', 'Admin\UserMenuController@save')->name('usermenu.save');
		Route::get('/user-menu/edit/{id}', 'Admin\UserMenuController@edit')->name('usermenu.edit');
		Route::post('/user-menu/update', 'Admin\UserMenuController@update')->name('usermenu.update');
		Route::get('/user-menu/status', 'Admin\UserMenuController@status')->name('usermenu.status');
		Route::post('/usermenu-delete', 'Admin\UserMenuController@destroy')->name('usermenu-delete');

		//End User Menu

		//User Menu link action
		Route::get('/user-menu-link/{id}', 'Admin\UserMenuController@usermenuLink')->name('usermenuLink.index');
		Route::get('/user-menu-link-add/{menuId}', 'Admin\UserMenuController@usermenuLinkAdd')->name('userMenu.ActionLinkAdd');
		Route::post('/user-menu-link-save/{parentMenuId}', 'Admin\UserMenuController@usermenuLinkSave')->name('userMenu.ActionLinkSave');
		Route::get('/user-menu-link-edit/{menuId}/{id}', 'Admin\UserMenuController@usermenuLinkEdit')->name('userMenu.ActionLinkEdit');
		Route::post('/user-menu-link-update/{parentMenuId}', 'Admin\UserMenuController@usermenuLinkUpdate')->name('userMenu.ActionLinkUpdate');
		Route::get('/user-menu-action/status', 'Admin\UserMenuController@actionStatus')->name('usermenuAction.status');
		Route::post('/user-menu-action/delete', 'Admin\UserMenuController@actionDestroy')->name('usermenuAction.delete');

		//User Manage

		Route::resource('users', 'Admin\AdminController');
		Route::get('/user-add', 'Admin\AdminController@adduser')->name('useradd.page');

		Route::post('/user-save', 'Admin\AdminController@saveuser')->name('user.save');

		Route::get('/user/status/{id}', 'Admin\AdminController@changeuserStatus')->name('user.changeuserStatus');

		Route::get('/user-edit/{id}', 'Admin\AdminController@edituser')->name('user.edit');

		Route::post('/user-upate', 'Admin\AdminController@updateuser')->name('user.update');
		Route::get('/user-password/{id}', 'Admin\AdminController@password')->name('user.password');

		Route::get('/user-profile/{id}', 'Admin\AdminController@userProfile')->name('user.profile');

		Route::post('/user-changePassword', 'Admin\AdminController@passwordChange')->name('user.changePassword');

		Route::get('/user-account', 'Admin\AdminController@UserAccount')->name('user.account');
		Route::get('/user-account-password/{id}', 'Admin\AdminController@password')->name('userAccount.password');


		//User Roll Manage

		Route::resource('user-roles', 'Admin\UserRoleController');
		Route::get('/user-role-add', 'Admin\UserRoleController@adduserRole')->name('userRoleAdd.page');

		Route::post('/user-role-save', 'Admin\UserRoleController@saveuserRole')->name('userRole.save');

		Route::get('/userRole/status/{id}', 'Admin\UserRoleController@changeuserRoleStatus')->name('userRole.changeuserRoleStatus');

		Route::get('/user-role-edit/{id}', 'Admin\UserRoleController@edituserRole')->name('userRole.edit');

		Route::post('/user-role-upate', 'Admin\UserRoleController@updateuserRole')->name('userRole.update');
		Route::get('/user-role-permission/{id}', 'Admin\UserRoleController@permission')->name('userRole.permission');
		Route::post('/user-role-permission-update', 'Admin\UserRoleController@permissionUpdate')->name('userRole.permissionUpdate');

		//vendor setup
		Route::get('/vendors', 'Admin\VendorController@index')->name('vendor.index');
		Route::get('/vendor-add', 'Admin\VendorController@add')->name('vendor.add');
		Route::post('/vendor-save', 'Admin\VendorController@save')->name('vendor.save');
		Route::get('/vendor-edit/{id}', 'Admin\VendorController@edit')->name('vendor.edit');
		Route::post('/vendor-update', 'Admin\VendorController@update')->name('vendor.update');
		Route::get('/vendor/status', 'Admin\VendorController@status')->name('vendor.status');
		Route::post('/vendor-delete', 'Admin\VendorController@destroy')->name('vendor-delete');

		//Cash Purchase setup
		Route::get('/cash-purchase', 'Admin\CashPurchaseController@index')->name('cashPurchase.index');
		Route::get('/cash-purchase/add', 'Admin\CashPurchaseController@add')->name('cashPurchase.add');
		Route::post('/cash-purchase/save', 'Admin\CashPurchaseController@save')->name('cashPurchase.save');
		Route::get('/cash-purchase/edit/{id}', 'Admin\CashPurchaseController@edit')->name('cashPurchase.edit');
		Route::post('/cash-purchase/update', 'Admin\CashPurchaseController@update')->name('cashPurchase.update');
		Route::post('/cash-purchase/destroy', 'Admin\CashPurchaseController@destroy')->name('cashPurchase.destroy');

		//Credit Purchase Setup
		Route::get('/credit-purchase', 'Admin\CreditPurchaseController@index')->name('creditPurchase.index');
		Route::get('/credit-purchase/add', 'Admin\CreditPurchaseController@add')->name('creditPurchase.add');
		Route::post('/credit-purchase/save', 'Admin\CreditPurchaseController@save')->name('creditPurchase.save');
		Route::get('/credit-purchase/edit/{id}', 'Admin\CreditPurchaseController@edit')->name('creditPurchase.edit');
		Route::post('/credit-purchase/update', 'Admin\CreditPurchaseController@update')->name('creditPurchase.update');
		Route::post('/credit-purchase/destroy', 'Admin\CreditPurchaseController@destroy')->name('creditPurchase.destroy');

		//Purchase Order
		Route::get('/purchase-order', 'Admin\PurchaseOrderController@index')->name('purchaseOrder.index');
		Route::get('/purchase-order/add', 'Admin\PurchaseOrderController@add')->name('purchaseOrder.add');
		Route::post('/purchase-order/save', 'Admin\PurchaseOrderController@save')->name('purchaseOrder.save');
		Route::get('/purchase-order/edit/{id}', 'Admin\PurchaseOrderController@edit')->name('purchaseOrder.edit');
		Route::post('/purchase-order/update', 'Admin\PurchaseOrderController@update')->name('purchaseOrder.update');
		Route::get('/purchase-order/view/{id}', 'Admin\PurchaseOrderController@view')->name('purchaseOrder.view');
		Route::post('/purchase-order/destroy', 'Admin\PurchaseOrderController@destroy')->name('purchaseOrder.destroy');

		//Purchase Order Receive
		Route::get('/purchase-order-receive', 'Admin\PurchaseOrderReceiveController@index')->name('purchaseOrderReceive.index');
		Route::get('/purchase-order-receive/add', 'Admin\PurchaseOrderReceiveController@add')->name('purchaseOrderReceive.add');
		Route::post('/purchase-order-receive/save', 'Admin\PurchaseOrderReceiveController@save')->name('purchaseOrderReceive.save');
		Route::get('/purchase-order-receive/edit/{id}', 'Admin\PurchaseOrderReceiveController@edit')->name('purchaseOrderReceive.edit');
		Route::post('/purchase-order-receive/update', 'Admin\PurchaseOrderReceiveController@update')->name('purchaseOrderReceive.update');
		Route::post('/purchase-order-receive/destroy', 'Admin\PurchaseOrderReceiveController@destroy')->name('purchaseOrderReceive.destroy');
		Route::post('/get-purchase-order', 'Admin\PurchaseOrderReceiveController@getPurchaseOrderItem')->name('getPurchaseOrderItem');

		//Chase Sales setup
		Route::get('/cash-sale', 'Admin\CashSaleController@index')->name('cashSale.index');
		Route::get('/cash-sale/add', 'Admin\CashSaleController@add')->name('cashSale.add');
		Route::post('/cash-sale/save', 'Admin\CashSaleController@save')->name('cashSale.save');
		Route::get('/cash-sale/edit/{id}', 'Admin\CashSaleController@edit')->name('cashSale.edit');
		Route::post('/cash-sale/update', 'Admin\CashSaleController@update')->name('cashSale.update');
		Route::post('/cash-sale/destroy', 'Admin\CashSaleController@destroy')->name('cashSale.destroy');

		//Credit Sales setup
		Route::get('/credit-sale', 'Admin\CreditSaleController@index')->name('creditSale.index');
		Route::get('/credit-sale/add', 'Admin\CreditSaleController@add')->name('creditSale.add');
		Route::post('/credit-sale/save', 'Admin\CreditSaleController@save')->name('creditSale.save');
		Route::get('/credit-sale/edit/{id}', 'Admin\CreditSaleController@edit')->name('creditSale.edit');
		Route::post('/credit-sale/update', 'Admin\CreditSaleController@update')->name('creditSale.update');
		Route::post('/credit-sale/destroy', 'Admin\CreditSaleController@destroy')->name('creditSale.destroy');

		//Credit Collection setup
		Route::get('/credit-collection', 'Admin\CreditCollectionController@index')->name('creditCollection.index');
		Route::get('/credit-collection/add', 'Admin\CreditCollectionController@add')->name('creditCollection.add');
		Route::post('/credit-collection/save', 'Admin\CreditCollectionController@save')->name('creditCollection.save');
		Route::get('/credit-collection/edit/{id}', 'Admin\CreditCollectionController@edit')->name('creditCollection.edit');
		Route::post('/credit-collection/update', 'Admin\CreditCollectionController@update')->name('creditCollection.update');
		Route::post('/credit-collection/destroy', 'Admin\CreditCollectionController@destroy')->name('creditCollection.destroy');
		Route::post('/get-client-info', 'Admin\CreditCollectionController@getClientInfo')->name('getClientInfo');

		//Client Entry setup
		Route::get('/client-entry', 'Admin\ClientEntryController@index')->name('clientEntry.index');
		Route::get('/client-entry/add', 'Admin\ClientEntryController@add')->name('clientEntry.add');
		Route::post('/client-entry/save', 'Admin\ClientEntryController@save')->name('clientEntry.save');
		Route::get('/client-entry/edit/{id}', 'Admin\ClientEntryController@edit')->name('clientEntry.edit');
		Route::post('/client-entry/update', 'Admin\ClientEntryController@update')->name('clientEntry.update');
		Route::get('/client-entry/view/{id}', 'Admin\ClientEntryController@view')->name('clientEntry.view');
		Route::post('/client-entry/destroy', 'Admin\ClientEntryController@destroy')->name('clientEntry.destroy');

		//Supplier Payment
		Route::get('/supplier-payment', 'Admin\SupplierPaymentController@index')->name('supplierPayment.index');
		Route::get('/supplier-payment/add', 'Admin\SupplierPaymentController@add')->name('supplierPayment.add');
		Route::post('/supplier-payment/save', 'Admin\SupplierPaymentController@save')->name('supplierPayment.save');
		Route::get('/supplier-payment/edit/{id}', 'Admin\SupplierPaymentController@edit')->name('supplierPayment.edit');
		Route::post('/supplier-payment/update', 'Admin\SupplierPaymentController@update')->name('supplierPayment.update');
		Route::post('/supplier-payment/destroy', 'Admin\SupplierPaymentController@destroy')->name('supplierPayment.delete');
		Route::post('/get-supplier-info', 'Admin\SupplierPaymentController@getSupplierInfo')->name('getSupplierInfo');

		//Purchase Return
		Route::get('/purchase-return', 'Admin\PurchaseReturnController@index')->name('purchaseReturn.index');
		Route::get('/purchase-return/add', 'Admin\PurchaseReturnController@add')->name('purchaseReturn.add');
		Route::post('/purchase-return/save', 'Admin\PurchaseReturnController@save')->name('purchaseReturn.save');
		Route::get('/purchase-return/edit/{id}', 'Admin\PurchaseReturnController@edit')->name('purchaseReturn.edit');
		Route::post('/purchase-return/update', 'Admin\PurchaseReturnController@update')->name('purchaseReturn.update');
		Route::post('/purchase-return/destroy', 'Admin\PurchaseReturnController@destroy')->name('purchaseReturn.destroy');
		// Route::post('/get-purchase-order', 'Admin\PurchaseReturnController@getPurchaseOrderItem')->name('getPurchaseOrderItem');

// Report Section Start
		//Purchase  Log
		Route::get('/purchase-log', 'Admin\PurchaseLogController@index')->name('purchaseLog.index');
		Route::post('/purchase-log', 'Admin\PurchaseLogController@index')->name('purchaseLog.index');
		Route::get('/purchase-log/print', 'Admin\PurchaseLogController@print')->name('purchaseLog.print');

		//Product List
		Route::get('/product-list', 'Admin\ProductListController@index')->name('productList.index');
		Route::post('/product-list', 'Admin\ProductListController@index')->name('productList.index');
		Route::post('/product-list/print', 'Admin\ProductListController@print')->name('productList.print');

		// Payment Log
		Route::get('/payment-log', 'Admin\PaymentLogController@index')->name('paymentLog.index');
		Route::post('/payment-log', 'Admin\PaymentLogController@index')->name('paymentLog.index');
		Route::post('/payment-log/print', 'Admin\PaymentLogController@print')->name('paymentLog.print');

		//Supplier Statement
		Route::get('/supplier-statement','Admin\SupplierStatementController@index')->name('supplierStatement.index');
		Route::post('/supplier-statement','Admin\SupplierStatementController@index')->name('supplierStatement.index');
		Route::post('/supplier-statement/print', 'Admin\SupplierStatementController@print')->name('supplierStatement.print');

		//Client Statement
		Route::get('/client-statement','Admin\ClientStatementController@index')->name('clientStatement.index');
		Route::post('/client-statement','Admin\ClientStatementController@index')->name('clientStatement.index');
		Route::post('/client-statement/print','Admin\ClientStatementController@print')->name('clientStatement.print');

		//Sales Contribution
		Route::get('/sales-contribution','Admin\SalesContributionController@index')->name('salesContribution.index');
		Route::post('/sales-contribution','Admin\SalesContributionController@index')->name('salesContribution.index');
		Route::post('/sales-contribution/print','Admin\SalesContributionController@print')->name('salesContribution.print');

		//Supply & payment Summery
		Route::get('/supply-payment-summery','Admin\SupplyPaymentSummeryController@index')->name('supplyPaymentSummery.index');
		Route::post('/supply-payment-summery','Admin\SupplyPaymentSummeryController@index')->name('supplyPaymentSummery.index');
		Route::post('/supply-payment-summery/print', 'Admin\SupplyPaymentSummeryController@print')->name('supplyPaymentSummery.print');

		//Stock Status Report
		Route::get('/stock-status-report','Admin\StockStatusReportController@index')->name('stockStatusReport.index');
		Route::post('/stock-status-report','Admin\StockStatusReportController@index')->name('stockStatusReport.index');
		Route::post('/stock-status-report/print','Admin\StockStatusReportController@print')->name('stockStatusReport.print');
		Route::post('/stock-status-report/product-list','Admin\StockStatusReportController@getAllProductByCategory')->name('stockStatusReport.getAllProductByCategory');

		//Out Of Stock Report
		Route::get('/out-of-stock-report','Admin\OutOfStockReportController@index')->name('outOfStockReport.index');
		Route::post('/out-of-stock-report','Admin\OutOfStockReportController@index')->name('outOfStockReport.index');
		Route::post('/out-of-stock-report/print','Admin\OutOfStockReportController@print')->name('outOfStockReport.print');
		Route::post('/out-of-stock-report/product-list','Admin\OutOfStockReportController@getAllProductByCategory')->name('outOfStockReport.getAllProductByCategory');

		//Stock Valuation Report
		Route::get('/stock-valuation-report','Admin\StockValuationReportController@index')->name('stockValuationReport.index');
		Route::post('/stock-valuation-report','Admin\StockValuationReportController@index')->name('stockValuationReport.index');
		Route::post('/stock-valuation-report/print','Admin\StockValuationReportController@print')->name('stockValuationReport.print');
		Route::post('/stock-valuation-report/product-list','Admin\StockStatusReportController@getAllProductByCategory')->name('stockValuationReport.getAllProductByCategory');

		//Sales & collection Outstanding
		Route::get('/sales-collection-outstanding','Admin\SalesCollectionOutstandingController@index')->name('salesCollectionOutstanding.index');
		Route::post('/sales-collection-outstanding','Admin\SalesCollectionOutstandingController@index')->name('salesCollectionOutstanding.index');
		Route::post('/sales-collection-outstanding/print','Admin\SalesCollectionOutstandingController@print')->name('salesCollectionOutstanding.print');

		//Purchase History
		Route::get('/purchase-history','Admin\PurchaseHistoryController@index')->name('purchaseHistory.index');
		Route::post('/purchase-history','Admin\PurchaseHistoryController@index')->name('purchaseHistory.index');
		Route::post('/purchase-history/print','Admin\PurchaseHistoryController@print')->name('purchaseHistory.print');

		//Collection History
		Route::get('/collection-history','Admin\CollectionHistoryController@index')->name('collectionHistory.index');
		Route::post('/collection-history','Admin\CollectionHistoryController@index')->name('collectionHistory.index');
		Route::post('/collection-history/print','Admin\CollectionHistoryController@print')->name('collectionHistory.print');
 
		//Purchase Order Status
		Route::get('/purchase-order-status','Admin\PurchaseOrderStatusController@index')->name('purchaseOrderStatus.index');
		Route::post('/purchase-order-status','Admin\PurchaseOrderStatusController@index')->name('purchaseOrderStatus.index');
		Route::post('/purchase-order-status/print','Admin\PurchaseOrderStatusController@print')->name('purchaseOrderStatus.print');

		//Purchase Return History
		Route::get('/purchase-return-history','Admin\PurchaseReturnHistoryController@index')->name('purchaseReturnHistory.index');
		Route::post('/purchase-return-history','Admin\PurchaseReturnHistoryController@index')->name('purchaseReturnHistory.index');
		Route::post('/purchase-return-history/print','Admin\PurchaseReturnHistoryController@print')->name('purchaseReturnHistory.print');

		//Sales History
		Route::get('/sales-history','Admin\SalesHistoryController@index')->name('salesHistory.index');
		Route::post('/sales-history','Admin\SalesHistoryController@index')->name('salesHistory.index');
		Route::post('/sales-history/print','Admin\SalesHistoryController@print')->name('salesHistory.print');

		//Product Wise Sales History
		Route::get('/product-wise-sales','Admin\ProductWiseSalesController@index')->name('productWiseSales.index');
		Route::post('/product-wise-sales','Admin\ProductWiseSalesController@index')->name('productWiseSales.index');
		Route::post('/product-wise-sales/print','Admin\ProductWiseSalesController@print')->name('productWiseSales.print');

		//Product Wise Profit
		Route::get('/product-wise-profit','Admin\ProductWiseProfitController@index')->name('productWiseProfit.index');
		Route::post('/product-wise-profit','Admin\ProductWiseProfitController@index')->name('productWiseProfit.index');
		Route::post('/product-wise-profit/print','Admin\ProductWiseProfitController@print')->name('productWiseProfit.print');

		//Client Wise Sales History
		Route::get('/client-wise-sales','Admin\ClientWiseSalesController@index')->name('clientWiseSales.index');
		Route::post('/client-wise-sales','Admin\ClientWiseSalesController@index')->name('clientWiseSales.index');
		Route::post('/client-wise-sales/print','Admin\ClientWiseSalesController@print')->name('clientWiseSales.print');

		});
	});

	//Admin Login Url
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login');
    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');

    // Password Reset Routes...
     Route::get('/password/reset', 'Auth\AdminForgotPasswordController@passwordForget')->name('admin.password.forget');
     Route::post('/password/email', 'Auth\AdminForgotPasswordController@passwordEmail')->name('admin.password.email');
     Route::get('/new-password/{email}', 'Auth\AdminForgotPasswordController@newPassword')->name('admin.password.newPassword');
     Route::post('/password/save', 'Auth\AdminForgotPasswordController@changePasswordSave')->name('admin.password.save');

});

//Admin part end

//frontend url start from here
Route::get('/', 'FrontendController@index')->name('home.index');
Route::get('/search', 'SearchController@searchProduct')->name('search');
Route::post('/get-delivery-area', 'FrontendController@GetDeliveryArea')->name('getArea');

//view product
Route::get('/product/{id}/{name}', 'ProductController@ProductDetails')->name('product.details');

//view Category product
Route::get('/categories/{id}/{name}', 'CategoryController@ProductByCategory');
Route::get('/get-category-product/{id}', 'CategoryController@GetCategoryProduct');
Route::get('/subcategories/{categoryId}/sort/{sortId}', 'FrontendController@productSort');

//Cart Section
Route::get('/show-cart', 'CartController@index')->name('cart.index');
Route::POST('/carts/update', 'CartController@update')->name('carts.update');
Route::get('/cart/item', 'CartController@cartItem')->name('cart.cartItem');
Route::get('/cart/addItem/{id}/{price}', 'CartController@addItem')->name('cart.addItem');
Route::get('/cart/addItemFromSingleProduct/{productID}/{quantity}', 'CartController@addItemFromSingleProduct')->name('cart.addItemFromSingleProduct');
Route::get('/cart/minicartProduct', 'CartController@minicartProduct')->name('cart.minicartProduct');
Route::get('/cart/mainCartProduct', 'CartController@MainCartProduct')->name('cart.MainCartProduct');
Route::get('/cart/minicartSubtotal', 'CartController@minicartSubtotal')->name('cart.minicartSubtotal');
Route::get('/carts/{rowId}/remove', 'CartController@remove')->name('cart.remove');
Route::post('/product/buy', 'CartController@buyProduct')->name('product.buy');//product buy direct from single product


//Checkout Section
Route::get('/order-processing', 'OrderController@OrderProcessing')->name('cart.order');
Route::get('/complete-order', 'OrderController@OrderSuccess')->name('order.success');
Route::post('/complete-order', 'OrderController@OrderSave')->name('order.save');

// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END

//customer authentication before login
Route::prefix('customer')->group(function()
{
	Route::get('/login', 'CustomerController@showLoginForm')->name('customer.login');
	Route::post('/do-login', 'CustomerController@login')->name('customer.dologin');
	Route::get('/registration', 'CustomerController@showRegistrationForm')->name('customer.registration');
	Route::post('/register', 'CustomerController@customerRegister')->name('customer.register');
	Route::get('/confirm-link/{verifyCode}', 'CustomerController@registerSave')->name('custmomer.save');

	//Reset password
	Route::get('/password-forget', 'CustomerController@passwordForget')->name('password.forget');
	Route::post('/password-mail', 'CustomerController@passwordMail')->name('password.mail');
	Route::get('/new-password/{email}/{verify_token}', 'CustomerController@newPassword')->name('password.reset');

	Route::post('/password-save', 'CustomerController@changePasswordSave')->name('password.save');
});

//Customer Authentication Section after login
Route::group(['middleware'=>'CheckCustomer'],function(){
	Route::prefix('customer')->group(function()
	{
		Route::get('/profile/{id}', 'CustomerController@profile')->name('customer.profile');
		Route::post('/update', 'CustomerController@updateProfile')->name('customer.update');

		Route::get('/order', 'CustomerController@orderList')->name('customer.order');
		Route::get('/order-details/{id}', 'CustomerController@orderDetails')->name('order.details');

		Route::get('/logout', 'CustomerController@logout')->name('customer.logout');
	});

});

//Order History View Section
Route::get('/shipping-email', 'CustomerController@shippingEmail');
Route::post('/view-order', 'CustomerController@viewOrder');

//Contact Message here
Route::get('/contact-us', 'FrontendController@contactUs')->name('contactpage');
Route::post('/contact-save', 'Admin\ContactController@contacts')->name('contact.save');

//Customer Review here
Route::post('/customer-review', 'Admin\ReviewController@customerReview')->name('customerReview.save');

//Dynamic Menu or Page
Route::get('/{menuName}/{menuId}', 'PageController@Page')->name('page.content');

Route::get('/{anypath}', 'FrontendController@Page404')->where('path','.*');
