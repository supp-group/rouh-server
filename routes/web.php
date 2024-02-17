<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\InputController;
use App\Http\Controllers\Web\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\ExpertController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\PointController;
use App\Http\Controllers\Web\ExpertsServiceController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Api\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});



//Route::get('/', [AuthenticatedSessionController::class, 'create']);
/*
Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::resource('notify', NotificationController::class, ['except' => ['update']]);
    Route::post('saveToken', [NotificationController::class, 'saveToken']);
    Route::post('sendNotification', [NotificationController::class, 'sendNotification']);

    Route::middleware('role.admin:admin')->group(function () {

        // Route::prefix('user')->group(function () {
        //     Route::get('', [UserController::class, 'index'])->name('admin.user.show');
        //     Route::get('/add', [UserController::class, 'create']);
        //     Route::post('/store', [UserController::class, 'store']);
        //     Route::get('/edit/{id}', [UserController::class, 'edit']);
        //     Route::post('/update/{id}', [UserController::class, 'update']);
        //     Route::get('/delete/{id}', [UserController::class, 'destroy']);
        // });

        Route::resource('user', UserController::class, ['except' => ['update']]);
        Route::prefix('user')->group(function () {
            Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        });
        Route::resource('point', PointController::class, ['except' => ['update']]);
        Route::prefix('point')->group(function () {
            Route::post('/update/{id}', [PointController::class, 'update'])->name('point.update');
        });
        Route::resource('setting', SettingController::class, ['except' => ['update']]);
        Route::prefix('setting')->group(function () {
            Route::post('/update/{id}', [SettingController::class, 'update'])->name('setting.update');
            Route::post('/updatepercent/{id}', [SettingController::class, 'updatepercent']);
            Route::post('/updatepoints/{id}', [SettingController::class, 'updatepoints']);

        });
    });

    Route::middleware('role.admin:admin-super')->group(function () {

        // expert
        // Route::prefix('/expert')->group(function () {
        // Route::get('', [ExpertController::class, 'index'])->name('admin.expert.show');
        //     Route::get('/add', [ExpertController::class, 'create']);
        //     Route::post('/store', [ExpertController::class, 'store']);
        //     Route::get('/edit/{id}', [ExpertController::class, 'edit']);
        //     Route::post('/update/{id}', [ExpertController::class, 'update']);
        //     Route::get('/delete/{id}', [ExpertController::class, 'destroy']);
        // });
        Route::resource('expert', ExpertController::class, ['except' => ['update']]);
        Route::prefix('expert')->group(function () {
            Route::post('/update/{id}', [ExpertController::class, 'update'])->name('expert.update');
        });

        Route::resource('client', ClientController::class, ['except' => ['update']]);
        Route::prefix('client')->group(function () {
            Route::post('/update/{id}', [ClientController::class, 'update'])->name('client.update');
        });

        Route::resource('service', ServiceController::class, ['except' => ['update']]);
        Route::prefix('service')->group(function () {
            Route::post('/update/{id}', [ServiceController::class, 'update'])->name('service.update');
            Route::post('/savepersonal/{id}', [ServiceController::class, 'savepersonal']);
            Route::post('/saveimgrecord/{id}', [ServiceController::class, 'saveimgrecord']);
            Route::post('/savefield/{id}', [ServiceController::class, 'savefield']);
            Route::get('/showinputs/{id}', [ServiceController::class, 'showinputs']);

            //عرض النسب
            Route::get('/percent/show', [ServiceController::class, 'showpercent']);
            //حفظ النسبة
            Route::post('/percent/save/{id}', [ServiceController::class, 'percentsave']);
            //عرض نسبة الخدمة حسب ال id modal
            Route::get('/percent/edit/{id}', [ServiceController::class, 'percentedit']);
            //عرض الخبراء المقدمين للخدمات
            Route::get('/expert/show', [ServiceController::class, 'showexpert']);
            Route::get('/expert/showselected/{id}', [ServiceController::class, 'showselected']);

            Route::post('/expert/deleteselected/{id}', [ExpertsServiceController::class, 'deleteselected']);
            Route::get('/expert/edit/{id}', [ServiceController::class, 'editexpert'])->name('service.expert.edit');
            // حفظ الخبير
            Route::post('/expert/save/{id}', [ServiceController::class, 'expertsave']);
            // points
            //عرض النقاط في ال modal  حسب ال id
            Route::get('/point/edit/{id}', [ServiceController::class, 'pointedit']);
            //حفظ النقاط
            Route::post('/point/save/{id}', [ServiceController::class, 'pointsave']);
        });
        Route::prefix('input')->group(function () {
            Route::get('/delete/{id}', [InputController::class, 'destroy']);
            Route::get('/edit/{id}', [InputController::class, 'edit']);
            Route::post('/update/{id}', [InputController::class, 'update']);
        });
        //الطلبات
        Route::resource('order', OrderController::class, ['except' => ['update']]);
        Route::prefix('order')->group(function () {          
            Route::post('/update/{id}', [OrderController::class, 'update'])->name('order.update');
        });
    });
    /*
    Route::middleware('role.admin:super')->group(function () {

        // expert
   Route::prefix('/expert')->group(function () {
       Route::get('', [ExpertController::class, 'index'])->name('admin.expert.show');

   });

   });
*/
});
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
require __DIR__ . '/auth.php';
