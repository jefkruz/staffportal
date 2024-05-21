<?php

namespace App\Http\Controllers;

use App\Models\JobFamily;
use App\Models\JobRole;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobFamilyController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Job Families';
        $data['job_fam_menu'] = true;
        $data['families'] = JobFamily::all();
        return view('backend.job_family.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create Job Family';
        $data['job_fam_menu'] = true;
        return view('backend.job_family.create', $data);
    }

    public function members($id)
    {
        $name = JobFamily::find($id)->name;
        $data['page_title'] = 'Manage '.$name.' Job Family';
        $data['job_fam_menu'] = true;
        $data['members'] = User::where('jobFamily', $id)->get();
        return view('backend.job_family.members', $data);
    }

    public function show($id)
    {
        $family = JobFamily::findOrFail($id);
        $data['page_title'] = 'View Job Family';
        $data['job_fam_menu'] = true;
        $data['family'] = $family;
        $data['roles'] = JobRole::where('family_id', $family->id)->get();
        return view('backend.job_family.show', $data);
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'family_id' => 'required',
            'name' => 'required'
        ]);

        $role = JobRole::whereName($request->name)->where('family_id', $request->family_id)->exists();
        if($role){
            return back()->with('error', 'Role exists already');
        }

        $role = new JobRole();
        $role->name = $request->name;
        $role->family_id = $request->family_id;
        $role->save();
        return back()->with('message', 'Role added');
    }

    public function deleteRole($id)
    {
        $role = JobRole::findOrFail($id);
        $role->delete();
        return back()->with('message', 'Role deleted');
    }

    public function fetchRoles(Request $request)
    {
        $request->validate([
            'family_id' => 'required'
        ]);

        $roles = JobRole::where('family_id', $request->family_id)->get();

        return response(['data' => $roles], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $exists = JobFamily::whereName($request->name)->exists();
        if($exists){
            return back()->with('error', 'Job family exists already');
        }

        $j = new JobFamily();
        $j->name = $request->name;
        $j->save();

        return to_route('jobFamily.index')->with('message', 'Job family created');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'kc_group' => 'required',
        ]);
        $family = JobFamily::findOrFail($request->id);

        $path = $family->image;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $accepted = ['jpg','png','jpeg'];
            $extension = $file->getClientOriginalExtension();
            if(!in_array($extension, $accepted)){
                return back()->with('error', 'Uploaded file is not in the right format');
            }

            $store = $file->store('images/families', env('DEFAULT_DISK'));

            $path = str_replace('images/families/', '', $store);

        }

        $family->name= $request->name;
        $family->kc_group = $request->kc_group;
        $family->image = $path;

        $family->save();
        return redirect()->back()->with('message', 'Job Family Updated');
    }

    public function destroy($id)
    {
        //
        $doc = JobFamily::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'Job Family Deleted');
    }

    public function joinKC()
    {
        $data['page_title'] = 'Join A KingsChat Group';
        $data['kc_group_menu'] = true;
        $data['families'] = JobFamily::all();
        return view('kc_group', $data);
    }


}
