@extends('layouts.profile')
@section('title', 'プロフィールの編集')
@section('content')
　　<div class="container">
　　    <div class="row">
            <div class="col-md-8 mx-auto">
　　            <h2>プロフィールの編集</h2>
                <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                   @csrf
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別</label>
                        <div class="col-md-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="male" @if (old('gender', $profile_form->gender) == "male") checked @endif>
                                <label class="form-check-label">男性</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female" @if (old('gender', $profile_form->gender) == "female") checked @endif>
                                <label class="form-checke-label">女性</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="others" @if (old('gender', $profile_form->gender) == "others") checked @endif>
                                <label  class="form-check-label">その他</label>
                            </div>    
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="hobby">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ $profile_form->hobby }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="introduction">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ $profile_form->introduction }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->profile_histories != NULL)
                                @foreach ($profile_form->profile_histories as $profile_history)
                                    <li class="list-group-item">{{ $profile_history->edited_at }}</li>
                                @endforeach
                            @endif 
                        </ul>
                    </div>
                </div>    
            </div>
　　    </div>
　　</div>
@endsection