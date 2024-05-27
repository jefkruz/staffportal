<?php

namespace App\Http\Controllers;

use App\Models\EventAttendance;
use App\Models\Event;
use App\Models\MeetingAttendance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventsController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Events';
        $data['events'] = KingspassEvent::latest()->get();
        $data['events_menu'] = true;
        return view('backend.events.index', $data);
    }

    public function manage($id)
    {
        $data['viewers'] = EventAttendance::where('event_id',$id)->get();
        $data['events_menu'] = true;
        $data['id'] = $id;
        $title = KingspassEvent::where('id',$id)->value('title');
        $data['page_title'] = $title . ' Attendance Records';
        return view('backend.events.manage', $data);
    }

    public function sortByJobFamily($id)
    {
        $data['viewers'] = EventAttendance::where('event_id',$id)->get();
        $data['events_menu'] = true;
        $data['id'] = $id;
        $title = KingspassEvent::where('id',$id)->value('title');
        $data['page_title'] = $title . ' Attendance Records';
        $data['families'] = EventAttendance::where('event_id', $id)
            ->join('staff', 'event_attendances.user_id', '=', 'staff.id')
            ->join('job_families', 'staff.family_id', '=', 'job_families.id')
            ->select('staff.family_id', 'job_families.name', \DB::raw('COUNT(staff.id) as user_count'))
            ->groupBy('staff.family_id', 'job_families.name')
            ->get();
        return view('backend.events.sort', $data);
    }


    public function showEvents()
    {


        $user = Session::get('user');
        $events = KingspassEvent::latest()->get();
        foreach ($events as $event) {
           if ($event->accepted() && $event->event_type == 'portal') {
               $data = [
                   'eventID' => $event->id,
                   'portalID' => $user->portal_id,
               ];

               $json = json_encode($data);
               $qrCode = QrCode::size(300)
                   ->color( 0, 0,255)
                   ->backgroundColor(255, 255, 255)
                   ->generate($json);

               $event->qr_code = $qrCode;
           }

        }
        $data['events'] = $events;
        $data['page_title'] = 'Events';
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();

        $data['events_menu'] = true;
        return view('events', $data);
    }

    public function acceptEvent(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'phone' => 'required'
        ]);


        $user = Session::get('user');

        $ev = EventAttendance::where('portalID', $user->portalID)->where('meetingID', $request->event_id)->exists();
        if(!$ev){

            $event = Event::where('meetingID',$request->event_id)->first();

            $curl = curl_init();

            $phone = urlencode($request->phone);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://kingspass.org/api/public/attendees',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => "title=$user->title&firstname=$user->firstname&lastname=$user->lastname&phone_number=$phone&ticket_id=$event->ticket_id",
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'X-EVENT-TOKEN: ' . $event->event_key,
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $resp = json_decode($response);

            $ev = new EventAttendance();
            $ev->portalID = $user->portalID;
            $ev->meetingID = $event->meetingID;
            $ev->save();

        }

        return back()->with('message', 'Event accepted');
    }

    public function acceptPortalEvent($id)
    {
        $event_id = $id;

        $user = Session::get('user');

        $ev = EventAttendance::where('user_id', $user->id)->where('event_id', $event_id)->exists();
        if(!$ev){

            $event = KingspassEvent::findOrFail($event_id);



            $ev = new EventAttendance();
            $ev->user_id = $user->id;
            $ev->event_id = $event->id;
            $ev->phone = $user->phone;
            $ev->save();

        }
        return back()->with('message', 'Event accepted');
    }

    public function fetchTickets(Request $request)
    {
        $request->validate([
            'event_key' => 'required'
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://kingspass.org/api/public/tickets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-EVENT-TOKEN: ' . $request->event_key
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response);

        return response(['data' => $resp], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|file',
            'ticket_name' => 'required_if:event_type,kingschat',
            'ticket_color' => 'required_if:event_type,kingschat',
            'event_key' => 'required_if:event_type,kingschat',
            'event_type' => 'required',
            'ticket' => 'required_if:event_type,kingschat',
        ]);

        if($request->event_type == 'portal'){
            $request->ticket_color = '#236EE7';
            $request->ticket = 'CPDP';
        }

        $filePath = $request->file('file')->store('events', env('DEFAULT_DISK'));


        $ev = new KingspassEvent();
        $ev->title = $request->title;
        $ev->event_key = $request->event_key;
        $ev->event_type = $request->event_type;
        $ev->image = $filePath;
        $ev->ticket_id = $request->ticket;
        $ev->ticket_name = $request->ticket_name;
        $ev->ticket_colour = $request->ticket_color;
        $ev->save();

        $n = new WebNotificationsController();
        $n->createNotification('Accept Event: ' . $ev->title, 'event');

        return back()->with('message', 'Event Created');
    }

    public function edit($id)
    {
        $data['event'] = KingspassEvent::findOrFail($id);
        $data['page_title'] = 'Edit Event';
        $data['events_menu'] = true;
        return view('backend.events.edit', $data);
    }



    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|file',

        ]);
        $filePath = $request->file('file')->store('events', env('DEFAULT_DISK'));


        $post = KingspassEvent::findOrFail($id);
        $post->title = $request->title;
        $post->event_count = $request->event_count;
        $post->image = $filePath;
        $post->save();

        return to_route('events.index')->with('message', 'Event updated');
    }

    public function destroy($id)
    {

        $doc = KingspassEvent::findOrFail($id);
        $doc->delete();
        return redirect()->back()->with('message', 'Event Deleted');
    }
}
