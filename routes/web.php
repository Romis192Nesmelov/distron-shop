<?php

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AdminContactsController;
use App\Http\Controllers\Admin\AdminContentsController;
use App\Http\Controllers\Admin\AdminIconsController;
use App\Http\Controllers\Admin\AdminItemsController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminMetricsController;
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminQuestionsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminTypesController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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

Route::controller(BaseController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/get-new-csrf', 'getNewCsrf')->name('get_new_csrf');
});

Route::controller(BasketController::class)->group(function () {
    Route::post('/add-to-basket', 'addToBasket')->name('add_to_basket');
    Route::post('/checkout', 'checkout')->name('checkout');
    Route::get('/change-basket', 'changeBasket')->name('change_basket');
});

Route::middleware(['auth'])->controller(OrderController::class)->group(function () {
    Route::post('/new-order', 'newOrder')->name('new_order');
});

Route::controller(FeedbackController::class)->group(function () {
//    Route::post('/feedback', 'feedback')->name('feedback');
    Route::post('/feedback-short', 'feedbackShort')->name('feedback_short');
});

Route::get('/search', SearchController::class)->name('search');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::get('/confirmation-register/{slug}', 'confirmationRegister')->name('confirmation_register');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->controller(AccountController::class)->middleware(['auth'])->group(function () {
    Route::get('/account', 'account')->name('account');
    Route::post('/edit-account', 'editAccount')->name('edit_account');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {return view('admin.login');})->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
    Route::controller(AdminBaseController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });

    Route::controller(AdminUsersController::class)->group(function () {
        Route::get('/users/{slug?}', 'users')->name('users');
        Route::post('/edit-user', 'editUser')->name('edit_user');
        Route::get('/delete-user', 'deleteUser')->name('delete_user');
    });

    Route::controller(AdminSettingsController::class)->group(function () {
        Route::get('/settings', 'settings')->name('settings');
        Route::post('/edit-settings', 'editSettings')->name('edit_settings');
    });

    Route::controller(AdminIconsController::class)->group(function () {
        Route::get('/icons/{slug?}', 'icons')->name('icons');
        Route::post('/edit-icon', 'editIcon')->name('edit_icon');
        Route::get('/delete-icon', 'deleteIcon')->name('delete_icon');
    });

    Route::controller(AdminContentsController::class)->group(function () {
        Route::get('/contents', 'contents')->name('contents');
        Route::post('/edit-content', 'editContent')->name('edit_content');
    });

    Route::controller(AdminQuestionsController::class)->group(function () {
        Route::get('/questions/{slug?}', 'questions')->name('questions');
        Route::post('/edit-question', 'editQuestion')->name('edit_question');
        Route::get('/delete-question', 'deleteQuestion')->name('delete_question');
    });

    Route::controller(AdminContactsController::class)->group(function () {
        Route::get('/contacts', 'contacts')->name('contacts');
        Route::post('/edit-contact', 'editContact')->name('edit_contact');
    });

    Route::controller(AdminMetricsController::class)->group(function () {
        Route::get('/metrics/{slug?}', 'metrics')->name('metrics');
        Route::post('/edit-metric', 'editMetric')->name('edit_metric');
        Route::get('/delete-metric', 'deleteMetric')->name('delete_metric');
    });

    Route::controller(AdminTypesController::class)->group(function () {
        Route::get('/types/{slug?}', 'types')->name('types');
        Route::post('/edit-type', 'editType')->name('edit_type');
        Route::get('/delete-type', 'deleteType')->name('delete_type');
    });

    Route::controller(AdminItemsController::class)->group(function () {
        Route::get('/items/{slug?}', 'items')->name('items');
        Route::post('/edit-item', 'editItem')->name('edit_item');
        Route::get('/delete-item', 'deleteItem')->name('delete_item');
    });

    Route::controller(AdminOrdersController::class)->group(function () {
        Route::get('/orders', 'orders')->name('orders');
        Route::post('/edit-order', 'editOrder')->name('edit_order');
        Route::get('/delete-order', 'deleteOrder')->name('delete_order');
    });
});

Route::get('/{slug?}', ItemController::class)->name('get_items');
