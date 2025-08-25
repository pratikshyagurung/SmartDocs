<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Editor\AuthController;
use App\Http\Controllers\Editor\EditorDashboardController;
use App\Http\Controllers\Editor\EditorProfileController;
use App\Http\Controllers\Editor\ArticleController;
use App\Http\Controllers\Editor\DocumentsController;
use App\Http\Controllers\Editor\ReportsController;
use App\Http\Controllers\Editor\CategoryRedirectController;
use App\Http\Controllers\Editor\EditorCategoryController;


use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminEditorController;


use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserFeedbackController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserArticleController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\UserProgressController;
use App\Http\Controllers\User\UserTopPerformerController;




use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


use App\Models\Category;


Route::get('/', [HomeController::class, 'landing'])->name('home');

// Gateway: decide login or redirect
Route::get('/go/{dest}', [HomeController::class, 'gate'])->name('gate');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Editor Auth
Route::prefix('editor')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('editor.register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('editor.register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('editor.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('editor.login');

    Route::middleware(['auth:editor'])->group(function () {
        Route::get('/editor/pages/dashboard', [EditorDashboardController::class, 'index'])->name('editor.dashboard');
        Route::get('/editor/pages/dashboard', [EditorDashboardController::class, 'dashboard'])->name('editor.dashboard');

        // Route::get('/editor/pages/report', fn() => view('editor.pages.report'))->name('editor.report');
        Route::get('/editor/pages/documents', fn() => view('editor.pages.documents'))->name('editor.documents');
        Route::get('/editor/pages/articles', fn() => view('editor.pages.articles'))->name('editor.articles');
        Route::get('/editor/pages/categories', [EditorCategoryController::class, 'index'])->name('editor.categories');
        Route::get('/editor/pages/myPosts', [ArticleController::class, 'myPosts'])
            ->name('editor.myPosts');
        Route::get('/editor/pages/topPerformer', [ArticleController::class, 'performanceDashboard'])
            ->name('editor.topPerformer');

        // Article Routes
        Route::get('/articles', [ArticleController::class, 'index'])->name('editor.articles.index');
        Route::post('/articles', [ArticleController::class, 'store'])->name('editor.articles.store');
        Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('editor.articles.show');
        Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('editor.articles.edit');
        Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('editor.articles.update');
        Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('editor.articles.destroy');
        Route::get('/articles/{id}/download', [ArticleController::class, 'downloadPDF'])->name('editor.article.download');

        // Category Routes
        Route::get('/editor/pages/categories/{slug}', [EditorCategoryController::class, 'showByCategory'])
            ->name('editor.categories.detail');
        Route::get('/editor/category/{id}/articles', [EditorCategoryController::class, 'showByCategory'])->name('articles.byCategory');
        Route::get('/editor/category/{slug}', [CategoryRedirectController::class, 'handle'])
            ->name('editor.categories.redirect');

        // Profile Routes
        Route::get('/editor/profile', [EditorProfileController::class, 'index'])->name('editor.profile');
        Route::patch('/editor/profile', [EditorProfileController::class, 'updateProfile'])->name('editor.profile.update');
        Route::patch('/editor/profile/image', [EditorProfileController::class, 'updateProfileImage'])->name('editor.profile.update.image');
        Route::patch('/editor/profile/password', [EditorProfileController::class, 'changePassword'])->name('editor.profile.update.password');



        Route::post('/editor/logout', [AuthController::class, 'logout'])->name('editor.logout')->middleware('auth:editor');
    });
});


// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/pages/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Categories CRUD
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Route::get('/admin/pages/report', fn() => view('admin.pages.report'))->name('admin.report');
    Route::get('/admin/pages/documents', fn() => view('admin.pages.documents'))->name('admin.documents');
    Route::get('/admin/pages/articles', fn() => view('admin.pages.articles'))->name('admin.articles');


    Route::get('admin/pages/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/pages/article-show/{id}', [AdminArticleController::class, 'show'])
        ->name('admin.articles.show');
    Route::get('/admin/pages/categories-show', [AdminDashboardController::class, 'publishedArticles'])->name('admin.publishedarticles');

    Route::get('/admin/pages/feedback', [FeedbackController::class, 'index'])->name('admin.feedbacks');
    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('admin.feedback.delete');

    Route::get('/admin/pages/TopPerformers', [AdminDashboardController::class, 'topPerformers'])
        ->name('admin.TopPerformers')
        ->middleware(['auth', 'role:admin']);

    Route::get('admin/pages/users', [AdminUserController::class, 'manageUsers'])->name('admin.users');
    Route::delete('/users/{id}', [AdminUserController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('admin/pages/users-view/{id}', [AdminUserController::class, 'viewUser'])->name('admin.users.view');
    Route::get('admin/pages/users-edit/{id}', [AdminUserController::class, 'editUser'])->name('admin.user.edit');
    Route::put('admin/pages/users-update/{id}', [AdminUserController::class, 'updateUser'])->name('admin.user.update');

    Route::get('admin/pages/editors', [AdminEditorController::class, 'manageEditors'])->name('admin.editors');
    Route::delete('admin/pages/editors/{id}', [AdminEditorController::class, 'deleteEditor'])->name('admin.editor.delete');
    Route::get('admin/pages/editors-view/{id}', [AdminEditorController::class, 'viewEditor'])->name('admin.editor.view');
    Route::get('admin/pages/editors-edit/{id}', [AdminEditorController::class, 'editEditor'])->name('admin.editor.edit');
    Route::put('admin/pages/editors-update/{id}', [AdminEditorController::class, 'updateEditor'])->name('admin.editor.update');

    Route::get('admin/articles/{id}/download', [AdminArticleController::class, 'downloadPDF'])
        ->name('admin.article.download');

    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



// User Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/pages/home', [HomeController::class, 'index'])->name('user.home');
    Route::get('/user/pages/categories', fn() => view('user.pages.categories'))->name('user.categories');
    Route::get('/user/pages/all-articles', fn() => view('user.pages.all-articles'))->name('user.all-articles');
    // routes/web.php
    Route::get('/user/pages/top-performer', [UserTopPerformerController::class, 'performanceDashboard'])
        ->name('user.top-performer');

    Route::get('/user/pages/about', fn() => view('user.pages.about'))->name('user.about');
    Route::get('/user/pages/feedback', fn() => view('user.pages.feedback'))->name('user.feedback');
    Route::post('/user/pages/feedback', [UserFeedbackController::class, 'store'])
        ->name('user.feedback.store');
    Route::get('/user/pages/feedback', [UserFeedbackController::class, 'showFeedbacks'])->name('user.feedback');


    Route::get('/user/pages/Userprofile', fn() => view('user.pages.Userprofile'))->name('user.Userprofile');
    Route::patch('/user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::patch('/user/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password');
    Route::patch('/user/profile/image', [UserProfileController::class, 'updateImage'])->name('user.profile.update.image');



    Route::get('/user/pages/categories', [UserDashboardController::class, 'categories'])->name('user.categories');

    Route::post('/user/articles/{article}/like', [UserArticleController::class, 'toggleLike'])
        ->middleware('auth')
        ->name('user.article.like');

    Route::post('/progress/update', [UserProgressController::class, 'update'])->name('progress.update');
    Route::get('/progress/list', [UserProgressController::class, 'list'])->name('progress.list');

    Route::get('/user/articles/{article:slug}', [UserArticleController::class, 'show'])
        ->name('user.article.show')
        ->middleware(['auth', 'role:user']);
    Route::get('/user/pages/all-articles', [HomeController::class, 'allArticles'])
        ->name('user.all-articles')
        ->middleware(['auth', 'role:user']);
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::post('/comments/{article}', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/comments/reply/{comment}', [CommentController::class, 'reply'])->name('comments.reply');
    });

    Route::get('user/articles/{id}/download', [UserArticleController::class, 'downloadPDF'])
        ->name('user.article.download');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


//profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
