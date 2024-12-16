<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\HuongDanController;
use App\Http\Controllers\CamNangController;
use App\Http\Controllers\TintucController;
use App\Http\Controllers\LauncherController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

//Route::get('/dang-ky', [IndexController::class, 'register'])->name('index.register');
//Route::post('/post-dang-ky', [IndexController::class, 'postRegister'])->name('index.post-register');

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/index/tin-tuc', [IndexController::class, 'indexNew'])->name('index-new');
Route::get('/index/su-kien', [IndexController::class, 'indexEvent'])->name('index-event');
Route::get('/index/tim-kiem', [IndexController::class, 'indexSearch'])->name('index-search');
Route::get('/index/ranking', [IndexController::class, 'rankPaginate'])->name('index-bxh');
Route::get('/index/ranking-filter', [IndexController::class, 'rankFilter'])->name('index-bxh-filter');

Route::get('/tin-tuc', [TintucController::class, 'tin_tuc'])->name('index.new-page');
Route::get('/tin-tuc/new', [TintucController::class, 'postNew'])->name('post-new');
Route::get('/tin-tuc/event', [TintucController::class, 'postEvent'])->name('post-event');
Route::get('/tin-tuc/search', [TintucController::class, 'postSearch'])->name('post-search');
Route::get('/tin-tuc/{post}.html', [TintucController::class, 'tin_tuc_detail'])->name('tin_tuc_detail');

Route::get('/ebook', [\App\Http\Controllers\EbookController::class, 'list'])->name('ebook-list');
Route::get('/ebook/{post}', [\App\Http\Controllers\EbookController::class, 'title'])->name('ebook-detail');

//Route::get('/su-kien', [HomePageController::class, 'su_kien'])->name('index.event-page');
Route::get('/su-kien/{post}.html', [TintucController::class, 'su_kien_detail'])->name('su_kien_detail');

Route::get('/huong-dan', [\App\Http\Controllers\HuongDanController::class, 'huong_dan'])->name('index.instruction-page');
Route::get('/huong-dan/{post}.html', [\App\Http\Controllers\HuongDanController::class, 'huong_dan_detail'])->name('huong_dan_detail');

Route::get('/cam-nang', [\App\Http\Controllers\CamNangController::class, 'cam_nang'])->name('index.instruction-page');
Route::get('/cam-nang/{post}.html', [\App\Http\Controllers\CamNangController::class, 'cam_nang_detail'])->name('cam_nang_detail');

Route::get('/tim-kiem', [IndexController::class, 'search'])->name('index.search-page');
Route::get('/tim-kiem/{post}.html', [IndexController::class, 'search_detail']);


Route::get('/image-launcher-small', [LauncherController::class, 'imageLauncherSmall'])->name('index.image-launcher-small');
Route::get('/image-launcher-big', [LauncherController::class, 'imageLauncherBig'])->name('index.image-launcher-big');
Route::get('/new-launcher', [LauncherController::class, 'newLauncher'])->name('index.new-launcher');

//Route::get('/download', [IndexController::class, 'download'])->name('download');

//Route::get('/backup', function () {
//    \App\Models\User::create
//    ([
//        'email' => 'test@gmail.com',
//        'name' => 'Test Administrator',
//        'username' => 'vinhadmin',
//        'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
//        'group' => GROUP_ADMIN,
//        'active' => ACTIVE_TRUE,
//        'created_at' => \Carbon\Carbon::now()->format('Y-m-d'),
//        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d'),
//    ]);
//    return 'ok';
//});

