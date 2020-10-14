@extends('layouts.profile_front')
@section('title', 'プロフィール')
@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <h2>Myプロフィール一覧</h2>
        </div>
        <div class="row">
            <div class="headline col-md-10 mx-auto">
                <div class="row">
                    <div class="list-profile col-md-12 mx-auto">
                        <div class="row">
                            <table class="table">
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
                                        <th>{{ $profile->id }}</th>
                                        <td>{{ str_limit($profile->name, 30) }}</td>
                                        <td>{{ Str_limit($profile->gender, 10) }}</td>
                                        <td>{{ Str_limit($profile->hobby, 30) }}</td>
                                        <td>{{ Str_limit($profile->introduction, 100) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr color="#c0c0c0">
    </div>
@endsection