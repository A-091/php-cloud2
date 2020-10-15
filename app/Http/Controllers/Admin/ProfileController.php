<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

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
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //データベースに保存
        $profile->fill($form);
        $profile->save(); //保存はsaveメソッドを使うだけ
        
        return redirect('admin/profile/');
    }
    public function edit(Request $request)
    {
        // profile Modelからデータを取得する
        $profile = profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' =>$profile]);
    }
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, profile::$rules);
        // profile Modelからデータを取得する
        $profile = profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);
        $profile->fill($profile_form);
        $profile->save();
        
        $profile_history = new ProfileHistory;
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
        return redirect('admin/profile/');
    }
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title !='') {
            $posts = profile::where('title',$cond_title)->get();
    } else {
        $posts = profile::all();
    }    
    return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    public function delete(Request $request)
    {
        $profile = profile::find($request->id);
        $profile->delete();
        return redirect('admin/profile');
    }
}

?>