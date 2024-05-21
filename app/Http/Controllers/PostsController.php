<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\ResourceComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Resource Centre';
        $data['resource_menu'] = true;
        $data['resources'] = Announcement::latest()->get();
        return view('backend.resources.index', $data);
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
        $data['page_title'] = $resource->title;
        $data['posts_menu'] = true;
        return view('view-post', $data);
    }

    public function addComment($id, $slug, Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $post = Announcement::whereIdAndSlug($id, $slug)->firstOrFail();
        $user = Session::get('user');

        $comment = new ResourceComment();
        $comment->resource_id = $post->id;
        $comment->user_id = $user->id;
        $comment->name = $user->title . ' ' . $user->firstname . ' ' . $user->lastname;
        $comment->picture = $user->profile_pic;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Resource';
        $data['resource_menu'] = true;
        $data['res'] = Announcement::findOrFail($id);
        return view('backend.resources.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Resource';
        $data['resource_menu'] = true;
        return view('backend.resources.create', $data);
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
            $path = $file->store('resource_center', env('DEFAULT_DISK'));
        }

        $p = new Announcement();
        $p->title = $request->title;
        $p->slug = Str::slug($request->title);
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();

        return to_route('resources.index')->with('message', 'Resource material added');
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
            $path = $file->store('resource_center', env('DEFAULT_DISK'));
        }


        $p->title = $request->title;
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();

        return to_route('resources.index')->with('message', 'Resource material updated');
    }

    public function delete($id)
    {
        $p = Announcement::findOrFail($id);
        foreach($p->comments() as $comment){
            $comment->delete();
        }
        $p->delete();
        return back()->with('message', 'Resource material deleted');

    }
}
