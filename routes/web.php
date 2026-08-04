<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ScanDataController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MatrialMovementController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkOrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
date_default_timezone_set("Asia/Kolkata"); 
Route::get('/', function () {     return view('login/login'); });
Route::any('/admin', function (Request $request) {
    if ($request->session()->exists('createdby_id')) 
    {
        return DashboardController::dashboardView();
         
        }else 
    {         return view('login');     }     
});
Route::any('/admin_1', function (Request $request) {
    if ($request->session()->exists('createdby_id')) 
    {        return view('welcome_1');     }else 
    {        return view('login');    }    
});
Route::any('/changePasswordForm',[LoginController::class,'changePasswordForm'])->name('changePasswordForm');
Route::any('/updateNewPassword',[LoginController::class,'updateNewPassword'])->name('updateNewPassword');
Route::any('/header', function () {     return view('header'); });
Route::any('/scan', function () { return view('/scan/scan'); });
Route::any('/reports',  [ProductsController::class,'reports'])->name('reports');
Route::any('/binStock', [InvoiceController::class,'binStock'])->name('binStock');

Route::any('/releaseLockBinStock', [InvoiceController::class,'releaseLockBinStock'])->name('releaseLockBinStock');

Route::any('/invoice', [InvoiceController::class,'invoiceList']);
Route::post('/getPeriodInvoiceList', [InvoiceController::class,'getPeriodInvoiceList'])->name('getPeriodInvoiceList');
Route::post('/getPeriodWorkOrderList', [InvoiceController::class,'getPeriodWorkOrderList'])->name('getPeriodWorkOrderList');

Route::any('/workOrder', [InvoiceController::class,'workOrder']);
Route::post('/dashboard', function () {     return view('dashboard');  });
Route::any('/getDashboardView', [DashboardController::class,'getDashboardView'])->name('getDashboardView');
Route::any('/mapStockToInvoice', [InvoiceController::class,'mapStockToInvoice'])->name('mapStockToInvoice');
Route::any('/confirmMappStkToInvoice', [InvoiceController::class,'confirmMappStkToInvoice'])->name('confirmMappStkToInvoice');
Route::any('/confirmMappStkToInvoiceDirect', [InvoiceController::class,'confirmMappStkToInvoiceDirect'])->name('confirmMappStkToInvoiceDirect');


Route::any('/prepareInvoiceItems', [InvoiceController::class,'prepareInvoiceItems'])->name('prepareInvoiceItems');
Route::any('/getBinStockMappedToInvoice', [InvoiceController::class,'getBinStockMappedToInvoice'])->name('getBinStockMappedToInvoice');
Route::any('/getBinStockMappedToInvoiceDirect', [InvoiceController::class,'getBinStockMappedToInvoiceDirect'])->name('getBinStockMappedToInvoiceDirect');

Route::any('/amend_packing', [InvoiceController::class,'amend_packing'])->name('amend_packing');
Route::post('/update_amended', [InvoiceController::class,'update_amended'])->name('update_amended');
Route::any('/prepareWorkOrderType', [InvoiceController::class,'prepareWorkOrderType'])->name('prepareWorkOrderType');
Route::any('/prepareWorkOrderByPartScan', [InvoiceController::class,'prepareWorkOrderByPartScan'])->name('prepareWorkOrderByPartScan');
Route::any('/prepareWorkOrderByPrimaryScan', [InvoiceController::class,'prepareWorkOrderByPrimaryScan'])->name('prepareWorkOrderByPrimaryScan');
Route::any('/prepareWorkOrderBySecondaryScan', [InvoiceController::class,'prepareWorkOrderBySecondaryScan'])->name('prepareWorkOrderBySecondaryScan');



Route::any('/cancellPrimaryPacked', [InvoiceController::class,'cancellPrimaryPackedConfirm'])->name('cancellPrimaryPacked');
Route::any('/cancellSecondaryPacked', [InvoiceController::class,'cancellSecondaryPackedConfirm'])->name('cancellSecondaryPacked');
Route::post('/delete_Package_primary',[InvoiceController::class,'delete_Package_primary'])->name('delete_Package_primary');
Route::post('/delete_Package_secondary',[InvoiceController::class,'delete_Package_secondary'])->name('delete_Package_secondary');
Route::any('/updateScannedCode', [InvoiceController::class,'updateScannedCode'])->name('updateScannedCode');
Route::any('/updateScannedSecondaryCode', [InvoiceController::class,'updateScannedSecondaryCode'])->name('updateScannedSecondaryCode');
Route::any('/updateScannedPrimaryCode', [InvoiceController::class,'updateScannedPrimaryCode'])->name('updateScannedPrimaryCode');

Route::any('/getScannedValueDetails', [InvoiceController::class,'getScannedValueDetails'])->name('getScannedValueDetails');


Route::any('/openUpdateHeatCode', [InvoiceController::class,'openUpdateHeatCode'])->name('openUpdateHeatCode');
Route::post('/updateHeatCode', [InvoiceController::class,'updateHeatCode'])->name('updateHeatCode');

Route::any('/printInvoiceDetails',[InvoiceController::class,'printInvoiceDetails'])->name('printInvoiceDetails');


Route::any('/users', [UsersController::class,'list'] );
Route::any('/editUser',[UsersController::class,'edit'])->name('editUser'); ;
Route::any('/disableUser',[UsersController::class,'disable'])->name('disableUser'); ;
Route::any('/enableUser',[UsersController::class,'enable'])->name('enableUser'); ;
Route::any('/addUser',function () { return view('users/add'); } ); 
Route::post('/insert_user',[UsersController::class,'insert_user'])->name('insert_user');
Route::any('/update_user',[UsersController::class,'update_user'])->name('update_user');



