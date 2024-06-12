<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentHead;
use App\Models\Director;
use App\Models\Feedback;
use App\Models\JobFamily;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffCounselling;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function profile()
    {
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();

//        $roles = ($staff->family()) ? Role::where('family_id', $staff->family()->id)->get() : [];
        $data['page_title'] = 'Your Profile';
//        $data['roles'] = $roles;
        $data['profile_menu'] = true;
        $data['user'] = Session::get('user');
        $data['families'] = JobFamily::all();
        return view('profile', $data);
    }

    public function allStaff()
    {
        $data['page_title'] = 'Staff Members';
        $data['members'] = User::all();
        $data['staff_menu'] = true;
        return view('backend.staff.index', $data);
    }

    public function allStaffProfile()
    {
        $data['page_title'] = 'Staff Members Profile';
        $data['members'] = Staff::whereNotNull('kc_username')->get();
        $data['staff_menu'] = true;
        return view('backend.staff.all', $data);
    }

    public function showStaffMembers()
    {
        $user = Session::get('user');
        if(!$user->isDirector()){
            return back();
        }
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Staff Members';
        $data['members'] = Staff::all();
        $data['staff_menu'] = true;
        return view('staff_members', $data);
    }

    public function directorViewStaff($id)
    {
        $user = Session::get('user');
        if(!$user->isDirector()){
            return back();
        }
        $staff = Staff::findOrFail($id);
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
//        $head = DepartmentHead::where('department_id', $staff->department_id)->first();
//        $director = Director::where('department_id', $staff->department_id)->first();
//        $data['isDeptHead'] = $staff->isDepartmentHead();
//        $data['isDirector'] = $staff->isDirector();
        $data['page_title'] = 'View Staff Member';
        $data['staff'] = $staff;
//        $data['deptHead'] = $head;
//        $data['director'] = $director;
        $data['staff_menu'] = true;
        return view('view_staff', $data);
    }

    public function viewStaff($id)
    {
        $staff = Staff::findOrFail($id);
        $head = DepartmentHead::where('department_id', $staff->department_id)->first();
        $director = Director::where('department_id', $staff->department_id)->first();
        $data['isDeptHead'] = $staff->isDepartmentHead();
        $data['isDirector'] = $staff->isDirector();
        $data['page_title'] = 'View Staff Member';
        $data['member'] = $staff;
        $data['deptHead'] = $head;
        $data['director'] = $director;
        $data['staff_menu'] = true;
        return view('backend.staff.show', $data);
    }

    public function setAsDepartmentHead($id)
    {
        $staff = Staff::findOrFail($id);
//        $head = DepartmentHead::where('department_id', $staff->department_id)->first();
//        if(!$head){
            $head = new DepartmentHead();
            $head->department_id = $staff->department_id;
//        }
        $head->staff_id = $staff->id;
        $head->save();
        return back()->with('message', 'Staff has been added as departmental head');
    }

    public function setAsDirector($id)
    {
        $staff = Staff::findOrFail($id);
        $head = Director::where('department_id', $staff->department_id)->first();
        if(!$head){
            $head = new Director();
            $head->department_id = $staff->department_id;
        }
        $head->staff_id = $staff->id;
        $head->save();
        return back()->with('message', 'Staff has been set as director');
    }

    public function directors()
    {
        $data['page_title'] = 'Directors';
        $data['members'] = Director::all();
        $data['director_menu'] = true;
        return view('backend.staff.directors', $data);
    }

    public function deptHeads()
    {
        $data['page_title'] = 'Departmental Heads';
        $data['members'] = DepartmentHead::all();
        $data['dept_menu'] = true;
        return view('backend.staff.dept_heads', $data);
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'family_id' => 'required',
            'age_range' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
            'birth_date' => 'required',
            'birth_month' => 'required',
            'nok' => 'required',
            'nok_phone' => 'required',
            'residential_address' => 'required',
            'office_address' => 'required',
            'ministry_awards' => 'array', // Ensure it's an array
            'ministry_awards.*' => 'present|string', // Each item should be a string or null
            'employment_date' => 'required',
            'qualifications' => 'array',
            'qualifications.*' => 'present|string',
            'university' => 'required'
        ],
        [
            'ministry_awards.*.present' => 'Each item in the ministry awards field must be present.',
            'ministry_awards.*.string' => 'Each item in the ministry awards field must be filled.',
            'qualifications.*.present' => 'Each item in the ministry awards field must be present.',
            'qualifications.*.string' => 'Each item in the ministry awards field must be filled.',

        ]);

        if (!$request->has('ministry_awards')) {
            $request->merge(['ministry_awards' => [null]]);
        }
        if (!$request->has('qualifications')) {
            $request->merge(['qualifications' => [null]]);
        }

