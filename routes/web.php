<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\GuestRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//frontend
Route::get('/', [FrontendController::class, 'welcome'])->name('index');
Route::get('/category/post/{category_id}', [FrontendController::class, 'catgory_post'])->name('category.post');
Route::get('/author/post/{author_id}', [FrontendController::class, 'author_post'])->name('author.post');
Route::get('/author/list', [FrontendController::class, 'author_list'])->name('author.list');
Route::get('/post/details/{slug}', [FrontendController::class, 'post_details'])->name('post.details');
Route::get('/search', [FrontendController::class, 'search'])->name('search');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Users
Route::get('/users', [UserController::class, 'users'])->name('user');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::get('/edit/profile', [UserController::class, 'profile_edit'])->name('profile.edit');
Route::post('/profile/update', [UserController::class, 'profile_update'])->name('profile.update');
Route::post('/photo/update', [UserController::class, 'photo_update'])->name('photo.update');
Route::post('/user/check/delete', [UserController::class, 'delete_check'])->name('delete.check');
Route::get('/trash', [UserController::class, 'trash'])->name('trash');
Route::get('/restore/{user_id}', [UserController::class, 'restore'])->name('user.restore');
Route::get('/user/delete/hard/{user_id}', [UserController::class, 'hard_delete'])->name('user.delete.hard');
Route::post('/user/check/delete/hard', [UserController::class, 'hard_delete_check'])->name('hard.delete.check');


//Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.del');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');


//Tags
Route::get('/tags', [TagController::class, 'tag'])->name('tag');
Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');

//Role manager
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/role/remove/{user_id}', [RoleController::class, 'remove_role'])->name('remove.role');
Route::get('/edit/user/role/permission/{user_id}', [RoleController::class, 'user_role_permission'])->name('edit.user.role.permission');
Route::post('/permission/update', [RoleController::class, 'permission_update'])->name('permission.update');

//Blog Post
Route::get('/add/post/new', [PostController::class, 'add_post'])->name('add.post');
Route::post('/blog/post/store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/mypost', [PostController::class, 'my_post'])->name('my.post');
Route::get('/post/view/{post_id}', [PostController::class, 'post_view'])->name('post.view');
Route::get('/post/delete/{post_id}', [PostController::class, 'post_delete'])->name('post.delete');
Route::get('/post/edit/{post_id}', [PostController::class, 'post_edit'])->name('post.edit');
Route::post('/post/update', [PostController::class, 'post_update'])->name('post.update');


//Guest Register
Route::get('/guest/register', [GuestRegisterController::class, 'guest_register'])->name('guest.register');
Route::get('/guest/login', [GuestRegisterController::class, 'guest_login'])->name('guest.login');
Route::post('/guest/store', [GuestRegisterController::class, 'guest_store'])->name('guest.store');
Route::post('/guest/login/request', [GuestLoginController::class, 'guest_login_req'])->name('guest.login.req');
Route::get('/guest/logout', [GuestLoginController::class, 'guest_logout'])->name('guest.logout');

//github login
Route::get('/github/redirect', [GithubController::class, 'redirect_provider'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'provider_to_application'])->name('github.callback');

//github login
Route::get('/google/redirect', [GoogleController::class, 'redirect_provider'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'provider_to_application'])->name('google.callback');

//Reset Password
Route::get('/guest/pass/reset/req', [GuestController::class, 'pass_reset_req'])->name('guest.pass.reset.req');
Route::post('/guest/pass/reset/req/send', [GuestController::class, 'pass_reset_req_send'])->name('guest.pass.reset.req.send');
Route::get('/guest/pass/reset/form/{token}', [GuestController::class, 'pass_reset_form'])->name('guest.pass.reset.form');
Route::post('/guest/pass/reset', [GuestController::class, 'guest_pass_reset'])->name('guest.pass.reset');


//Email Verify
Route::get('/verify/mail/confirm/{token}', [GuestRegisterController::class, 'verify_mail'])->name('verify.mail.confirm');
Route::get('/verify/mail/req', [GuestRegisterController::class, 'mail_verify_req'])->name('mail.verify.req');
Route::post('/verify/mail/again', [GuestRegisterController::class, 'mail_verify_again'])->name('mail.verify.again');

//Comments
Route::post('/comment/store', [GuestController::class, 'comment_store'])->name('comment.store');
