<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobFamilyController;
use App\Http\Controllers\KcController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SlidesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffEventsController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('kc/auth/{token}', [KcController::class, 'successfulStaffLogin'])->name('kcAuth');

Route::get('auth/login', [AuthController::class, 'showAdminLogin'])->name('adminLogin');
Route::post('auth/login', [AuthController::class, 'adminLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'ajax'], function(){
    Route::post('meeting/attendance', [MeetingsController::class, 'markAttendance'])->name('markAttendance');

});

Route::group(['middleware' => 'isLoggedIn'], function(){

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('stdl', [HomeController::class, 'stdl'])->name('stdl');
    Route::post('events/accept', [EventsController::class, 'acceptEvent'])->name('acceptEvent');

    Route::get('profile', [StaffController::class, 'profile'])->name('profile');
    Route::post('book/counselling', [StaffController::class, 'bookCounselling'])->name('bookCounselling');
    Route::get('staff_handbook', [HomeController::class, 'handbook'])->name('handbook');
    Route::get('counselling', [HomeController::class, 'counselling'])->name('counselling');

    Route::get('birthday/{id}', [HomeController::class, 'viewBirthday'])->name('birthday');
    Route::post('birthday/{id}', [HomeController::class, 'addComment']);
    Route::get('greetings/{id}/{slug}', [StaffEventsController::class, 'greetings'])->name('greetings');
    Route::post('greetings/{id}/{slug}', [StaffEventsController::class, 'addComment']);
    Route::get('information-center', [PostsController::class, 'showPosts'])->name('posts');
    Route::get('information-center/view/{id}', [PostsController::class, 'viewPost'])->name('posts.show');
    Route::post('information-center/view/{id}', [PostsController::class, 'addComment']);
    Route::patch('profile/basic', [StaffController::class, 'updateBasicProfile'])->name('updateBasicProfile');
    Route::patch('profile/family', [StaffController::class, 'updateFamilyProfile'])->name('updateFamilyProfile');
    Route::patch('profile/ministry', [StaffController::class, 'updateMinistryProfile'])->name('updateMinistryProfile');
    Route::get('be-tv/watch/{code}', [MeetingsController::class, 'attendMeeting'])->name('attendMeeting');
    Route::get('be-tv', [MeetingsController::class, 'showMeetings'])->name('meetings');
    Route::get('videos', [VideoController::class, 'showVideos'])->name('videos');
    Route::post('videos/{id}/{slug}', [VideoController::class, 'addComment']);
    Route::get('videos/{id}/{slug}', [VideoController::class, 'viewVideo'])->name('viewVideo');
    Route::get('programmes', [MeetingsController::class, 'showMeetings'])->name('meetings');

    Route::get('live/watch/{code}', [MeetingsController::class, 'attendMeeting'])->name('attendMeeting');


});

