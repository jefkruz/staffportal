<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use App\Models\StaffEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

    public function showPosts()
    {
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Information Centre';
        $data['posts_menu'] = true;
        $data['posts'] = Announcement::latest()->paginate(9);
        return view('information-center', $data);
    }

    public function viewPost($id)
    {
        $resource = Announcement::whereId($id)->firstOrFail();
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['post'] = $resource;
        $data['page_title'] = 'View Post';
        $data['posts_menu'] = true;
        $data['back'] = true;
        return view('view-post', $data);
    }

    public function addComment($id,  Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $post = Announcement::whereId($id)->firstOrFail();
        $user = Session::get('user');

        $comment = new PostComment();
        $comment->post_id = $post->id;
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
        $data['res'] = StaffEvent::findOrFail($id);
        return view('backend.staff_events.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Event';
        $data['staff_events_menu'] = true;
        return view('backend.staff_events.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'post_body' => 'required'
        ]);

        $path = null;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('staff_events', env('DEFAULT_DISK'));
        }

        $p = new StaffEvent();
        $p->title = $request->title;
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
            'post_body' => 'required'
        ]);

        $p = StaffEvent::findOrFail($id);
        $path = $p->image;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('staff_events', env('DEFAULT_DISK'));
        }


        $p->title = $request->title;
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();

        return to_route('staff-events.index')->with('message', 'Event updated');
    }

    public function delete($id)
    {
        $p = StaffEvent::findOrFail($id);
        foreach($p->comments() as $comment){
            $comment->delete();
        }
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