//        return $request;


        $staff = Session::get('user');
        $user = Staff::find($staff->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->family_id = $request->family_id;
        $user->age_range = $request->age_range;
        $user->birth_date = $request->birth_date;
        $user->birth_month = $request->birth_month;
        $user->anniversary = $request->anniversary;
        $user->nok = $request->nok;
        $user->nok_phone = $request->nok_phone;
        $user->residential_address = $request->residential_address;
        $user->office_address = $request->office_address;
        $user->children = $request->children;
        $user->kc_username = $request->kc_username;
        $user->ministry_awards =json_encode($request->ministry_awards);
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->employment_date = $request->employment_date;
        $user->qualifications = json_encode($request->qualifications);
        $user->university = $request->university;
        $user->profile_updated = true;
        $user->save();

        session()->put('user', $user);
        return back()->with('message', 'Profile updated successfully');
    }

    public function updateBasicProfile(Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'family_id' => 'required',
            'kc_username' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
        ]);
        $staff = Session::get('user');
        $user = Staff::find($staff->id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->family_id = $request->family_id;
        $user->phone = $request->phone;
        $user->kc_username = $request->kc_username;
        $user->role_id = $request->role_id;
        $user->save();

        session()->put('user', $user);
        return back()->with('message', 'Basic Profile updated successfully');
    }
    public function updateFamilyProfile(Request $request)
    {

        $request->validate([
            'age_range' => 'required',
            'birth_date' => 'required',
            'birth_month' => 'required',
            'nok' => 'required',
            'nok_phone' => 'required',
            'residential_address' => 'required',
            'office_address' => 'required',
        ]);
        $staff = Session::get('user');
        $user = Staff::find($staff->id);

        $user->age_range = $request->age_range;
        $user->birth_date = $request->birth_date;
        $user->birth_month = $request->birth_month;
        $user->anniversary = $request->anniversary;
        $user->nok = $request->nok;
        $user->nok_phone = $request->nok_phone;
        $user->residential_address = $request->residential_address;
        $user->office_address = $request->office_address;
        $user->children = $request->children;
        $user->save();
        session()->put('user', $user);
        return back()->with('message', 'Family Profile updated successfully');
    }

    public function updateMinistryProfile(Request $request)
    {
        $request->validate([


            'ministry_awards' => 'array',
            'ministry_awards.*' => 'present|string',
            'employment_date' => 'required',
            'qualifications' => 'array',
            'qualifications.*' => 'present|string',
            'university' => 'required'
        ],

            [
                'ministry_awards.*.present' => 'Each item in the ministry awards field must be present.',
                'ministry_awards.*.string' => 'Each item in the ministry awards field must be filled.',
                'qualifications.*.present' => 'Each item in the ministry awards field must be present.',
                'qualifications.*.string' => 'Each item in the ministry awards field must be filled.',

            ]);

        if (!$request->has('ministry_awards')) {
            $request->merge(['ministry_awards' => [null]]);
        }
        if (!$request->has('qualifications')) {
            $request->merge(['qualifications' => [null]]);
        }

//        return $request;


        $staff = Session::get('user');
        $user = Staff::find($staff->id);

        $user->ministry_awards =json_encode($request->ministry_awards);
        $user->employment_date = $request->employment_date;
        $user->qualifications = json_encode($request->qualifications);
        $user->university = $request->university;
        $user->profile_updated = true;
        $user->save();

        session()->put('user', $user);
        return back()->with('message', 'Ministry Profile updated successfully');
    }


    public function birthdays()
    {
        $data['page_title'] = 'Staff Birthdays';
        $data['i'] = 1;
        $data['birthday_menu'] = true;
        $month = date('n');
        $data['members'] = Staff::where('birth_month',$month)->get();
        return view('backend.staff.birthdays',$data);
    }


    public function feedback()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $staff = Session::get('user');
        $data['page_title'] = 'Feedback Form';
        $data['staff'] = $staff;
        $data['feedback_menu'] = true;
        return view('feedback', $data);
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'title' => 'required',
            'feedback' => 'required',

        ]);
        $feedback = new Feedback();
        $feedback->staff_id = $request->staff_id;
        $feedback->title = $request->title;
        $feedback->feedback = $request->feedback;
        $feedback->save();
        return back()->with('message', 'Feedback Submitted');
    }



    public function deleteHod($id)
    {
        $doc = DepartmentHead::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'HOD Deleted');
    }

    public function bulkDelete()
    {

        DepartmentHead::truncate();

        return redirect()->back()->with('message', 'All  HOD records have been deleted.');
    }

    public function updateFromPortal()
    {
        $credentials = session('credentials');
        $auth = new AuthController();
        $login =$auth->staffPortalLogin($credentials['portal_id'], $credentials['password']);
        if($login['status']){
            $staff = Staff::where('portal_id', $credentials['portal_id'])->first();

            $staff->rank = $login['data']->rankName;
            $staff->designation = $login['data']->designation;
            $dept = $login['data']->deptName;
            $d = Department::whereName($dept)->first();
            if(!$d){
                $d = new Department();
                $d->name = $dept;
                $d->save();
            }
            $staff->department_id = $d->id;
            $staff->save();
            session()->put('user', $staff);
            return back()->with('message', 'Updated Successfully');

        }
        return back()->with('error', $login['message']);


    }

    public function bookCounselling(Request $request)
    {
        $request->validate([
           'topic'=>'required',
        ]);

        $topic = $request->topic;
        if ($topic == 'others'){
            $topic = $request->title;
        }
        $staff = Session::get('user');
        $counselling = new StaffCounselling();
        $counselling->portal_id = $staff->portalID;
        $counselling->topic = $topic;
        $counselling->save();
        return back()->with('message', 'We will get back to you within 7 days.');

     }

}