Route::group(['middleware' => 'isAdmin', 'prefix' => 'pilot'], function(){
    Route::get('/', [HomeController::class, 'adminDashboard'])->name('adminDashboard');


    Route::group(['prefix' => 'job-families'], function(){
        Route::get('/', [JobFamilyController::class, 'index'])->name('jobFamily.index');
        Route::post('/', [JobFamilyController::class, 'store'])->name('jobFamily.store');
        Route::get('create', [JobFamilyController::class, 'create'])->name('jobFamily.create');
        Route::get('members/{id}', [JobFamilyController::class, 'members'])->name('jobFamily.members');
        Route::get('show/{id}', [JobFamilyController::class, 'show'])->name('jobFamily.show');
        Route::post('roles', [JobFamilyController::class, 'addRole'])->name('jobFamily.addRole');
        Route::delete('role/{id}', [JobFamilyController::class, 'deleteRole'])->name('jobFamily.deleteRole');
        Route::post('delete/{id}', [JobFamilyController::class, 'destroy'])->name('jobFamily.delete');
        Route::put('update', [JobFamilyController::class, 'update'])->name('jobFamily.update');
    });
    Route::group(['prefix' => 'staff'], function(){
        Route::get('/', [StaffController::class, 'allStaff'])->name('staff.index');
        Route::get('all', [StaffController::class, 'allStaffProfile'])->name('staff.allProfile');
        Route::get('view/{id}', [StaffController::class, 'viewStaff'])->name('staff.show');

        Route::get('birthdays', [StaffController::class, 'birthdays'])->name('birthdays');
        Route::put('director/{id}', [StaffController::class, 'setAsDirector'])->name('staff.setDirector');
        Route::put('department_head/{id}', [StaffController::class, 'setAsDepartmentHead'])->name('staff.setDeptHead');
        Route::post('department_head/delete/{id}', [StaffController::class, 'deleteHod'])->name('staff.deleteHod');
        Route::post('department_head/bulk-delete', [StaffController::class, 'bulkDelete'])->name('staff.bulkDelete');

    });
    Route::group(['prefix' => 'videos'], function(){
        Route::get('/', [VideoController::class, 'index'])->name('videos.index');
        Route::post('/', [VideoController::class, 'store'])->name('videos.store');
        Route::get('create', [VideoController::class, 'create'])->name('videos.create');
        Route::get('edit/{id}', [VideoController::class, 'edit'])->name('videos.edit');
        Route::post('delete/{id}', [VideoController::class, 'destroy'])->name('videos.delete');
        Route::patch('update/{id}', [VideoController::class, 'update'])->name('videos.update');
    });
    Route::group(['prefix' => 'programmes'], function(){
        Route::get('/', [MeetingsController::class, 'index'])->name('meetings.index');
        Route::get('manage/{id}', [MeetingsController::class, 'manage'])->name('meetings.manage');
        Route::post('/', [MeetingsController::class, 'store'])->name('meetings.store');
        Route::get('edit/{id}', [MeetingsController::class, 'edit'])->name('meetings.edit');
        Route::patch('update/{id}', [MeetingsController::class, 'update'])->name('meetings.update');
        Route::post('delete/{id}', [MeetingsController::class, 'destroy'])->name('meetings.delete');
    });

    Route::group(['prefix' => 'directors'], function(){
        Route::get('/', [StaffController::class, 'directors'])->name('staff.directors');
    });

    Route::group(['prefix' => 'dept_heads'], function(){
        Route::get('/', [StaffController::class, 'deptHeads'])->name('staff.deptHeads');
    });

    Route::group(['prefix' => 'posts'], function(){
        Route::get('/', [PostsController::class, 'index'])->name('posts.index');
        Route::post('/', [PostsController::class, 'store'])->name('posts.store');
        Route::get('create', [PostsController::class, 'create'])->name('posts.create');
        Route::get('edit/{id}', [PostsController::class, 'edit'])->name('posts.edit');
        Route::post('delete/{id}', [PostsController::class, 'destroy'])->name('posts.delete');
        Route::patch('update/{id}', [PostsController::class, 'update'])->name('posts.update');
    });
    Route::group(['prefix' => 'staff-events'], function(){
        Route::get('/', [StaffEventsController::class, 'index'])->name('staff-events.index');
        Route::post('/', [StaffEventsController::class, 'store'])->name('staff-events.store');
        Route::get('create', [StaffEventsController::class, 'create'])->name('staff-events.create');
        Route::get('edit/{id}', [StaffEventsController::class, 'edit'])->name('staff-events.edit');
        Route::delete('delete/{id}', [StaffEventsController::class, 'delete'])->name('staff-events.delete');
        Route::patch('update/{id}', [StaffEventsController::class, 'update'])->name('staff-events.update');
        Route::post('upload/image', [StaffEventsController::class, 'uploadImage'])->name('staff-events.uploadImage');
        Route::delete('image/delete/{id}', [StaffEventsController::class, 'deleteImage'])->name('staff-events.deleteImage');


    });

    Route::group(['prefix' => 'event-category'], function(){
        Route::post('store/events', [StaffEventsController::class, 'storeCategory'])->name('event-categories.store');
        Route::delete('delete/{id}', [StaffEventsController::class, 'deleteCategory'])->name('event-categories.delete');
//        Route::patch('update/{id}', [StaffEventsController::class, 'update'])->name('staff-events.update');
    });

    Route::group(['prefix' => 'regions'], function(){
        Route::get('/', [RegionController::class, 'index'])->name('regions.index');
        Route::post('/', [RegionController::class, 'store'])->name('regions.store');
        Route::get('create', [RegionController::class, 'create'])->name('regions.create');
        Route::get('edit/{id}', [RegionController::class, 'edit'])->name('regions.edit');
        Route::post('delete/{id}', [RegionController::class, 'destroy'])->name('regions.delete');
        Route::patch('update/{id}', [RegionController::class, 'update'])->name('regions.update');
    });

    Route::group(['prefix' => 'information-center'], function(){
        Route::get('/', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::post('/', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::get('edit/{id}', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::patch('update/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('{id}', [AnnouncementController::class, 'delete'])->name('announcements.delete');
    });

    Route::group(['prefix' => 'slides'], function(){
        Route::get('/', [SlidesController::class, 'index'])->name('slides.index');
        Route::post('/', [SlidesController::class, 'store'])->name('slides.store');
        Route::delete('{id}', [SlidesController::class, 'delete'])->name('slides.delete');
    });

    Route::group(['prefix' => 'streams'], function(){
        Route::get('/', [MeetingsController::class, 'indexStream'])->name('streams.index');
        Route::post('/', [MeetingsController::class, 'storeStream'])->name('streams.store');
        Route::delete('{id}', [MeetingsController::class, 'deleteStream'])->name('streams.delete');
    });
});

Route::get('clear', function() {
    Artisan::call('cache:clear');

    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cleared!";
});
