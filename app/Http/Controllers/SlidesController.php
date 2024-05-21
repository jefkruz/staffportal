<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlidesController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Slides';
        $data['slides_menu'] = true;
        $data['slides'] = Slide::all();
        return view('backend.slides.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([

            'file' => 'required|file'
        ]);

        $filePath = $request->file('file')->store('slides', env('DEFAULT_DISK'));

        $s = new Slide();
        $s->image = $filePath;
        $s->link = $request->link;
        $s->save();

        return back()->with('message', 'Slide added');
    }

    public function delete($id)
    {
        $s = Slide::findOrFail($id);
        $s->delete();
        return back()->with('message', 'Slide deleted');
    }
}
