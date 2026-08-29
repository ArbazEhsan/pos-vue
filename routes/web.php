<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustVenController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BarcodeController;
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

Route::get('/', [AuthenticatedSessionController::class, 'checkUserHas']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
/* Company route start */
Route::get('/addCompany',[CompanyController::class, 'index']);
Route::post('/insertCompany',[CompanyController::class, 'store']);
Route::get('/deleteCompany/{id}',[CompanyController::class, 'delete']);
/* Company route end */

/* Category route start */
Route::get('/category/{id}',[CategoryController::class, 'index']);
Route::post('/insertCategory',[CategoryController::class, 'store']);
Route::get('/editCategory/{id}',[CategoryController::class, 'edit']);
Route::post('/updateCategory',[CategoryController::class, 'update']);
Route::get('/deleteCategory/{id}',[CategoryController::class, 'delete']);
Route::get('/statusCategory/{status}/{id}',[CategoryController::class, 'status']);
/* Category route end */

/* Product route start */
Route::get('/addProduct',[ProductController::class, 'fillCategory']);
Route::get('/viewProduct',[ProductController::class, 'index']);
Route::get('/exportProduct',[ProductController::class, 'exportProducts']);
Route::post('/insertProduct',[ProductController::class, 'store']);
Route::get('/editProduct/{id}',[ProductController::class, 'edit']);
Route::post('/updateProduct',[ProductController::class, 'update']);
Route::get('/deleteProduct/{id}',[ProductController::class, 'delete']);
Route::get('/statusProduct/{status}/{id}',[ProductController::class, 'status']);
Route::get('/checkCode/{code}',[ProductController::class, 'checkCode']);
Route::get('/inventoryCheck',[ProductController::class, 'inventoryCheck']);
/* Product route end */

/* CustVen route start */
Route::get('/addCustVen',[CustVenController::class, 'form']);
Route::get('/checkPointCV',[CustVenController::class, 'checkPoint']);
Route::get('/viewCustomer',[CustVenController::class, 'viewCustomer']);
Route::get('/viewVendor',[CustVenController::class, 'viewVendor']);
Route::post('/insertCustVen',[CustVenController::class, 'store']);
Route::get('/editCustVen/{id}',[CustVenController::class, 'edit']);
Route::post('/updateCustVen',[CustVenController::class, 'update']);
Route::get('/deleteCustVen/{id}',[CustVenController::class, 'delete']);
Route::get('/statusCust/{status}/{id}',[CustVenController::class, 'statusCust']);
Route::get('/statusVen/{status}/{id}',[CustVenController::class, 'statusVen']);
/* CustVen route end */

/* Trans route start */
Route::get('/viewTrans',[TransController::class, 'menuTran']);
Route::get('/cashPrint/{id}',[TransController::class, 'cashPrint']);
/* Trans route end */

/* TransIn route start */
Route::get('/addTransIn',[TransController::class, 'fillTransIn']);
Route::get('/viewTransIn',[TransController::class, 'indexTransIn']);
Route::post('/insertTransIn',[TransController::class, 'storeTransIn']);
Route::get('/deleteTransIn/{id}',[TransController::class, 'deleteTransIn']);
/* TransIn route end */

/* TransOut route start */
Route::get('/addTransOut',[TransController::class, 'fillTransOut']);
Route::get('/viewTransOut',[TransController::class, 'indexTransOut']);
Route::post('/insertTransOut',[TransController::class, 'storeTransOut']);
Route::get('/deleteTransOut/{id}',[TransController::class, 'deleteTransOut']);
/* TransOut route end */

/* Stock Opening route start */
Route::get('/viewStockOpening',[ProductController::class, 'viewStock']);
Route::post('/searchStockOpening',[ProductController::class, 'searchStock']);
Route::post('/updateStockOpening',[ProductController::class, 'updateStock']);
/* Stock Opening route end */

/* Countsheet route start */
Route::get('/countsheet',[ProductController::class, 'countsheet']);
Route::get('/searchProduct/{val}',[ProductController::class, 'searchProduct']);
Route::post('/searchProductFor',[ProductController::class, 'searchProductFor']);
Route::get('/searchProductByFilter/{filter}',[ProductController::class, 'searchProductByFilter']);
Route::post('/updateProductQty',[ProductController::class, 'updateProductQty']);
/* Countsheet route end */

/* Bulk price editing route start */
Route::get('/viewBulk',[ProductController::class, 'viewBulk']);
Route::post('/searchBulk',[ProductController::class, 'searchBulk']);
Route::get('/searchBulkByFilter/{filter}',[ProductController::class, 'searchBulkByFilter']);
Route::post('/updateBulk',[ProductController::class, 'updateBulk']);
/* Bulk price editing route end */

/* Re order route start */
Route::get('/viewReorder',[ProductController::class, 'viewReorder']);
/* Re order editing route end */

/* Ledger route start */
Route::get('/checkPoint',[LedgerController::class, 'checkPoint']);
Route::get('/viewCustLedger',[LedgerController::class, 'custForm']);
Route::get('/viewVenLedger',[LedgerController::class, 'venForm']);
Route::post('/Ledger',[LedgerController::class, 'ledger']);
Route::get('/print/{f}/{id}',[LedgerController::class, 'printTrans']);
/* Ledger editing route end */

/* Sale Invoice start */
Route::get('/saleForm',[SaleController::class, 'saleForm']);
Route::get('/searchProduct/{barcode}/{name}/{rowNum}/{from}',[SaleController::class, 'getAllProduct']);
Route::get('/getDetail/{id}/{from}',[SaleController::class, 'getDetail']);
Route::post('/saveInvoice/{barcode}/{qty}/{price}/{finalAmt}/{from}',[SaleController::class, 'saveInvc']);
Route::get('/salePrint/{id}',[SaleController::class, 'sPrint']);
Route::get('/viewSInvoice',[SaleController::class, 'sInvoice']);
Route::get('/getSInvoice',[SaleController::class, 'getSInvoice']);
Route::get('/saleReturn/{id}',[SaleController::class, 'saleReturn']);
/* Sale Invoice route end */

/* Purchase Invoice start */
Route::get('/purchaseForm',[SaleController::class, 'purchaseForm']);
Route::post('/purchaseInvoice/{barcode}/{qty}/{price}/{finalAmt}/{from}',[SaleController::class, 'savePInvc']);
Route::get('/purPrint/{id}',[SaleController::class, 'pPrint']);
Route::get('/viewPInvoice',[SaleController::class, 'pInvoice']);
/* Purchase Invoice route end */

/* Stock Form start */
Route::get('/stockForm',[ProductController::class, 'viewStockForm']);
/* Stock Form route end */

/* user start */
Route::get('/viewProfile',[CustVenController::class, 'viewUser']);
Route::get('/viewUserForm',[CustVenController::class, 'viewUForm']);
Route::get('/userRights/{id}/{name}',[CustVenController::class, 'userRights']);
Route::get('/saveUserRights',[CustVenController::class, 'saveUserRights']);
Route::post('/createUser',[CustVenController::class, 'createUser']);
Route::get('/deleteUser/{id}',[CustVenController::class, 'deleteUser']);
/* user route end */

/* report start */
Route::get('/cashinReport',[ReportController::class, 'cashinReport']);
Route::get('/getCashinReport',[ReportController::class, 'getCashinReport']);
Route::get('/receivableReport',[ReportController::class, 'receivableReport']);
Route::get('/getReceivableReport',[ReportController::class, 'getReceivableReport']);
Route::get('/dayendReport',[ReportController::class, 'dayendReport']);
Route::get('/getDayendReport',[ReportController::class, 'getDayendReport']);
Route::get('/stockReport',[ReportController::class, 'stockReport']);
Route::get('/getStockReport',[ReportController::class, 'getStockReport']);
Route::get('/cashoutReport',[ReportController::class, 'cashoutReport']);
Route::get('/getCashoutReport',[ReportController::class, 'getCashoutReport']);
Route::get('/payableReport',[ReportController::class, 'payableReport']);
Route::get('/getPayableReport',[ReportController::class, 'getPayableReport']);
Route::get('/profitReport',[ReportController::class, 'profitReport']);
Route::get('/dayendDetailReport',[ReportController::class, 'dayendDetailReport']);
Route::get('/getDayendDetailReport',[ReportController::class, 'getDayendDetailReport']);
Route::get('/stockTrack',[ReportController::class, 'stockTrack']);
Route::get('/getStockTrackReport',[ReportController::class, 'getStockTrackReport']);
Route::get('/palReport',[ReportController::class, 'palReport']);
Route::get('/getpalReport',[ReportController::class, 'getpalReport']);
/* report route end */

/* barcode route start */
Route::get('/viewBarcode',[BarcodeController::class, 'viewBarcode']);
Route::post('/createBarcode',[BarcodeController::class, 'createBarcode']);
/* barcode route end */
});