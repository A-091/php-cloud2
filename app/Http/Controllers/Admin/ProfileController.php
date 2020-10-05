<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profiles;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }
    public function create(Request $request)
    {
        $this->validate($request, profile::$rules);
        $profile = new profile;
        $form = $request->all();
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $profile->image_path = basename($path);
        } else {
            $profile->image_path = null;
        }
        unset($form['_token']);
        unset($form['image']);
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = profile::where('title', $cond_title)->get();
        } else {
        $posts = profile::all();
    }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' =>$profile]);
    }
    public function update(Request $request)
    {
        $this->validate($request, profile::$rules);
        $profile = profile::find($request->id);
        $profile_form = $request->all();
        if ($request->remove == 'true') {
            $profile_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profile_form['image_path'] = basename($path);
        } else {
            $profile_form['image_path'] = $profile->image_path;
        }
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();
        return redirect('admin/profile/');
    }
    public function delete(Request $request)
    {
        $profile = profile::find($request->id);
        $profile->delete();
        return redirect('admin/profile/');
    }
}
?>