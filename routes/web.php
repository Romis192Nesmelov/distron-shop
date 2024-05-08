<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\Admin\AdminActionsController;
use App\Http\Controllers\Admin\AdminArticlesController;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AdminContactsController;
use App\Http\Controllers\Admin\AdminContentsController;
//use App\Http\Controllers\Admin\AdminIconsController;
use App\Http\Controllers\Admin\AdminIconsController;
use App\Http\Controllers\Admin\AdminImagesController;
use App\Http\Controllers\Admin\AdminItemsController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminMetricsController;
use App\Http\Controllers\Admin\AdminOrdersController;
//use App\Http\Controllers\Admin\AdminQuestionsController;
use App\Http\Controllers\Admin\AdminQuestionsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminSiteMapController;
use App\Http\Controllers\Admin\AdminTypesController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServicesController;
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
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/set-new-password/{token}', 'index')->middleware('guest')->name('password.reset');
    Route::get('/get-new-csrf', 'getNewCsrf')->name('get_new_csrf');
});

Route::get('/search', SearchController::class)->name('search');
Route::get('/items/{slug?}', ItemController::class)->name('items');
Route::get('/services/{slug?}', ServicesController::class)->name('services');
Route::get('/actions/{slug?}', ActionsController::class)->name('actions');
Route::get('/articles/{slug?}', ArticlesController::class)->name('articles');

Route::controller(BasketController::class)->group(function () {
    Route::post('/add-to-basket', 'addToBasket')->name('add_to_basket');
    Route::post('/checkout', 'checkout')->name('checkout');
    Route::get('/change-basket', 'changeBasket')->name('change_basket');
});

Route::middleware(['auth'])->controller(OrderController::class)->group(function () {
    Route::post('/new-order', 'newOrder')->name('new_order');
});

Route::controller(FeedbackController::class)->group(function () {
    Route::post('/feedback', 'feedback')->name('feedback');
    Route::post('/feedback-short', 'feedbackShort')->name('feedback_short');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('guest')->name('auth.login');
    Route::post('/register', 'register')->middleware('guest')->name('auth.register');
    Route::get('/email/verify/{id}/{hash}', 'confirmationRegister')->middleware('guest')->name('verification.verify');
    Route::post('/email/verification-notification', 'verificationNotification')->middleware(['guest', 'throttle:6,1'])->name('verification.send');
    Route::post('/reset-password', 'resetPassword')->middleware('guest')->name('auth.reset_password');
    Route::post('/set-new-password', 'setNewPassword')->middleware('guest')->name('auth.set_new_password');
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
        Route::post('/delete-user', 'deleteUser')->name('delete_user');
    });

    Route::controller(AdminSettingsController::class)->group(function () {
        Route::get('/settings', 'settings')->name('settings');
        Route::post('/edit-settings', 'editSettings')->name('edit_settings');
    });

    Route::controller(AdminIconsController::class)->group(function () {
        Route::get('/icons/{slug?}', 'icons')->name('icons');
        Route::post('/edit-icon', 'editIcon')->name('edit_icon');
        Route::post('/delete-icon', 'deleteIcon')->name('delete_icon');
    });

    Route::controller(AdminContentsController::class)->group(function () {
        Route::get('/contents', 'contents')->name('contents');
        Route::post('/edit-content', 'editContent')->name('edit_content');
    });

    Route::controller(AdminActionsController::class)->group(function () {
        Route::get('/actions/{slug?}', 'actions')->name('actions');
        Route::post('/edit-action', 'editAction')->name('edit_action');
        Route::post('/delete-action', 'deleteActions')->name('delete_action');
    });

    Route::controller(AdminQuestionsController::class)->group(function () {
        Route::get('/questions/{slug?}', 'questions')->name('questions');
        Route::post('/edit-question', 'editQuestion')->name('edit_question');
        Route::post('/delete-question', 'deleteQuestion')->name('delete_question');
    });

    Route::controller(AdminContactsController::class)->group(function () {
        Route::get('/contacts', 'contacts')->name('contacts');
        Route::post('/edit-contacts-seo', 'editContactsSeo')->name('edit_contacts_seo');
        Route::post('/edit-contact', 'editContact')->name('edit_contact');
    });

    Route::controller(AdminMetricsController::class)->group(function () {
        Route::get('/metrics/{slug?}', 'metrics')->name('metrics');
        Route::post('/edit-metric', 'editMetric')->name('edit_metric');
        Route::post('/delete-metric', 'deleteMetric')->name('delete_metric');
    });

    Route::controller(AdminTypesController::class)->group(function () {
        Route::get('/types/{slug?}', 'types')->name('types');
        Route::post('/edit-type', 'editType')->name('edit_type');
        Route::post('/edit-products-seo', 'editProductsSeo')->name('edit_products_seo');
    });

    Route::controller(AdminItemsController::class)->group(function () {
        Route::get('/items/{slug?}', 'items')->name('items');
        Route::post('/edit-item', 'editItem')->name('edit_item');
        Route::post('/delete-item', 'deleteItem')->name('delete_item');
    });

    Route::controller(AdminOrdersController::class)->group(function () {
        Route::get('/orders', 'orders')->name('orders');
        Route::post('/edit-order', 'editOrder')->name('edit_order');
        Route::post('/delete-order', 'deleteOrder')->name('delete_order');
    });

    Route::controller(AdminArticlesController::class)->group(function () {
        Route::get('/articles/{slug?}', 'articles')->name('articles');
        Route::post('/edit-articles-seo', 'editArticleSeo')->name('edit_article_seo');
        Route::post('/edit-article', 'editArticle')->name('edit_article');
        Route::post('/delete-article', 'deleteArticle')->name('delete_article');
    });

    Route::controller(AdminImagesController::class)->group(function () {
        Route::get('/images/{slug?}', 'images')->name('images');
        Route::post('/edit-image', 'editImage')->name('edit_image');
        Route::post('/delete-image', 'deleteImage')->name('delete_image');
    });

    Route::controller(AdminSiteMapController::class)->group(function () {
        Route::get('/sitemap', 'siteMap')->name('sitemap');
        Route::post('/generate-site-map', 'generateSiteMap')->name('generate_site_map');
    });
});
Route::get('/{slug?}', ContentController::class)->name('content');
