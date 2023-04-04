<?php

 Route::prefix('/admin')->group(function(){
 	Route::get('/', 'Admin\DashboardController@getDashboard')->name('dashboard');

 	// Module Setting
 	Route::get('/settings', 'Admin\SettingsController@getHome')->name('settings');
 	Route::post('/settings', 'Admin\SettingsController@postHome')->name('settings');

 	// Module Users
 	Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
 	Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
 	Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit');
 	Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
 	Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
 	Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');

 	// Module Products
 	Route::get('/products/{status}', 'Admin\ProductController@getHome')->name('products');
 	Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name('product_add');
 	Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit');
 	Route::get('/product/{id}/delete', 'Admin\ProductController@getProductDelete')->name('product_delete');
 	Route::get('/product/{id}/restore', 'Admin\ProductController@getProductRestore')->name('product_delete');

	Route::get('/product/{id}/inventory', 'Admin\ProductController@getProductInventory')->name('product_inventory');

 	Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name('product_add');
 	Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name('product_search');
 	Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');

	Route::post('/product/{id}/inventory', 'Admin\ProductController@postProductInventory')->name('product_inventory');

 	Route::post('/product/{id}/gallery/add', 'Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
 	Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');

 	//modulo Inventory
	Route::get('/product/inventory/{id}/edit', 'Admin\ProductController@getProductInventoryEdit')->name('product_inventory');
	Route::post('/product/inventory/{id}/edit', 'Admin\ProductController@postProductInventoryEdit')->name('product_inventory');
	Route::get('/product/inventory/{id}/delete', 'Admin\ProductController@getProductInventoryDeleted')->name('product_inventory');


	 // Categories
 	Route::get('/categories/{module}', 'Admin\CategoriesController@getHome')->name('categories');
 	Route::post('/category/add/{module}', 'Admin\CategoriesController@postCategoryAdd')->name('category_add');
 	Route::get('/category/{id}/edit', 'Admin\CategoriesController@getCategoryEdit')->name('category_edit');
 	Route::post('/category/{id}/edit', 'Admin\CategoriesController@postCategoryEdit')->name('category_edit');
	Route::get('/category/{id}/subs', 'Admin\CategoriesController@getSubCategories')->name('category_edit');
 	Route::get('/category/{id}/delete', 'Admin\CategoriesController@getCategoryDelete')->name('category_delete');

 	// Sliders
 	Route::get('/sliders', 'Admin\SliderController@getHome')->name('sliders_list');
 	Route::post('/slider/add', 'Admin\SliderController@postSliderAdd')->name('slider_add');
 	Route::get('/slider/{id}/edit', 'Admin\SliderController@getSliderEdit')->name('slider_edit');
 	Route::post('/slider/{id}/edit', 'Admin\SliderController@postSliderEdit')->name('slider_edit');
 	Route::get('/slider/{id}/delete', 'Admin\SliderController@getSliderDelete')->name('slider_delete');

	// Javascript Request
	Route::get('/md/api/load/subcategories/{parent}', 'Admin\ApiController@getSubCategories');

    // Module Clientes
 	Route::get('/clients/{status}'	, 'Admin\ClientController@getHome')->name('clients');
 	Route::get('/client/add'		, 'Admin\ClientController@getClientAdd')->name('client_add');
 	Route::get('/client/{id}/edit'	, 'Admin\ClientController@getClientEdit')->name('client_edit');
 	Route::get('/client/{id}/delete', 'Admin\ClientController@getClientDelete')->name('client_delete');
 	Route::get('/client/{id}/restore', 'Admin\ClientController@getClientRestore')->name('client_delete');
 	Route::post('/client/add'		, 'Admin\ClientController@postClientAdd')->name('client_add');
 	Route::post('/client/search'	, 'Admin\ClientController@postClientSearch')->name('client_search');
 	Route::post('/client/{id}/edit'	, 'Admin\ClientController@postClientEdit')->name('client_edit');

 	// Module Pessoas
 	Route::get('/pessoas/{status}'	, 'Admin\PessoaController@getHome')->name('pessoas');
 	Route::get('/pessoa/add'		, 'Admin\PessoaController@getPessoaAdd')->name('pessoa_add');
 	Route::get('/pessoa/{id}/edit'	, 'Admin\PessoaController@getPessoaEdit')->name('pessoa_edit');
 	Route::get('/pessoa/{id}/delete', 'Admin\PessoaController@getPessoaDelete')->name('pessoa_delete');
 	Route::get('/pessoa/{id}/restore', 'Admin\PessoaController@getPessoaRestore')->name('pessoa_delete');
 	Route::post('/pessoa/add'		, 'Admin\PessoaController@postPessoaAdd')->name('pessoa_add');
 	Route::post('/pessoa/search'	, 'Admin\PessoaController@postPessoaSearch')->name('pessoa_search');
 	Route::post('/pessoa/{id}/edit'	, 'Admin\PessoaController@postPessoaEdit')->name('pessoa_edit');
	 Route::get('/pessoa/autocomplete'		, 'Admin\PessoaController@getPessoaAutocomplete')->name('pessoa_autocomplete');


 	// Services
    Route::get('/services/{status}'	, 'Admin\ServiceController@getHome')->name('services');
 	Route::get('/service/add'		, 'Admin\ServiceController@getServiceAdd')->name('service_add');
 	Route::get('/service/{id}/edit'	, 'Admin\ServiceController@getServiceEdit')->name('service_edit');
 	Route::get('/service/{id}/delete', 'Admin\ServiceController@getServiceDelete')->name('service_delete');
 	Route::get('/service/{id}/restore', 'Admin\ServiceController@getServiceRestore')->name('service_delete');
 	Route::post('/service/add'		, 'Admin\ServiceController@postServiceAdd')->name('service_add');
 	Route::post('/service/search'	, 'Admin\ServiceController@postServiceSearch')->name('service_search');
 	Route::post('/service/{id}/edit'	, 'Admin\ServiceController@postServiceEdit')->name('service_edit');

 	// Navios
    Route::get('/ships/{status}'	, 'Admin\ShipController@getHome')->name('ships');
 	Route::get('/ship/add'		, 'Admin\ShipController@getShipAdd')->name('ship_add');
 	Route::get('/ship/{id}/edit'	, 'Admin\ShipController@getShipEdit')->name('ship_edit');
 	Route::get('/ship/{id}/delete', 'Admin\ShipController@getShipDelete')->name('ship_delete');
 	Route::get('/ship/{id}/restore', 'Admin\ShipController@getShipRestore')->name('ship_delete');
 	Route::post('/ship/add'		, 'Admin\ShipController@postShipAdd')->name('ship_add');
 	Route::post('/ship/search'	, 'Admin\ShipController@postShipSearch')->name('ship_search');
 	Route::post('/ship/{id}/edit'	, 'Admin\ShipController@postShipEdit')->name('ship_edit');

 	 // Module Transportadoras
 	Route::get('/transportadoras/{status}'	, 'Admin\TransportadoraController@getHome')->name('transportadoras');
 	Route::get('/transportadora/add'		, 'Admin\TransportadoraController@getTransportadoraAdd')->name('transportadora_add');
 	Route::get('/transportadora/{id}/edit'	, 'Admin\TransportadoraController@getTransportadoraEdit')->name('transportadora_edit');
 	Route::get('/transportadora/{id}/delete', 'Admin\TransportadoraController@getTransportadoraDelete')->name('transportadora_delete');
 	Route::get('/transportadora/{id}/restore', 'Admin\TransportadoraController@getTransportadoraRestore')->name('transportadora_delete');
 	Route::post('/transportadora/add'		, 'Admin\TransportadoraController@postTransportadoraAdd')->name('transportadora_add');
 	Route::post('/transportadora/search'	, 'Admin\TransportadoraController@postTransportadoraSearch')->name('transportadora_search');
 	Route::post('/transportadora/{id}/edit'	, 'Admin\TransportadoraController@postTransportadoraEdit')->name('transportadora_edit');


 	// Services
    Route::get('/isos/{status}'	, 'Admin\IsoController@getHome')->name('isos');
 	Route::get('/iso/add'		, 'Admin\IsoController@getIsoAdd')->name('iso_add');
 	Route::get('/iso/{id}/edit'	, 'Admin\IsoController@getIsoEdit')->name('iso_edit');
 	Route::get('/iso/{id}/delete', 'Admin\IsoController@getIsoDelete')->name('iso_delete');
 	Route::get('/iso/{id}/restore', 'Admin\IsoController@getIsoRestore')->name('iso_delete');
 	Route::post('/iso/add'		, 'Admin\IsoController@postIsoAdd')->name('iso_add');
 	Route::post('/iso/search'	, 'Admin\IsoController@postIsoSearch')->name('iso_search');
 	Route::post('/iso/{id}/edit'	, 'Admin\IsoController@postIsoEdit')->name('iso_edit');

 	// Tipo Carga
    Route::get('/tipocargas/{status}'	, 'Admin\TipoCargaController@getHome')->name('tipocargas');
 	Route::get('/tipocarga/add'		, 'Admin\TipoCargaController@getTipoCargaAdd')->name('tipocarga_add');
 	Route::get('/tipocarga/{id}/edit'	, 'Admin\TipoCargaController@getTipoCargaEdit')->name('tipocarga_edit');
 	Route::get('/tipocarga/{id}/delete', 'Admin\TipoCargaController@getTipoCargaDelete')->name('tipocarga_delete');
 	Route::get('/tipocarga/{id}/restore', 'Admin\TipoCargaController@getTipoCargaRestore')->name('tipocarga_delete');
 	Route::post('/tipocarga/add'		, 'Admin\TipoCargaController@postTipoCargaAdd')->name('tipocarga_add');
 	Route::post('/tipocarga/search'	, 'Admin\TipoCargaController@postTipoCargaSearch')->name('tipocarga_search');
 	Route::post('/tipocarga/{id}/edit'	, 'Admin\TipoCargaController@postTipoCargaEdit')->name('tipocarga_edit');


 	// Tipo Carga
    Route::get('/manuseios/{status}'	, 'Admin\ManuseioController@getHome')->name('manuseios');
 	Route::get('/manuseio/add'		, 'Admin\ManuseioController@getManuseioAdd')->name('manuseio_add');
 	Route::get('/manuseio/{id}/edit'	, 'Admin\ManuseioController@getManuseioEdit')->name('manuseio_edit');
 	Route::get('/manuseio/{id}/delete', 'Admin\ManuseioController@getManuseioDelete')->name('manuseio_delete');
 	Route::get('/manuseio/{id}/restore', 'Admin\ManuseioController@getManuseioRestore')->name('manuseio_delete');
 	Route::post('/manuseio/add'		, 'Admin\ManuseioController@postManuseioAdd')->name('manuseio_add');
 	Route::post('/manuseio/search'	, 'Admin\ManuseioController@postManuseioSearch')->name('manuseio_search');
 	Route::post('/manuseio/{id}/edit'	, 'Admin\ManuseioController@postManuseioEdit')->name('manuseio_edit');

 	//Mรณdulo CAPA DE LOTE:
	 Route::get('/capas/{status}', 'Admin\CapaController@getHome')->name('capas');
	 Route::get('/capa/add', 'Admin\CapaController@getCapaAdd')->name('capa_add');
	 Route::post('/capa/add', 'Admin\CapaController@postCapaAdd')->name('capa_add');
	 Route::get('/capa/{id}/edit', 'Admin\CapaController@getCapaEdit')->name('capa_edit');
	 Route::post('/capa/{id}/edit', 'Admin\CapaController@postCapaEdit')->name('capa_edit');
	 Route::get('/capa/{id}/restore', 'Admin\CapaController@getCapaRestore')->name('capa_delete');
	 Route::post('/capa/search', 'Admin\CapaController@postCapaSearch')->name('capa_search');
	 Route::get('/capa/{id}/delete', 'Admin\CapaController@getCapaDelete')->name('capa_delete');
	 Route::get('/capas/{id}/pdf', 'Admin\CapaController@getCapaPdf')->name('capa_pdf');
	 Route::get('/capas/{id}/pdf2', 'Admin\CapaController@getCapaPdf2')->name('capa_pdf2');

	 //Mรณdulo Ticket:
	 Route::get('/tickets/{status}', 'Admin\TicketController@getHome')->name('tickets');
	 Route::get('/ticket/add', 'Admin\TicketController@getTicketAdd')->name('ticket_add');
	 Route::post('/ticket/add', 'Admin\TicketController@postTicketAdd')->name('ticket_add');
	 Route::get('/ticket/{id}/edit', 'Admin\TicketController@getTicketEdit')->name('ticket_edit');
	 Route::post('/ticket/{id}/edit', 'Admin\TicketController@postTicketEdit')->name('ticket_edit');
	 Route::get('/ticket/{id}/restore', 'Admin\TicketController@getTicketRestore')->name('ticket_delete');
	 Route::post('/ticket/search', 'Admin\TicketController@postTicketSearch')->name('ticket_search');
	 Route::get('/ticket/{id}/delete', 'Admin\TicketController@getTicketDelete')->name('ticket_delete');
	 Route::get('/tickets/{id}/pdf', 'Admin\TicketController@getTicketPdf')->name('ticket_pdf');
	 Route::get('/tickets/{id}/pdf2', 'Admin\TicketController@getTicketPdf2')->name('ticket_pdf2');


	 // Bookings
	Route::get('/bookings/{status}', 'Admin\BookingController@getHome')->name('bookings');

    Route::get('/booking/add', 'Admin\BookingController@getBookingAdd')->name('booking_add');
    Route::post('/booking/add', 'Admin\BookingController@postBookingAdd')->name('booking_add');

    Route::get('/booking/{id}/edit', 'Admin\BookingController@getBookingEdit')->name('booking_edit');
    Route::post('/booking/{id}/edit', 'Admin\BookingController@postBookingEdit')->name('booking_edit');
	Route::get('/booking/{id}/delete', 'Admin\BookingController@getBookingDelete')->name('booking_delete');
    Route::get('/booking/{id}/restore', 'Admin\BookingController@getBookingRestore')->name('booking_delete');
    Route::post('/booking/search', 'Admin\BookingController@postBookingSearch')->name('booking_search');

	Route::post('/booking/{id}/gallery/add', 'Admin\BookingController@postBookingGalleryAdd')->name('booking_gallery_add');
    Route::get('/booking/{id}/gallery/{gid}/delete', 'Admin\BookingController@getBookingGalleryDelete')->name('booking_gallery_delete');

	Route::get('/bookings/{id}/pdf', 'Admin\BookingController@getBookingPdf')->name('booking_pdf');
	Route::get('/bookings/{id}/gallery', 'Admin\BookingController@getBookingGallery')->name('booking_gallery');
    Route::get('/booking/excel', 'Admin\BookingController@getBookingExcel')->name('booking_excel');
    Route::post('/booking/excel', 'Admin\BookingController@postBookingExcel')->name('booking_excel');


	//Mรณdulo Rent:
	Route::get('/rents/{status}', 'Admin\RentController@getHome')->name('rents');
	Route::get('/rent/add', 'Admin\RentController@getRentAdd')->name('rent_add');
	Route::post('/rent/add', 'Admin\RentController@postRentAdd')->name('rent_add');
	Route::get('/rent/{id}/edit', 'Admin\RentController@getRentEdit')->name('rent_edit');
	Route::post('/rent/{id}/edit', 'Admin\RentController@postRentEdit')->name('rent_edit');
	Route::get('/rent/{id}/restore', 'Admin\RentController@getRentRestore')->name('rent_delete');
	Route::post('/rent/search', 'Admin\RentController@postRentSearch')->name('rent_search');
	Route::get('/rent/{id}/delete', 'Admin\RentController@getRentDelete')->name('rent_delete');
	Route::get('/rents/{id}/pdf', 'Admin\RentController@getRentPdf')->name('rent_pdf');
	Route::get('/rents/{id}/pdf2', 'Admin\RentController@getRentPdf2')->name('rent_pdf2');

 });
