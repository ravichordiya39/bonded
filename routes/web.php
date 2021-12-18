<?php

use Illuminate\Support\Facades\Route;



//Guest Route
Route::get('/runCMD', function () {
   $exitCode = Artisan::call('key:generate');
});
Route::get('/', 'IndexController@index');
Route::post('config/get-subcat', 'IndexController@getSubCats');
Route::get('checkM', 'IndexController@checkM');
Route::get('showI', 'IndexController@showI');
Route::post('config/img-delete', 'IndexController@deleteImageFile');
Route::post('config/location', 'IndexController@getLocation');
Route::get('page/{page}', 'IndexController@getPage');
Route::get('blog', 'BlogController@getBlogs');
Route::get('blog/{slug}', 'BlogController@getCatBlog');
Route::get('blog/details/{slug}', 'BlogController@getBlogDetail');
Route::group(['prefix'=>'product'],function(){
    Route::get('productSearch/search','ProductController@searchProduct');
    Route::get('list','ProductController@getProducts');
    Route::get('exclusive','ProductController@getExclusiveProducts');
    Route::get('detail/{slug}','ProductController@getProductDetail');
    Route::get('{cat}','ProductController@getCatProduct');
    Route::get('{scat}/{cat}','ProductController@getSubCatProduct');
    Route::match(['get', 'post'],'favoriteOrRemove','ProductController@addRemoveFav');
    Route::match(['get', 'post'],'changeCurrency','ProductController@currencyUpdate');
    
    
});
Route::match(['get', 'post'],'productlist/{slug}/{id?}', 'ProductController@getProductJson')->name('product');

//Guest Route End



//User Route
Route::post('user/login','Auth\LoginController@login');
// Cart Controller Start
Route::get('/view-cart','CartController@index');
Route::post('/cart/remove','CartController@removeFromCart');
Route::post('/cart/add','CartController@addToCart');
Route::post('/cart/addJson','CartController@addToCartJson');
Route::get('/checkout','CartController@checkOut');
Route::post('checkout/payment','CartController@checkoutPayment');
Route::any('coupon-code','CartController@applyCoupon');
Route::group(['middleware' => ['auth'],'prefix'=>'user','namespace'=>'User'],function(){
    Route::get('/dashboard', 'IndexController@index');
    Route::post('shipping-address','ProductController@saveShippingAddress')->name('shipping-address');
    Route::get('address','ProductController@getShippingAddress');
    Route::get('coupon','ProductController@getCoupons');
    Route::get('order','ProductController@getOrders');
    Route::get('order-confirm/{oid}','ProductController@getConfirmOrder');
    Route::get('order/{oid}','ProductController@getOrderDetail');
    Route::match(['get','post'],'edit-profile','IndexController@editProfile')->name('edit-profile');
    Route::group(['prefix'=>'product'],function(){
        Route::group(['prefix'=>'wishlist'],function(){
            Route::get('/','ProductController@getWishlistProduct');
            Route::post('save','ProductController@saveWishlist');
        });
    });
    Route::post('/buy','PaymentController@buyProduct');
    Route::post('payment-process','PaymentController@paymentProcess');
    Route::any('payment/razarpayorder','PaymentController@razarpayorder');
      Route::post('cancel-order','PaymentController@cancel_order');
});


//admin Route
Route::namespace('Admin')->group(function () {
    Route::get('/admin','LoginController@getLogin')->name('admin-login');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/login','LoginController@getLogin')->name('admin-login');
    Route::post('/login','LoginController@postLogin');
    // Route::group(['middleware'=>'superadmin'],function(){

    // });
    Route::get('/dashboard','AdminController@getIndex');
    Route::group(['prefix'=>'category'],function(){
        Route::get('/','ProductCategoryController@getCategories');
        Route::post('save','ProductCategoryController@saveCategory')->name('save-product-category');
        Route::post('edit','ProductCategoryController@editCategory');
        Route::post('delete','ProductCategoryController@deleteCategory');
        Route::get('{id}','ProductCategoryController@getSubCategories');
    });
    Route::group(['prefix'=>'product'],function(){

        Route::get('list','ProductController@getProducts');
        Route::post('save','ProductController@saveProduct');
        Route::get('add','ProductController@addProductForm');
        Route::get('add/{cat}','ProductController@addProduct');
        Route::get('edit/{id}','ProductController@editProduct');
        Route::post('delete','ProductController@deleteProduct');
        Route::post('status','ProductController@statusProduct');
        Route::get('upload','ProductController@getUploadProduct');
        Route::post('upload','ProductController@postUploadProduct');
        Route::get('export-product-format', 'ProductController@exportProductFormat');
        Route::group(['prefix'=>'map-attribute'],function(){
            Route::get('/','ProductCategoryController@getMapAttributes');
            Route::post('save','ProductCategoryController@saveMapAttribute');
            Route::get('add','ProductCategoryController@addMapAttribute');
            Route::get('edit/{id}','ProductCategoryController@editMapAttribute');
            Route::post('delete','ProductCategoryController@deleteMapAttribute');
            Route::get('{id}','ProductCategoryController@getSubCategories');
        });
        //product config route at admin
        Route::group(['prefix'=>'config'],function(){
            Route::group(['prefix'=>'brand'],function(){
                Route::get('/','ProductConfigController@getBrands');
                Route::post('save','ProductConfigController@saveBrand');
                Route::post('edit','ProductConfigController@editBrand');
                Route::post('delete','ProductConfigController@deleteBrand');
            });
            Route::group(['prefix'=>'size'],function(){
                Route::get('/','ProductConfigController@getSizes');
                Route::post('save','ProductConfigController@saveSize');
                Route::post('edit','ProductConfigController@editSize');
                Route::post('delete','ProductConfigController@deleteSize');
            });
            Route::group(['prefix'=>'color'],function(){
                Route::get('/','ProductConfigController@getColors');
                Route::post('save','ProductConfigController@saveColor');
                Route::post('edit','ProductConfigController@editColor');
                Route::post('delete','ProductConfigController@deleteColor');
            });
            Route::group(['prefix'=>'occasion'],function(){
                Route::get('/','ProductConfigController@getOccasions');
                Route::post('save','ProductConfigController@saveOccasion');
                Route::post('edit','ProductConfigController@editOccasion');
                Route::post('delete','ProductConfigController@deleteOccasion');
            });
            Route::group(['prefix'=>'fabric'],function(){
                Route::get('/','ProductConfigController@getFabrics');
                Route::post('save','ProductConfigController@saveFabric');
                Route::post('edit','ProductConfigController@editFabric');
                Route::post('delete','ProductConfigController@deleteFabric');
            });
            Route::group(['prefix'=>'design'],function(){
                Route::get('/','ProductConfigController@getDesigns');
                Route::post('save','ProductConfigController@saveDesign');
                Route::post('edit','ProductConfigController@editDesign');
                Route::post('delete','ProductConfigController@deleteDesign');
            });
            Route::group(['prefix'=>'material'],function(){
                Route::get('/','ProductConfigController@getMaterials');
                Route::post('save','ProductConfigController@saveMaterial');
                Route::post('edit','ProductConfigController@editMaterial');
                Route::post('delete','ProductConfigController@deleteMaterial');
            });
            Route::group(['prefix'=>'pattern'],function(){
                Route::get('/','ProductConfigController@getPatterns');
                Route::post('save','ProductConfigController@savePattern');
                Route::post('edit','ProductConfigController@editPattern');
                Route::post('delete','ProductConfigController@deletePattern');
            });
        });
        //product config route end
    });
    Route::group(['prefix'=>'blog'],function(){
        Route::get('list','BlogsController@getBlogs');
        Route::post('save','BlogsController@saveBlog');
        Route::get('add','BlogsController@addBlog');
        Route::get('edit/{id}','BlogsController@editBlog');
        Route::post('delete','BlogsController@deleteBlog');
        Route::post('status','BlogsController@statusBlog');
    });
    Route::group(['prefix'=>'config'],function(){
        Route::group(['prefix'=>'front'],function(){
            Route::get('/list','ConfigController@getFrontConfigs');
            Route::post('save','ConfigController@saveFrontConfig');
            Route::get('edit','ConfigController@editFrontConfig');
            Route::post('status','ConfigController@statusFrontConfig');
        });
        Route::group(['prefix'=>'banner'],function(){
            Route::get('/list','CMSController@getBanners');
            Route::post('save','CMSController@saveBanner');
            Route::post('edit','CMSController@editBanner');
            Route::post('status','CMSController@statusBanner');
            Route::post('delete','CMSController@deleteBanner');
        });
        Route::group(['prefix'=>'cms'],function(){
            Route::get('list','CMSController@getCMS');
            Route::post('save','CMSController@saveCMS');
            Route::get('add','CMSController@addCMS');
            Route::get('edit/{id}','CMSController@editCMS');
            Route::post('status','CMSController@statusCMS');
        });
    });
     Route::get('all-orders', 'OrderController@allOrder');
	Route::post('/order-status', 'OrderController@orderStatus');
	Route::post('/order-shipping', 'OrderController@orderShipping');
	Route::post('/order-completed', 'OrderController@orderCompleted');
	Route::post('/delivery-detail', 'OrderController@deliveryDetail');
	Route::post('/coupon-status', 'CouponController@couponStatus');
    Route::resource('/coupon', 'CouponController');
    
    
    Route::get('reports/sale-report', 'OrderController@saleReport');
    Route::post('reports/fetch-sales-data', 'OrderController@fetchSalesData');
    Route::post('reports/export-sales-data', 'OrderController@exportsData');
    Route::get('reports/customer-report', 'OrderController@customerReport');
    Route::post('reports/fetch-customer-data', 'OrderController@fetchCustomerData');
    Route::get('admin/reports/export-customer-data', 'OrderController@exportsCustomerData');
    Route::get('reports/inventory-report', 'OrderController@inventoryReport');
    Route::post('reports/fetch-inventory-data', 'OrderController@fetchInventoryData');
    Route::get('admin/reports/export-inventory-data', 'OrderController@exportsInventoryData');
    Route::get('order/orderdeails/{id}',[
        'as'=>'order/orderdeails',
        'uses'=> 'OrderController@loadModal'
    ]);
    Route::resource('users', 'UsersController');
	Route::post('user-status', 'UsersController@userStatus');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
