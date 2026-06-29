<?php




use App\Http\Controllers\PropertyController as FrontPropertyController;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SimpleRegisterController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\MatchingController;




use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;




use Illuminate\Support\Facades\Route;




Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [FeedbackController::class, 'store'])->name('store.feedback');
Route::get('terms', [FrontController::class, 'terms'])->name('terms');
Route::get('privacy-policy', [FrontController::class, 'privacy'])->name('privacy-policy');
Route::get('faqs', [FrontController::class, 'faqs'])->name('faqs');
//property
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/property-listings', [FrontPropertyController::class, 'properties'])->name('property.listings');
Route::get('/property-details/{id}', [FrontPropertyController::class, 'propertyDetails'])->name('property.details');
Route::get('properties/report/{id}', [FrontPropertyController::class, 'report'])->name('property.report');
Route::post('properties/report/{id}', [ReportController::class, 'store'])->name('property.report.submit');


//Reviews
Route::post('property/review/{id}',[ReviewController::class, 'store'])->name('property.review.store');



//Booking
Route::get('/booking/property-inspection/{id}', [BookingController::class, 'index'])->name('book.inspection');
Route::post('/booking/property-inspection', [BookingController::class, 'storeBooking'])->name('store.booking');
Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');



 Route::middleware('guest')->group(function () {

  

        // Login
        Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('throttle:5,1');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

        // Register
        Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('throttle:5,1');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
        
        // Forgot Password
        Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm'])->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('password.email');

        // Reset Password
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    });



// Admin Guest Routes (not logged in)
Route::prefix('admin')->name('admin.')->group(function () {

   
 


Route::post('/register-test', function() {
    return 'Test route is working!';
});




    

    // Admin Authenticated Routes (logged in)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        // Property Management
        Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/show/{id}', [PropertyController::class, 'showPropertyById'])->name('show.property');
        Route::get('property/edit/{id}', [PropertyController::class, 'edit'])->name('edit.property');
        Route::post('property/edit/{id}',[PropertyController::class,'updateProperty'])->name('update.property');
        Route::get('property/delete/{id}', [PropertyController::class, 'deleteProperty'])->name('delete.property');


        //User Management
        Route::get('/users',[UserController::class, 'index'])->name('users.index');
        Route::get('/users/show/{id}',[UserController::class, 'show'])->name('users.show');
        Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
        Route::post('/users/create',[UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/edit/{id}',[UserController::class, 'updateUser'])->name('users.update');
        Route::patch('/users/toggle-status/{id}/toggle-status',[UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::get('/users/delete-user/{id}',[UserController::class, 'delete'])->name('delete.user');


        //faqs
        Route::get('/faq',[FaqController::class, 'index'])->name('faq.index');
        Route::get('/faq/create',[FaqController::class, 'create'])->name('faq.create');
         Route::post('/faq/create',[FaqController::class, 'store'])->name('faq.store');
         Route::get('faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
          Route::put('faq/edit/{id}', [FaqController::class, 'updateFaq'])->name('faq.update');
          Route::patch('faq/toggle-status/{id}', [FaqController::class, 'toggleStatus'])->name('faq.toggle-status');
          Route::delete('faq/delete/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');


        //settings
         Route::get('/settings',[SettingController::class, 'index'])->name('settings.index');
         Route::put('/settings',[SettingController::class, 'store'])->name('settings.update');
         Route::get('pages/terms',[SettingController::class, 'terms'])->name('pages.terms');
         Route::get('pages/privacy-policy',[SettingController::class, 'privacyPolicy'])->name('pages.privacy-policy');


         //bookings
        Route::get('/bookings',[AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/show/{id}',[AdminBookingController::class, 'show'])->name('bookings.show');
        Route::patch('/bookings/toggle-status/{id}',[AdminBookingController::class, 'toggleStatus'])->name('bookings.update-status');
        Route::delete('/bookings/destroy/{id}',[AdminBookingController::class, 'destroy'])->name('bookings.destroy');
    
        //reports
        Route::get('reports',[AdminReportController::class,'index'])->name('reports.index');
        Route::get('reports/show/{id}',[AdminReportController::class,'show'])->name('reports.show');
         Route::patch('reports/status/{id}',[AdminReportController::class,'toggleStatus'])->name('reports.status');
        });
         Route::delete('reports/delete/{id}',[AdminReportController::class,'destroy'])->name('reports.destroy');


         //reviews
         Route::get('reviews',[AdminReviewController::class,'index'])->name('reviews.index');
         Route::patch('reviews/status/{id}',[AdminReviewController::class,'toggleStatus'])->name('reviews.approve');
         Route::delete('reviews/delete/{id}',[AdminReviewController::class,'destroy'])->name('reviews.destroy');

         //emails
         Route::get('email/send',[EmailController::class,'index'])->name('email.index');
        Route::post('email/send',[EmailController::class,'send'])->name('email.send');
         Route::get('/emails/preview', [EmailController::class, 'previewRecipients'])->name('emails.preview');

         //feedbacks
         Route::get('feedback', [FeedbackController::class, 'feedbacks'])->name('feedback.index');
         Route::patch('feedback/status/{id}', [FeedbackController::class, 'toggleStatus'])->name('feedback.update');
         Route::delete('feedback/destroy/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
         
        

         Route::get('/matching', [MatchingController::class, 'index'])->name('matching.index');
         Route::post('/matching/connect', [MatchingController::class, 'connect'])->name('matching.connect');

         });



Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


Route::get('/admin/register-simple', [SimpleRegisterController::class, 'showForm']);
Route::post('/admin/register-simples', [SimpleRegisterController::class, 'register']);


