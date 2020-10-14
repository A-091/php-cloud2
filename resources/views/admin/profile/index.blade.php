@extends('layouts.admin')
@section('title','登録済みプロフィールの一覧')
@section('content')
<div class="container">
    <div class="row">
        <h2>Myプロフィール一覧</h2>
    </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ProfileController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">名前</th>
                        <th width="10%">性別</th>
                        <th width="25%">趣味</th>
                        <th width="30%">自己紹介</th>
                    </tr>
                    </thead>
                <tbody>
                @foreach($posts as $profile)
                    <tr>
                        <th>{{ $profile->name }}</th>
                        <td>{{ str_limit($profile->gender, 10) }}</td>
                        <td>{{ str_limit($profile->hobby, 50) }}</td>
                        <td>{{ str_limit($profile->introduction, 200) }}</td>
                        <td>
                    <div>
                        <a href="{{ action('Admin\ProfileController@edit', ['id' => $profile->id]) }}">編集</a> 
                    </div>
                    <div>
                        <a href="{{ action('Admin\ProfileController@delete', ['id' => $profile->id]) }}">削除</a>
                    </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection