<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestmessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// Fronte end Conteoller
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/category/post/{category_id}', [FrontendController::class, 'category_post'])->name('category.post');
Route::get('/single/blog/{slug}', [FrontendController::class, 'single_blog'])->name('single.blog');
Route::get('/author/{author_id}', [FrontendController::class, 'author'])->name('author');
Route::get('/all/post', [FrontendController::class, 'all_post'])->name('all.post');
Route::get('/all/post/sec', [FrontendController::class, 'all_post_sec'])->name('all.post.sec');
Route::get('/contact/details', [FrontendController::class, 'contact'])->name('contact');
Route::get('/tag/details/{tag_id}', [FrontendController::class, 'tag_details'])->name('tag.details');

// home controller 
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');


// User controller
Route::middleware('disable.cache')->group(function(){
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [UserController::class, 'profile_update'])->name('profile.update');
Route::post('/profile/photo/update', [UserController::class, 'profile_photo_update'])->name('profile.photo.update');
Route::get('/user/list', [UserController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
});

// category controller
Route::middleware('disable.cache')->group(function(){
Route::get('/category/list', [CategoryController::class, 'category_list'])->name('category.list');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update/{category_id}', [CategoryController::class, 'category_update'])->name('category.update');
Route::get('/category/trash/list', [CategoryController::class, 'category_trash_list'])->name('category.trash.list');
Route::get('/category/trash/delete/{category_id}', [CategoryController::class, 'category_trash_delete'])->name('category.trash.delete');
Route::get('/category/trash/restore/{category_id}', [CategoryController::class, 'category_trash_restore'])->name('category.trash.restore');
});

// tag controller 
Route::middleware('disable.cache')->group(function(){
Route::get('/tag', [TagController::class, 'tag'])->name('tag');
Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');
Route::get('/tag/delete/{tag_id}', [TagController::class, 'tag_delete'])->name('tag.delete');
});

// role controller
Route::middleware('disable.cache')->group(function(){
Route::get('/role/permission/add', [RoleController::class, 'role_permission_add'])->name('role.permission.add');
Route::post('/add/permission', [RoleController::class, 'add_permission'])->name('add.permission');
Route::post('/add/role', [RoleController::class, 'add_role'])->name('add.role');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/remove/permission/{user_id}', [RoleController::class, 'remove_permission'])->name('remove.permission');
Route::get('/add/indivitual/permission/{user_id}', [RoleController::class, 'add_indivitual_permission'])->name('add.indivitual.permission');
Route::post('/update/indivitual/permission/{user_id}', [RoleController::class, 'update_indivitual_permission'])->name('update.indivitual.permission');
Route::get('/role/edit/{role_id}', [RoleController::class, 'role_edit'])->name('role.edit');
Route::post('/update/role/{role_id}', [RoleController::class, 'update_role'])->name('update.role');
});

// post controller 
Route::middleware('disable.cache')->group(function(){
Route::get('/add/post', [PostController::class, 'add_post'])->name('add.post');
Route::post('/post/store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/post/list',[PostController::class, 'post_list'])->name('post.list');
Route::get('/post/show/{post_id}', [PostController::class, 'post_show'])->name('post.show');
Route::get('/post/edit/{post_id}', [PostController::class, 'post_edit'])->name('post.edit');
Route::post('/post/update/{post_id}', [PostController::class, 'post_update'])->name('post.update');
Route::get('/post/delete/{post_id}', [PostController::class, 'post_delete'])->name('post.delete');
});

// subscribe controller
Route::middleware('disable.cache')->group(function(){
Route::post('/subscribe/store', [SubscriberController::class, 'subscribe_store'])->name('subscribe.store');
Route::get('/subscriber', [SubscriberController::class, 'subscriber'])->name('subscriber');
Route::get('/subscriber/delete/{id}', [SubscriberController::class, 'subscriber_delete'])->name('subscriber.delete');
});

//logo controller
Route::middleware('disable.cache')->group(function(){
Route::get('/logo/update', [LogoController::class, 'logo_update'])->name('logo.update');
Route::post('/logo/store/{logo_id}', [LogoController::class, 'logo_store'])->name('logo.store');
});

//logo controller
Route::middleware('disable.cache')->group(function(){
Route::get('/auth/info', [AuthorController::class, 'auth_info'])->name('auth.info');
Route::post('/auth/desp/store', [AuthorController::class, 'auth_desp_store'])->name('auth.desp.store');
Route::get('/desp/delete/{id}', [AuthorController::class, 'desp_delete'])->name('desp.delete');
Route::get('/desp/edit/{id}', [AuthorController::class, 'desp_edit'])->name('desp.edit');
Route::post('/auth/desp/update/{id}', [AuthorController::class, 'auth_desp_update'])->name('auth.desp.update');
Route::post('/auth/icon/store', [AuthorController::class, 'auth_icon_store'])->name('auth.icon.store');
Route::get('/icon/edit/{id}', [AuthorController::class, 'icon_edit'])->name('icon.edit');
Route::post('/auth/icon/update/{id}', [AuthorController::class, 'auth_icon_update'])->name('auth.icon.update');
Route::get('/icon/delete/{id}', [AuthorController::class, 'icon_delete'])->name('icon.delete');
});

// Guest controller 

Route::get('/guest/register', [GuestController::class, 'guest_register'])->name('guest.register');
Route::get('/guest/login', [GuestController::class, 'guest_login'])->name('guest.login');
Route::post('/guest/store', [GuestController::class, 'guest_store'])->name('guest.store');
Route::post('/guest/login/req', [GuestController::class, 'guest_login_req'])->name('guest.login.req');
Route::get('/guest/logout', [GuestController::class, 'guest_logout'])->name('guest.logout');

// github controller 
Route::get('/github/redirect', [GithubController::class, 'github_redirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'github_callback'])->name('github.callback');

// google controller 
Route::get('/google/redirect', [GoogleController::class, 'google_redirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');

// admin controller 
Route::middleware('disable.cache')->group(function(){
Route::get('/admin/info', [AdminController::class, 'admin_info'])->name('admin.info');
Route::post('/admin/desp/store', [AdminController::class, 'admin_desp_store'])->name('admin.desp.store');
Route::post('/admin/icon/store', [AdminController::class, 'admin_icon_store'])->name('admin.icon.store');
Route::get('/admin/desp/edit{id}', [AdminController::class, 'admin_desp_edit'])->name('admin.desp.edit');
Route::post('/admin/desp/update/{id}', [AdminController::class, 'admin_desp_update'])->name('admin.desp.update');
Route::get('/admin/desp/delete/{id}', [AdminController::class, 'admin_desp_delete'])->name('admin.desp.delete');
Route::get('/admin/icon/edit/{id}', [AdminController::class, 'admin_icon_edit'])->name('admin.icon.edit');
Route::post('/admin/icon/update/{id}', [AdminController::class, 'admin_icon_update'])->name('admin.icon.update');
Route::get('/admin/icon/delete/{id}', [AdminController::class, 'admin_icon_delete'])->name('admin.icon.delete');
Route::get('/view/all/post', [AdminController::class, 'view_all_post'])->name('view.all.post');
});
// contact
Route::middleware('disable.cache')->group(function(){
Route::get('/contact/info', [AdminController::class, 'contact_info'])->name('contact.info');
Route::post('/contact/store', [AdminController::class, 'contact_store'])->name('contact.store');
Route::get('/contact/delete/{id}', [AdminController::class, 'contact_delete'])->name('contact.delete');
Route::get('/contact/edit/{id}', [AdminController::class, 'contact_edit'])->name('contact.edit');
Route::post('/contact/update/{id}', [AdminController::class, 'contact_update'])->name('contact.update');
});

// guest message
Route::middleware('disable.cache')->group(function(){
Route::post('/guest/message', [GuestmessageController::class, 'guest_message'])->name('guest.message');
Route::get('/visitor/message', [GuestmessageController::class, 'visitor_message'])->name('visitor.message');
Route::get('/visitor/message/delete/{id}', [GuestmessageController::class, 'visitor_message_delete'])->name('visitor.message.delete');
});
// comment 
Route::middleware('disable.cache')->group(function(){
Route::post('/comment/store/{id}', [CommentController::class, 'comment_store'])->name('comment.store');
Route::get('/comment/single', [CommentController::class, 'comment_single'])->name('comment.single');
Route::get('/comment/delete/{comment_id}', [CommentController::class, 'comment_delete'])->name('comment.delete');
Route::post('/getnotifyComment', [CommentController::class, 'getnotifyComment']);
Route::get('/comment/view/{comment_id}', [CommentController::class, 'comment_view'])->name('comment.view');
Route::get('/comment/read', [CommentController::class, 'comment_read'])->name('comment.read');
});
