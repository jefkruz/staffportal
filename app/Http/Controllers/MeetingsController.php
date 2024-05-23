<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MeetingsController extends Controller
{
    public function index()
    {
        $programmes = Meeting::latest()->get();
//        foreach($programmes as $programme){
//            $programme->startSeconds = strtotime($programme->start_date);
//            $programme->endSeconds = strtotime($programme->end_date);
//        }
        $data['page_title'] = 'Live Programmes';
        $data['programmes'] = $programmes;
        $data['streams'] = Stream::all();
        $data['meet_menu'] = true;
        return view('backend.meetings.index', $data);
    }

    public function manage($id)
    {
        $data['viewers'] = MeetingAttendance::where('meeting_id',$id)->get();
        $data['meet_menu'] = true;
        $title = Meeting::where('id',$id)->value('title');
        $data['page_title'] = $title . ' Attendance Records';
        return view('backend.meetings.manage', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'stream_link' => 'required',
            'start_date' => 'required',
            'accessibility' => 'required',
            'end_date' => 'required'
        ]);

        $ev = new Meeting();
        $ev->title = $request->title;
        $ev->stream_link = $request->stream_link;
        $ev->start_date = date("Y-m-d H:i:s", ($request->start_date / 1000));
        $ev->end_date = date("Y-m-d H:i:s", ($request->end_date / 1000));
        $ev->accessibility = $request->accessibility;
        $ev->unique_code = 'LWSP-' . time();
        $ev->save();

//        $n = new WebNotificationsController();
//        $n->createNotification($ev->title, 'programme', $ev->id);

        return back()->with('message', 'Programme created');

    }

    public function showMeetings()
    {
        $isAdmin = session('user')->isDepartmentHead();
        $programmes = Meeting::where('end_date', '>=', date('Y-m-d H:i:s'))->ofType($isAdmin)->latest()->get();
        foreach($programmes as $programme){
            $programme->startSeconds = strtotime($programme->start_date);
        }
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Live Programmes';
        $data['meet_menu'] = true;
        $data['meetings'] = $programmes;
        return view('meetings', $data);
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'meeting' => 'required'
        ]);

        $user = Session::get('user');
        $att = MeetingAttendance::where('meeting_id', $request->meeting)->where('user_id', $user->id)->first();

        if(!$att){
            $att = new MeetingAttendance();
            $att->user_id = $user->id;
            $att->meeting_id = $request->meeting;
            $att->save();
        }

        return response(['status' => true], 200);
    }

    public function attendMeeting($code)
    {
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $meeting = Meeting::where('unique_code', $code)->firstOrFail();
        if(!$meeting->isLive()){
            return back();
        }

        $data['page_title'] = 'Now Live: ';
        $data['meeting'] = $meeting;
        $data['meet_menu'] = true;
        return view('watch_meeting', $data);
    }

    public function edit($id)
    {
        $data['meeting'] = Meeting::findOrFail($id);
        $data['page_title'] = 'Edit Meeting';
        $data['meet_menu'] = true;
        return view('backend.meetings.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'stream_link' => 'required',
            'accessibility' => 'required',
        ]);

        $post = Meeting::findOrFail($id);

        $post->title = $request->title;
        $post->stream_link = $request->stream_link;
        $post->meeting_count = $request->meeting_count;
        $post->accessibility = $request->accessibility;
        $post->save();

        return to_route('meetings.index')->with('message', 'Meeting updated');
    }

    public function destroy($id)
    {
        //
        $doc = Meeting::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'Meeting Deleted');
    }
}
