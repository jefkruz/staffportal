<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use App\Models\EventComment;
use App\Models\EventImage;
use App\Models\School;
use App\Models\SchoolImage;
use App\Models\StaffEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StaffEventsController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Staff Events';
        $data['staff_events_menu'] = true;
        $data['infos'] = StaffEvent::latest()->get();
        $data['categories'] = EventCategory::latest()->get();
        return view('backend.staff_events.index', $data);
    }

    public function greetings($id,$slug)
    {
        $event = StaffEvent::whereIdAndSlug($id, $slug)->firstOrFail();


        $data['page_title'] = 'View More';
        $data['back'] = true;
        $data['event'] = $event;
        $data['images'] = EventImage::where('staff_event_id', $event->id)->get();
        return view('view_event', $data);
    }

    public function addComment($id, $slug, Request $request)
    {

        $request->validate([
            'comment' => ['required', 'regex:/^[^<>]*$/'], // Disallow '<' and '>' characters
        ],
            [
                'comment.regex' => 'The comment must not contain HTML or script tags.'
            ]);
        $event = StaffEvent::whereIdAndSlug($id, $slug)->firstOrFail();
        $user = Session::get('user');

        $comment = new EventComment();
        $comment->event_id = $event->id;
        $comment->portal_id = $user->portalID;
        $comment->name = $user->fullname();
        $comment->picture = $user->picturePath;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Event';
        $data['staff_events_menu'] = true;
        $data['categories'] = EventCategory::latest()->get();
        $data['res'] = StaffEvent::findOrFail($id);
        $data['image'] = EventImage::where('staff_event_id',$id)->first();
        return view('backend.staff_events.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Event';
        $data['categories'] = EventCategory::latest()->get();
        $data['staff_events_menu'] = true;
        return view('backend.staff_events.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'post_body' => 'required'
        ]);

        $path = null;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('staff_events', env('DEFAULT_DISK'));
        }


        $p = new StaffEvent();
        $p->title = $request->title;
        $p->category_id = $request->category_id;
        $p->slug = Str::slug($request->title);
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();


        return to_route('staff-events.index')->with('message', 'Event added');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);
        $p = new EventCategory();
        $p->name = $request->name;
        $p->save();

        return to_route('staff-events.index')->with('message', 'Event  Category added');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'post_body' => 'required'
        ]);

        $p = StaffEvent::findOrFail($id);
        $path = $p->image;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('staff_events', env('DEFAULT_DISK'));
        }


        $p->title = $request->title;
        $p->category_id = $request->category_id;
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('staff_events', env('DEFAULT_DISK'));
                $new = new EventImage();
                $new->staff_event_id = $p->id;
                $new->image = $path;
                $new->save();
            }
        }

        return to_route('staff-events.index')->with('message', 'Event updated');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'staff_event_id' => 'required',
            'image' => 'required'
        ]);

        $event = StaffEvent::findOrFail($request->staff_event_id);

        $image = $request->image;
        $arr1 = explode(";", $image);
        $arr2 = explode(",", $arr1[1]);
        $data = base64_decode($arr2[1]);


        $filename = Str::slug($event->name) . '-' . time() . '.png';
        $path = 'staff_events/' . $filename;

        Storage::disk(env('DEFAULT_DISK'))->put(
            $path,
            $data
        );

        $pic = new EventImage();
        $pic->staff_event_id = $event->id;
        $pic->path = url($path);
        $pic->save();

        return back()->with('message', 'Image uploaded');
    }

    public function deleteImage($id)
    {
        EventImage::find($id)->delete();
        return back()->with('message', 'Image deleted');
    }

    public function delete($id)
    {
        $p = StaffEvent::findOrFail($id);
//        foreach($p->comments() as $comment){
//            $comment->delete();
//        }
        $p->delete();
        return back()->with('message', 'Event deleted');

    }
    public function deleteCategory($id)
    {
        $p = EventCategory::findOrFail($id);

        $p->delete();
        return back()->with('message', 'Category deleted');

    }
}
