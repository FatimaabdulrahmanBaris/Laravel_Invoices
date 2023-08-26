<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Invoices_reportController;
use App\Http\Controllers\Customer_ReportController;
use App\Http\Controllers\DashbordController;







use Illuminate\Support\Facades\Auth;
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
// Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', function () {
//     return view('index');
// });
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[DashbordController::class,'index'])->name('dashboard');
});
// Auth::route(['register'=>false]);
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');
 });
Route::resource('invoices',InvoicesController::class);
Route::resource('InvoiceAttachment',InvoicesAttachmentsController::class);
Route::resource('section',SectionController::class);
Route::resource('Products',ProductsController::class);
Route::get('/section_view/{id}',[InvoicesController::class,'getproducts']);


Route::get('/InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
Route::get('view_file/{invoices_number}/{file_name}',[InvoicesDetailsController::class,'open_file']);
Route::get('download/{invoices_number}/{file_name}',[InvoicesDetailsController::class,'get_file']);


Route::get('/edit_invoice/{id}',[InvoicesController::class,'edit']);
Route::get('/status_show/{id}',[InvoicesController::class,'show'])->name('status_show');
Route::post('/status_update/{id}',[InvoicesController::class,'status_update'])->name('status_update');
Route::get('Invoices_paid',[InvoicesController::class,'Invoices_paid'])->name('Invoices_paid');
Route::get('Invoices_unpaid',[InvoicesController::class,'Invoices_unpaid'])->name('Invoices_unpaid');
Route::get('Invoices_partial',[InvoicesController::class,'Invoices_partial'])->name('Invoices_partial');
Route::resource('Archive_Invoices',InvoicesArchiveController::class);
Route::get('Print_invoice/{id}',[InvoicesController::class,'print_invoice']);
Route::get('exportinvoices',[InvoicesController::class,'export']);
//permission
Route::group(['middleware' => ['auth']], function() {

    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
});

Route::get('invoice_report',[Invoices_reportController::class,'index']);
Route::post('Search_invoices', [Invoices_reportController::class,'Search_invoices']);

Route::get('customer_report',[Customer_ReportController::class,'index']);
Route::post('Search_customers', [Invoices_reportController::class,'Search_customers']);

Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');
Route::get('/MarkAsRead_one/{id}',[InvoicesController::class,'MarkAsRead_one']);




// Route::get('view_file/{invoices_number}/{file_name}',[InvoicesDetailsController::class,'open_file']);
// Route::get('view_file',[InvoicesDetailsController::class,'open_file']);
Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('/{page}', [AdminController::class, 'index']);
