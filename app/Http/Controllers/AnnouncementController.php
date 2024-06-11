<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\PostComment;
use App\Models\ResourcePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Information Center';
        $data['announcement_menu'] = true;
        $data['infos'] = Announcement::latest()->get();
        return view('backend.announcements.index', $data);
    }

    public function showAnnouncement()
    {
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Information Center';
        $data['resource_menu'] = true;
        $data['resources'] = Announcement::latest()->get();
        return view('announcements', $data);
    }

    public function viewAnnouncement($id, $slug)
    {
        $resource = Announcement::whereIdAndSlug($id, $slug)->firstOrFail();
//        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['resource'] = $resource;
        $data['page_title'] = $resource->title;
        $data['announcements_menu'] = true;
        return view('view_announcement', $data);
    }

//    public function addComment($id, $slug, Request $request)
//    {
//        $request->validate([
//            'comment' => 'required'
//        ]);
//        $post = ResourcePost::whereIdAndSlug($id, $slug)->firstOrFail();
//        $user = Session::get('user');
//
//        $comment = new ResourceComment();
//        $comment->resource_id = $post->id;
//        $comment->user_id = $user->id;
//        $comment->name = $user->title . ' ' . $user->firstname . ' ' . $user->lastname;
//        $comment->picture = $user->profile_pic;
//        $comment->comment = $request->comment;
//        $comment->save();
//
//        return back();
//    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Information';
        $data['announcement'] = true;
        $data['res'] = Announcement::findOrFail($id);
        return view('backend.announcements.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New  Information ';
        $data['announcement_menu'] = true;
        return view('backend.announcements.create', $data);
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
            $path = $file->store('notification_banners ', env('DEFAULT_DISK'));
        }

        $p = new Announcement();
        $p->title = $request->title;
        $p->slug = Str::slug($request->title);
        $p->body = $request->post_body;
        $p->banner = $path;
        $p->save();

//        $n = new WebNotificationsController();
//        $n->createNotification($p->title, 'announcement', $p->id,$p->slug);

        return to_route('announcements.index')->with('message', ' Information added');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'post_body' => 'required'
        ]);

        $p = Announcement::findOrFail($id);
        $path = $p->image;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('notification_banners ', env('DEFAULT_DISK'));
        }


        $p->title = $request->title;
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();

        return to_route('announcements.index')->with('message', ' Information updated');
    }

    public function delete($id)
    {
        $p = Announcement::findOrFail($id);
//        foreach($p->comments() as $comment){
//            $comment->delete();
//        }
        $p->delete();
        return back()->with('message', ' Information deleted');

    }
}
