<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware and 'inventory' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */


Route::admin('inventory', function () {

    //lazada
    Route::get('lazada', 'Items@lazada')->name('items.lazada');
    Route::get('lazada/auth', 'Items@lazada_auth')->name('items.lazada_auth');
    Route::get('lazada/lazada_items', 'Lazada@lazada_items')->name('items.lazada_items');
    Route::get('lazada/lazada_orders', 'Lazada@lazada_orders')->name('items.lazada_orders');

    //shopee
    Route::get('shopee', 'Items@shopee')->name('items.shopee');
    Route::get('shopee/auth', 'Items@shopee_auth')->name('items.shopee_auth');
    Route::get('shopee/shopee_items', 'Shopee@shopee_items')->name('items.shopee_items');
    Route::get('shopee/shopee_orders', 'Shopee@shopee_orders')->name('items.shopee_orders');

    //stock 
    Route::get('stock', 'Stock@stock_index')->name('items.stock');
    Route::get('stock/create', 'Stock@create')->name('items.stock_create');
    Route::post('stock/store', 'Stock@stock_store')->name('items.stock_store');

    //stock in
    Route::get('stock_in', 'Stock@Stock_in')->name('items.stock_in');
    Route::get('stock_in/stock_in_create', 'Stock@stock_in_create')->name('items.stock_in_create');
    Route::post('stock_in/stock_in_store', 'Stock@stock_in_store')->name('items.stock_in_store');

    //stock out
    Route::get('stock_out', 'Stock@Stock_out')->name('items.stock_out');
    Route::get('stock_out/stock_out_create', 'Stock@stock_out_create')->name('items.stock_out_create');
    Route::post('stock_out/stock_out_store', 'Stock@stock_out_store')->name('items.stock_out_store');

    //stock take
    Route::get('stock_take', 'Stock@Stock_take')->name('items.stock_take');

    // Items
    Route::post('items/import', 'Items@import')->name('items.import');
    Route::get('items/export', 'Items@export')->name('items.export');
    Route::get('items/{item}/enable', 'Items@enable')->name('item-groups.enable');
    Route::get('items/{item}/disable', 'Items@disable')->name('item-groups.disable');
    Route::resource('items', 'Items');

    //Item-groups
    Route::get('item-groups/autocomplete', 'ItemGroups@autocomplete')->name('item-groups.autocomplete');
    Route::get('item-groups/addItem', 'ItemGroups@addItem')->name('item-groups.add-item');
    Route::get('item-groups/addOption', 'ItemGroups@addOption')->name('item-groups.add-option');
    Route::get('item-groups/getOptionValues/{option_id}', 'ItemGroups@getOptionValues')->name('item-groups.get-option-values');
    Route::get('item-groups/{item_group}/duplicate', 'ItemGroups@duplicate')->name('item-groups.duplicate');
    Route::post('item-groups/import', 'ItemGroups@import')->name('item-groups.import');
    Route::get('item-groups/export', 'ItemGroups@export')->name('item-groups.export');
    Route::get('item-groups/{item_group}/enable', 'ItemGroups@enable')->name('item-groups.enable');
    Route::get('item-groups/{item_group}/disable', 'ItemGroups@disable')->name('item-groups.disable');
    Route::resource('item-groups', 'ItemGroups', ['middleware' => ['money']]);

    // Options
    Route::get('options/{option}/duplicate', 'Options@duplicate')->name('options.duplicate');
    Route::post('options/import', 'Options@import')->name('options.import');
    Route::get('options/export', 'Options@export')->name('options.export');
    Route::get('options/{option}/enable', 'Options@enable')->name('options.enable');
    Route::get('options/{option}/disable', 'Options@disable')->name('options.disable');
    Route::resource('options', 'Options');

    // Manufacturers
    Route::get('manufacturers/{manufacturer}/duplicate', 'Manufacturers@duplicate')->name('manufacturers.duplicate');
    Route::post('manufacturers/import', 'Manufacturers@import')->name('manufacturers.import');
    Route::get('manufacturers/export', 'Manufacturers@export')->name('manufacturers.export');
    Route::get('manufacturers/{manufacturer}/enable', 'Manufacturers@enable')->name('manufacturers.enable');
    Route::get('manufacturers/{manufacturer}/disable', 'Manufacturers@disable')->name('manufacturers.disable');
    Route::resource('manufacturers', 'Manufacturers');

    // Transfer Orders
    Route::get('getItemQuantity', 'TransferOrders@getItemQuantity')->name('transfer-orders.source-item');
    Route::get('getSourceItem', 'TransferOrders@getSourceItem')->name('transfer-orders.source-item');
    Route::get('getSource', 'TransferOrders@getSource')->name('transfer-orders.source');
    Route::resource('transfer-orders', 'TransferOrders');

    // Warehouses
    Route::get('warehouses/{warehouse}/duplicate', 'Warehouses@duplicate')->name('warehouses.duplicate');
    Route::post('warehouses/import', 'Warehouses@import')->name('warehouses.import');
    Route::get('warehouses/export', 'Warehouses@export')->name('warehouses.export');
    Route::get('warehouses/{warehouse}/enable', 'Warehouses@enable')->name('warehouses.enable');
    Route::get('warehouses/{warehouse}/disable', 'Warehouses@disable')->name('warehouses.disable');
    Route::resource('warehouses', 'Warehouses');

    //Histories
    Route::get('histories/print', 'Histories@print')->name('histories.print');
    Route::get('histories/export', 'Histories@export')->name('histories.export');
    Route::resource('histories', 'Histories');

    Route::get('invoice/item/autocomplete', 'Items@autocomplete')->name('invoice.item.autocomplete');
    Route::get('bill/item/autocomplete', 'Items@autocomplete')->name('bill.item.autocomplete');

    //Settings
    Route::get('settings', 'Settings@edit')->name('settings.edit');
    Route::post('settings', 'Settings@update')->name('settings.update');
});