Route::any('/product', [ProductsController::class,'list'] );
Route::any('/editProduct',[ProductsController::class,'edit'])->name('editProduct'); 
Route::any('/disableProduct',[ProductsController::class,'disable'])->name('disableProduct'); ;
Route::any('/enableProduct',[ProductsController::class,'enable'])->name('enableProduct'); ;
Route::any('/addProduct',function () { return view('products/add'); } ); 
Route::post('/insert_product',[ProductsController::class,'insert_product'])->name('insert_product');
Route::any('/update_product',[ProductsController::class,'update_product'])->name('update_Product');


Route::post('/LoginAuthendicate',[LoginController::class,'LoginAuthendicate'])->name('LoginAuthendicate');
Route::any('/logout',[LoginController::class,'logout']);;
Route::get('/scanData_update', [ScanDataController::class,'update'])->name('ScanData.update');

//barcode
Route::any('/barcode',[BarcodeController::class,'index'])->name('barcode.index');
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Route::any('/primaryLablePrint',[InvoiceController::class,'primaryLablePrint'])->name('primaryLablePrint');
Route::any('/secondaryLablePrint',[InvoiceController::class,'secondaryLablePrint'])->name('secondaryLablePrint');
Route::any('/printMasterLabel',[InvoiceController::class,'printMasterLabel'])->name('printMasterLabel');

Route::any('/master',[InvoiceController::class,'master'])->name('master');
Route::any('/secondary',[InvoiceController::class,'secondary'])->name('secondary');
Route::any('/master_barcode',[InvoiceController::class,'master_barcode'])->name('master_barcode');
Route::any('/secondary_barcode',[InvoiceController::class,'secondary_barcode'])->name('secondary_barcode');

Route::any('/getReport',[InvoiceController::class,'getReport'])->name('getReport');

Route::any('/locations', [StoreController::class,'locationsList']);
Route::post('/addLocationsForm',[StoreController::class,'addLocationsForm'])->name('addLocationsForm');
Route::post('/insertLocation', [StoreController::class,'insertLocation'])->name('insertLocation');
Route::post('/enableLocation', [StoreController::class,'enableLocation'])->name('enableLocation');
Route::post('/disableLocation', [StoreController::class,'disableLocation'])->name('disableLocation');
Route::post('/editLocation', [StoreController::class,'editLocation'])->name('editLocation');
Route::post('/updateLocation', [StoreController::class,'updateLocation'])->name('updateLocation');


Route::any('/racks', [StoreController::class,'racksList']);
Route::post('/addRacksForm',[StoreController::class,'addRacksForm'])->name('addRacksForm');
Route::post('/insertRack', [StoreController::class,'insertRack'])->name('insertRack');
Route::post('/enableRack', [StoreController::class,'enableRack'])->name('enableRack');
Route::post('/disableRack', [StoreController::class,'disableRack'])->name('disableRack');
Route::post('/editRack', [StoreController::class,'editRack'])->name('editRack');
Route::post('/updateRack', [StoreController::class,'updateRack'])->name('updateRack');

Route::post('/getBinsByLocation', [StoreController::class,'getBinsByLocation'])->name('getBinsByLocation');
Route::any('/updateSecondaryToBinstock', [InvoiceController::class,'updateSecondaryToBinstock'])->name('updateSecondaryToBinstock');
Route::any('/updatePrimaryToBinstock', [InvoiceController::class,'updatePrimaryToBinstock'])->name('updatePrimaryToBinstock');
Route::any('/viewBinStock', [InvoiceController::class,'viewBinStock'])->name('viewBinStock');


Route::any('/materialReceive', [MatrialMovementController::class,'materialReceive']);
Route::any('/internalTransfer', [MatrialMovementController::class,'internalTransfer']);
Route::any('/materiaIssue', [MatrialMovementController::class,'materiaIssue']);

////////////XLS Files  operations
Route::any('/autoAddInvoiceTriggered',[InvoiceController::class,'autoAddInvoiceTriggered'])->name('autoAddInvoiceTriggered');
Route::any('/autoAddWorkOrderTriggered',[WorkOrderController::class,'autoAddWorkOrderTriggered'])->name('autoAddWorkOrderTriggered');

Route::any('/manualInvoiceFileUpload',[InvoiceController::class,'manualInvoiceFileUpload'])->name('manualInvoiceFileUpload');
Route::any('/upload_invoice_file_manual',[InvoiceController::class,'upload_invoice_file_manual'])->name('upload_invoice_file_manual');

Route::any('/deliveryOut',[InvoiceController::class,'deliveryOut'])->name('deliveryOut');


//////Batch/crown files to create 

//to move excel files from SAP to This s\\
//  http://localhost/cronjob_ipRings_invoice.php


// to import from EXcel to Database 
//   http://localhost/IPRings/importExcelInvoice


//excel import batches
Route::any('/importExcelInvoice',[ImportExcelController::class,'importInvoice'])->name('importExcelInvoice');;
Route::any('/importWorkOrders',[ImportExcelController::class,'importWorkOrders'])->name('importWorkOrders');;
Route::any('/mapStockToInvoiceDirect', [InvoiceController::class,'mapStockToInvoiceDirect'])->name('mapStockToInvoiceDirect');