Route::group(['prefix' => 'auth', 'namespace' => 'App\\Http\\Controllers\\Admin'], function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('auth.getLogin');
    Route::post('login', 'LoginController@login')->name('auth.postLogin');
    Route::get('logout', 'LoginController@logout')->name('auth.postLogout');

    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('auth.getForgotPassword');
    Route::post('forgot-password', 'ForgotPasswordController@resetPassword')->name('auth.sendMail');

    Route::get('reset-password/{token}', 'ForgotPasswordController@getFormResetPassword')->name('auth.getRecoverPassword');
    Route::post('reset-password/{token}', 'ForgotPasswordController@resetPasswordChange')->name('auth.postRecoverPassword');
});
Route::group(['namespace' => 'App\\Http\\Controllers\\Admin', 'middleware' => ['auth','check-ip'], 'prefix' => '/admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.list');
        Route::get('/detail', 'UserController@detail')->name('admin.user.detail');
        Route::get('/form', 'UserController@getForm')->middleware('check-admin-permission')->name('admin.user.form.get');
        Route::post('/form', 'UserController@saveForm')->middleware('check-admin-permission')->name('admin.user.form.post');
        Route::get('/edit/{id}', 'UserController@editForm')->name('admin.user.form.edit');
        Route::post('/update/{id}', 'UserController@updateForm')->name('admin.user.form.update');
        Route::get('/delete/{id}', 'UserController@delete')->middleware('check-admin-permission')->name('admin.user.delete');
    });

    Route::group(['prefix' => 'banner'], function () {
        Route::get('/', 'BannerController@index')->name('admin.banner.list');
        Route::get('/form', 'BannerController@getForm')->name('admin.banner.form.get');
        Route::post('/form', 'BannerController@saveForm')->name('admin.banner.form.post');
        Route::get('/edit/{id}', 'BannerController@editForm')->name('admin.banner.form.edit');
        Route::post('/update/{id}', 'BannerController@updateForm')->name('admin.banner.form.update');
        Route::get('/delete/{id}', 'BannerController@delete')->name('admin.banner.delete');
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'PostController@index')->name('admin.post.list');
        Route::get('/form', 'PostController@getForm')->name('admin.post.form.get');
        Route::post('/form', 'PostController@saveForm')->name('admin.post.form.post');
        Route::get('/edit/{id}', 'PostController@editForm')->name('admin.post.form.edit');
        Route::post('/update/{id}', 'PostController@updateForm')->name('admin.post.form.update');
        Route::get('/delete/{id}', 'PostController@delete')->name('admin.post.delete');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.list');
        Route::get('/form', 'CategoryController@getForm')->name('admin.category.form.get');
        Route::post('/form', 'CategoryController@saveForm')->name('admin.category.form.post');
        Route::get('/edit/{id}', 'CategoryController@editForm')->name('admin.category.form.edit');
        Route::post('/update/{id}', 'CategoryController@updateForm')->name('admin.category.form.update');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
    });

    Route::group(['prefix' => 'activities'], function () {
        Route::get('/', 'ActivityController@index')->name('admin.activity.list');
        Route::get('/form', 'ActivityController@getForm')->name('admin.activity.form.get');
        Route::post('/form', 'ActivityController@saveForm')->name('admin.activity.form.post');
        Route::get('/edit/{id}', 'ActivityController@editForm')->name('admin.activity.form.edit');
        Route::post('/update/{id}', 'ActivityController@updateForm')->name('admin.activity.form.update');
        Route::get('/delete/{id}', 'ActivityController@delete')->name('admin.activity.delete');
    });

    Route::group(['prefix' => 'actor'], function () {
        Route::get('/', 'ActorSlideController@index')->name('admin.actor.list');
        Route::get('/form', 'ActorSlideController@getForm')->name('admin.actor.form.get');
        Route::post('/form', 'ActorSlideController@saveForm')->name('admin.actor.form.post');
        Route::get('/edit/{id}', 'ActorSlideController@editForm')->name('admin.actor.form.edit');
        Route::post('/update/{id}', 'ActorSlideController@updateForm')->name('admin.actor.form.update');
        Route::get('/delete/{id}', 'ActorSlideController@delete')->name('admin.actor.delete');
    });

    Route::group(['prefix' => 'ebook'], function () {
        Route::get('/', 'EbookController@index')->name('admin.ebook.list');
        Route::get('/form', 'EbookController@getForm')->name('admin.ebook.form.get');
        Route::post('/form', 'EbookController@saveForm')->name('admin.ebook.form.post');
        Route::get('/edit/{id}', 'EbookController@editForm')->name('admin.ebook.form.edit');
        Route::post('/update/{id}', 'EbookController@updateForm')->name('admin.ebook.form.update');
        Route::get('/delete/{id}', 'EbookController@delete')->name('admin.ebook.delete');
    });

    Route::group(['prefix' => 'image-launcher'], function () {
        Route::get('/', 'ImageLauncherController@index')->name('admin.image-launcher.list');
        Route::get('/form', 'ImageLauncherController@getForm')->name('admin.image-launcher.form.get');
        Route::post('/form', 'ImageLauncherController@saveForm')->name('admin.image-launcher.form.post');
        Route::get('/edit/{id}', 'ImageLauncherController@editForm')->name('admin.image-launcher.form.edit');
        Route::post('/update/{id}', 'ImageLauncherController@updateForm')->name('admin.image-launcher.form.update');
        Route::get('/delete/{id}', 'ImageLauncherController@delete')->name('admin.image-launcher.delete');
    });
});

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();
    // Thêm trang tĩnh
    $sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'));
    $sitemap->add(Url::create('/huong-dan')->setPriority(1.0)->setChangeFrequency('daily'));
    $sitemap->add(Url::create('/cam-nang')->setPriority(1.0)->setChangeFrequency('daily'));
    $sitemap->add(Url::create('/tin-tuc')->setPriority(1.0)->setChangeFrequency('daily'));
    $sitemap->add(Url::create('/landing')->setPriority(1.0)->setChangeFrequency('daily'));

    // Thêm bài viết từ database
    $news = \App\Models\Post::where('category_id', TINTUC)->get(); // Lấy tất cả bài viết từ database
    foreach ($news as $post) {
        $sitemap->add(
            Url::create(\route('tin_tuc_detail', $post->title_domain))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.9)
        );
    }

    $events = \App\Models\Post::where('category_id', SUKIEN)->get(); // Lấy tất cả bài viết từ database
    foreach ($events as $post) {
        $sitemap->add(
            Url::create(\route('su_kien_detail', $post->title_domain))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.9)
        );
    }

    $camnang = \App\Models\Post::with('category')->whereHas('category', function ($q) {
        $q->where('parent_id', CAMNANG);
    })->get(); // Lấy tất cả bài viết từ database
    foreach ($camnang as $post) {
        $sitemap->add(
            Url::create(\route('cam_nang_detail', $post->title_domain))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.9)
        );
    }

    $huongdan = \App\Models\Post::with('category')->whereHas('category', function ($q) {
        $q->where('parent_id', HUONGDAN);
    })->get(); // Lấy tất cả bài viết từ database
    foreach ($huongdan as $post) {
        $sitemap->add(
            Url::create(\route('huong_dan_detail', $post->title_domain))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.9)
        );
    }
    return $sitemap->toResponse(request());
});
