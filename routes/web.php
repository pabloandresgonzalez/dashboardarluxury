<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login'); // view('welcome');
});

Route::get('/consulta', [App\Http\Controllers\ConsultId::class, 'index'])->name('consulta');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/escritorio', [App\Http\Controllers\HomeController::class, 'indexEscritorio'])->name('escritorio');

//Users perfil
Route::get('/user/indexperfil', [App\Http\Controllers\admin\UserController::class, 'indexperfil']);
Route::put('/user/{user}/editperfil', [App\Http\Controllers\admin\UserController::class, 'editperfil']);//form edit
// Route::post('/user', [App\Http\Controllers\admin\UserController::class, 'storeperfil']);// envio form
Route::put('/user/updateuser/{user}', [App\Http\Controllers\admin\UserController::class, 'updateuser'])->name('updateuser');//envio form
Route::get('/user/avatar/{filename?}', [App\Http\Controllers\admin\UserController::class, 'getImage'])->name('user.avatar');
Route::get('/user/avatardoc/{filename?}', [App\Http\Controllers\admin\UserController::class, 'getImageDoc'])->name('user.avatardoc');
Route::get('/user/{user}/detail', [App\Http\Controllers\admin\UserController::class, 'detail']);//detalle 

//Membresias
Route::get('/membresiasuser', [App\Http\Controllers\MembresiaController::class, 'indexuser'])->name('membresiasuser');


//Memberchip
Route::get('/membership/create', [App\Http\Controllers\UserMembershipController::class, 'create']);
Route::post('/membership', [App\Http\Controllers\UserMembershipController::class, 'store']);
Route::get('/membership/mismembership', [App\Http\Controllers\UserMembershipController::class, 'indexUserMemberships'])->name('mismembership'); 
Route::get('/pagos{id}', [App\Http\Controllers\UserMembershipController::class, 'pagos'])->name('membership.pagos');
Route::get('/membership/{membership}', [App\Http\Controllers\UserMembershipController::class, 'editrenovar']);
Route::put('/membershiprenovar/{membership}', [App\Http\Controllers\UserMembershipController::class, 'renovar']);
Route::get('/membership/{membership}/detail', [App\Http\Controllers\UserMembershipController::class, 'detail']);//detalle


//News
Route::get('/newsuser', [App\Http\Controllers\NewsController::class, 'indexuser']);
Route::get('/news/avatar/{filename?}', [App\Http\Controllers\NewsController::class, 'getImagevideo'])->name('new.avatar');


//NetworkTransaction
Route::get('/networktransaction', [App\Http\Controllers\NetworkTransactionController::class, 'index'])->name('networktransaction');
Route::get('/networktransactionactivacion', [App\Http\Controllers\NetworkTransactionController::class, 'indexactivacion'])->name('networktransactionactivacion');

//traslados
Route::get('traslado', [App\Http\Controllers\admin\UserController::class, 'indextraslado'])->name('traslado');

//Wallet_Transactions
Route::get('/wallet', [App\Http\Controllers\WalletTransactionsController::class, 'index'])->name('wallet');
Route::post('/wallet', [App\Http\Controllers\WalletTransactionsController::class, 'store']);




Route::middleware(['auth', 'admin'])->group(function () {

    //Users
    Route::get('/user', [App\Http\Controllers\admin\UserController::class, 'index']);
    Route::get('/user/create', [App\Http\Controllers\admin\UserController::class, 'create']);//form create
    Route::post('/user', [App\Http\Controllers\admin\UserController::class, 'store']);// envio form    
    Route::get('/user/{user}/edit', [App\Http\Controllers\admin\UserController::class, 'edit']); //form edit
    Route::put('/user/{user}', [App\Http\Controllers\admin\UserController::class, 'update']);//envio form
    Route::get('/users/export-excel', [App\Http\Controllers\admin\UserController::class, 'exportExcel']);


    //Membresias
    Route::get('/membresias', [App\Http\Controllers\MembresiaController::class, 'index'])->name('membresias');    
    Route::get('/membresias/create', [App\Http\Controllers\MembresiaController::class, 'create']);//form create
    Route::post('/membresias', [App\Http\Controllers\MembresiaController::class, 'store']);// envio form
    Route::get('/membresias/{membresias}/edit', [App\Http\Controllers\MembresiaController::class, 'edit']); //form edit
    Route::put('/membresias/{membresias}', [App\Http\Controllers\MembresiaController::class, 'update']);//envio form
    Route::get('/membresias/{membresias}/detail', [App\Http\Controllers\MembresiaController::class, 'detail']);//detalle


    //Memberchip
    Route::get('/membership', [App\Http\Controllers\UserMembershipController::class, 'index']);     
    Route::get('/membership/{membership}/edit', [App\Http\Controllers\UserMembershipController::class, 'edit']);       
    Route::put('/membership/{membership}', [App\Http\Controllers\UserMembershipController::class, 'update']);    
    Route::get('/orden/{id}', [App\Http\Controllers\UserMembershipController::class, 'orden'])->name('prestamo.orden');
    Route::get('/membership/avatar/{filename?}', [App\Http\Controllers\UserMembershipController::class, 'getImage'])->name('prestamo.avatar');
    Route::get('/memberships/export-excel', [App\Http\Controllers\UserMembershipController::class, 'exportExcel']);


    //News
    Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);
    Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create']); //form registro
    Route::get('/news/{new}/edit', [App\Http\Controllers\NewsController::class, 'edit']);
    Route::post('/news', [App\Http\Controllers\NewsController::class, 'store']); // envio form    
    Route::put('/news/{new}', [App\Http\Controllers\NewsController::class, 'update']);
    

    //Wallets
    Route::get('/walletadmin', [App\Http\Controllers\WalletTransactionsController::class, 'indexAdmin'])->name('walletadmin');     
    Route::get('/wallet/{wallet}/edit', [App\Http\Controllers\WalletTransactionsController::class, 'edit']);
    Route::put('/wallet/{wallet}', [App\Http\Controllers\WalletTransactionsController::class, 'update']);
    Route::get('/wallets/export-excel', [App\Http\Controllers\WalletTransactionsController::class, 'exportExcel']);
    Route::get('/walletsaldos', [App\Http\Controllers\WalletTransactionsController::class, 'editsaldos'])->name('walletsaldos'); 
    Route::put('/wallets/asaldo', [App\Http\Controllers\WalletTransactionsController::class, 'storeAdmin']);
    
    
});

    



    
    


    



    







