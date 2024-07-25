<?php


use Illuminate\Support\Facades\Route;
//классы для админки
use App\Http\Controllers\admin\CustomFieldController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\FieldController;
use App\Http\Controllers\admin\LocaleController;
use App\Http\Controllers\admin\FeedbackController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\PageController;
use \App\Http\Controllers\admin\WebComponentController;
//use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryProductController;
use App\Http\Controllers\admin\WorkController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\ActivityLogController;
use App\Http\Controllers\admin\WidgetController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DictionaryController;
use App\Http\Controllers\AsyncController;
//классы для фронта
use App\Http\Controllers\front\FrontPageController;
use App\Http\Controllers\front\FrontProductController;
use App\Http\Controllers\front\FrontCategoryController;
use App\Http\Controllers\front\FrontWorkController;
//класс для очистки кеша
use \App\Http\Controllers\ClearAllController;


    require __DIR__.'/auth.php';

    //Admin Panel
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::prefix('/admin')->name('admin.')->group(function () {

            Route::get('/', [AdminController::class, 'index']);

            Route::resource('user', UserController::class);
            Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/user/{id}/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
            Route::post('/user/{id}/update-data', [UserController::class, 'updateData'])->name('user.updateData');
            Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            Route::resource('menu', MenuController::class);
            Route::post('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');

            Route::resource('widget', WidgetController::class);
            Route::post('/widget/{widget}', [WidgetController::class, 'update'])->name('widget.update');

            Route::resource('page', PageController::class);
            Route::post('/page/{page}', [PageController::class, 'update'])->name('page.update');

            Route::resource('component', WebComponentController::class);
            Route::post('/component/{component}', [WebComponentController::class, 'update'])->name('component.update');

            Route::resource('customfields', CustomFieldController::class);
            Route::post('/customfields/{customfields}', [CustomFieldController::class, 'update']);

            Route::resource('locale', LocaleController::class);
            Route::post('/locale/{locale}', [LocaleController::class, 'update']);

            Route::resource('work/posts', WorkController::class)->names([
                'index' => 'work.posts.index',
                'create' => 'work.posts.create',
                'store' => 'work.posts.store',
                'show' => 'work.posts.show',
                'edit' => 'work.posts.edit',
                'update' => 'work.posts.update',
                'destroy' => 'work.posts.destroy',
            ]);
            Route::post('/work/posts/{work}', [WorkController::class, 'update'])->name('work.posts.update');

            Route::resource('feedback', FeedbackController::class);
            Route::post('/feedback/{feedback}', [FieldController::class, 'update'])->name('feedback.update');

            Route::resource('field', FieldController::class);
            Route::post('/field/{field}', [FieldController::class, 'update'])->name('field.update');

            Route::resource('setting', SettingController::class);
            Route::post('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');

            Route::resource('activity_log', ActivityLogController::class);

        });
    });


    Route::post('/updatefields', [WebComponentController::class, 'updatefields']);

    Route::post('/deletefields', [WebComponentController::class, 'deletefields']);


    Route::get('/admin/cm', [AsyncController::class, 'apidata']);
    //очистка кеша
    Route::get('/clear', [ClearAllController::class, 'clear']);
    //для главной страницы
    Route::get(("/"), [FrontPageController::class, 'front_page']);
    //для остальных страниц
    Route::get( ("/{slug}"), [FrontPageController::class, 'show']);
    //для новостей
    Route::get("/work/{slug}", [FrontWorkController::class, 'show']);
    //для заявок с сайта
    Route::post('/order', [FeedbackController::class, 'feedback']);
    //файловый менеджер
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });



    Route::post('/update_pages_field', [CustomFieldController::class, 'update_pages_field']);
    Route::post('/delete_field', [CustomFieldController::class, 'delete_field']);

    Route::post('/add_field_for_component', [CustomFieldController::class, 'add_field_for_component']);
    Route::post('/delete_comp', [WebComponentController::class, 'delete_comp']);


  