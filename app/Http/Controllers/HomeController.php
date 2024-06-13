<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\EventCategory;
use App\Models\EventImage;
use App\Models\JobFamily;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\Region;
use App\Models\Slide;
use App\Models\StaffComment;
use App\Models\StaffEvent;
use App\Models\Stream;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //

    public function index()
    {
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $date = date('d-m');
        $data['birthdays'] = User::where('dob','like', '%'.$date.'%')->where('enabled', '1')->get();
        $data['dash_menu'] = true;
        $data['events'] = StaffEvent::latest()->get();
        $data['cats'] = EventCategory::latest()->get();
       $data['video'] = Video::where('status','active')->first();
       $data['meeting'] = Meeting::where('status','active')->first();
        $data['page_title'] = 'Home';
        $data['meetings'] = Event::select('meetingTitle','meetingID','meetingDesc')->orderBy('meetingDate', 'DESC')->take(10)->get();
        $data['special_meetings'] = Event::where('meeting_category','special')->select('meetingTitle','meetingID','meetingDesc')->orderBy('meetingDate', 'DESC')->take(10)->get();
        $data['slides'] = Slide::all();
        $data['announcements'] = Announcement::latest('created_at')->take(3)->get();;
        return view('home', $data);
    }

    public function stdl()
    {
        return redirect('http://162.210.199.3/Account/?ReturnUrl=%2fstudyprogram');
    }

    public function handbook()
    {
        $data['page_title'] = 'Staff Handbook';
        return view('handbook', $data);
    }


    public function counselling()
    {
        $data['page_title'] = 'Staff Counselling';
        return view('counselling', $data);
    }

    public function viewBirthday($id)
    {
        $staff = User::where('portalID', $id)->first();
        $data['page_title'] = 'Birthdays';
        $data['staff'] =  $staff;
        return view('view-birthday', $data);
    }
    public function addComment($id, Request $request)
    {

        $request->validate([
            'comment' => ['required', 'regex:/^[^<>]*$/'], // Disallow '<' and '>' characters
        ],
            [
                'comment.regex' => 'The comment must not contain HTML or script tags.'
            ]);
        $staff = User::where('portalID',$id)->first();
        $user = Session::get('user');

        $comment = new StaffComment();
        $comment->staff_id = $staff->id;
        $comment->portal_id = $user->portalID;
        $comment->name = $user->fullname();
        $comment->picture = $user->picturePath;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }

    public function adminDashboard()
    {
        $data['page_title'] = 'Dashboard';
        $month = date('n');
//        $data['birthdays'] = User::where('birth_month',$month)->get();
        $data['job_families'] = JobFamily::count();

        $data['staffs'] = User::count();
//        $data['notifiers'] = FirebaseToken::count();
        $data['announcements'] = Announcement::count();
        $data['slides'] = Slide::count();
        $data['regions'] = Region::count();
        $data['videos'] = Video::count();
        $data['streams'] = Stream::count();
        $data['staffevents'] = StaffEvent::count();
        $data['events'] = Event::count();
        $data['meetings'] = Meeting::count();
//        $data['assessments'] = Assessment::count();
        $data['programmes'] = Meeting::count();
//        $data['interactions'] = LiveInteractions::count();
        $data['dash_menu'] = true;
        return view('backend.dashboard', $data);
    }
}
