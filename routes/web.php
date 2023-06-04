<?php

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.perform');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@show')->name('login.show');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout.perform');
});

//staff
Route::prefix('user')
    ->middleware(['auth', 'isUser'])
    ->group(function () {
        Route::controller(App\Http\Controllers\FeedbackController::class)->group(function () {
            Route::get('feedback/select_branch', 'select_branch_view')->name('feedback_select_branch');
            Route::get('/feedback/add/{id}', 'add_view')->name('feedback_add_view');
            Route::post('/feedback/add_done', 'add')->name('feedback_add');
            Route::get('feedback/index', 'index')->name('feedback_index');
            Route::get('feedback/my_feedback', 'myFeedback')->name('my_feedback');
            Route::get('feedback/edit_feedback/{id}', 'editFeedback')->name('edit_feedback');
            Route::post('feedback/edit_done', 'updateFeedback')->name('update_feedback');
            Route::post('feedback/index', 'searchFeedback')->name('search_feedback');
        });
    });
Route::controller(App\Http\Controllers\CommentController::class)->group(function () {
    Route::get('feedback/comment/{id}', 'indexComment')->name('feedback_index_comment');
    Route::post('feedback/comment_create', 'addComment')->name('add_comment');
});

//agent
Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::controller(App\Http\Controllers\FeedbackController::class)->group(function () {
            Route::get('feedback/index/complete', 'feedbackIndexComplete')->name('feedback_index_complete');
        });
    });

//admin
Route::prefix('isSuperAdmin')
    ->middleware(['auth', 'isSuperAdmin'])
    ->group(function () {
        //Branch
        Route::controller(App\Http\Controllers\BranchController::class)->group(function () {
            Route::get('/branch/add', 'add_view')->name('branch_add_view');
            Route::get('/branch/view', 'view')->name('branch_view');
            Route::post('/branch/view', 'add')->name('branch_add');
            Route::get('branch/edit{id}', 'edit')->name('branch_edit');
            Route::post('branch/update', 'update')->name('branch_update');
            Route::get('/deactivateBranch/{id}', 'deactivate')->name('branch_deactivate');
            Route::get('/reactivateBranch/{id}', 'reactivate')->name('branch_reactivate');
        });
        Route::controller(App\Http\Controllers\ApiController::class)->group(function () {
            Route::get('/apiSetting', 'api')->name('api_setting');
            Route::post('/apiEdit', 'apiEdit')->name('api_edit');
            Route::post('/apiUpadate', 'apiUpadate')->name('api_update');
        });

        Route::get('/register/view', [App\Http\Controllers\Auth\RegisterController::class, 'viewRegister'])->name('view_register');

        Route::controller(App\Http\Controllers\UserController::class)->group(function () {
            //go to customerAccountManagement
            Route::get('/user/manage', 'view')->name('user_view');
            //deactivate the user
            Route::get('/deactivateUser/{id}', 'deactivateUser')->name('deactivateUser');
            //reactivate the user
            Route::get('/reactivateUser/{id}', 'reactivateUser')->name('reactivateUser');
        });
        Route::controller(App\Http\Controllers\UserController::class)->group(function () {
            Route::get('/user/profile', 'profile')->name('profile_view');
            Route::get('/user/profile/{id}', 'profileUser')->name('profile_user_view');
            Route::post('/user/profile/update', 'profileUpdate')->name('profile_update');
        });

        // title
        Route::controller(App\Http\Controllers\TitleController::class)->group(function () {
            Route::get('/title/add', 'add_view')->name('title_add_view');
            Route::get('/title/view', 'view')->name('title_view');
            Route::post('/title/view', 'add')->name('title_add');
            Route::get('title/edit{id}', 'edit')->name('title_edit');
            Route::post('title/update', 'update')->name('title_update');
            Route::get('/deactivateTitle/{id}', 'deactivate')->name('title_deactivate');
            Route::get('/reactivateTitle/{id}', 'reactivate')->name('title_reactivate');
        });
        // place
        Route::controller(App\Http\Controllers\PlaceController::class)->group(function () {
            Route::get('/place/add', 'add_view')->name('place_add_view');
            Route::get('/place/view', 'view')->name('place_view');
            Route::post('/place/view', 'add')->name('place_add');
            Route::get('place/edit{id}', 'edit')->name('place_edit');
            Route::post('place/update', 'update')->name('place_update');
            Route::get('/deactivatePlace/{id}', 'deactivate')->name('place_deactivate');
            Route::get('/reactivatePlace/{id}', 'reactivate')->name('place_reactivate');
            Route::post('/place/view/search', 'search')->name('place_search');
        });
        // category
        Route::controller(App\Http\Controllers\CategoryController::class)->group(function () {
            Route::get('/category/add', 'add_view')->name('category_add_view');
            Route::get('/category/view', 'view')->name('category_view');
            Route::post('/category/view', 'add')->name('category_add');
            Route::get('category/edit{id}', 'edit')->name('category_edit');
            Route::post('category/update', 'update')->name('category_update');
            Route::get('/deactivateCategory/{id}', 'deactivate')->name('category_deactivate');
            Route::get('/reactivateCategory/{id}', 'reactivate')->name('category_reactivate');
        });
         // zone
         Route::controller(App\Http\Controllers\ZoneController::class)->group(function () {
            Route::get('/zone/add', 'add_view')->name('zone_add_view');
            Route::get('/zone/view', 'view')->name('zone_view');
            Route::post('/zone/view', 'add')->name('zone_add');
            Route::get('zone/edit{id}', 'edit')->name('zone_edit');
            Route::post('zone/update', 'update')->name('zone_update');
            Route::get('/deactivateZone/{id}', 'deactivate')->name('zone_deactivate');
            Route::get('/reactivateZone/{id}', 'reactivate')->name('zone_reactivate');
        });
    });
