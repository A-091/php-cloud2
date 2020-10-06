<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

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
        unset($form['_token']);
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    public function edit(Request $request)
    {
        $profile = profile::find($request->id);
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
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();
        return redirect('admin/profile/');
    }
}
?>