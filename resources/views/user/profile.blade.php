@extends('layouts.app')

@section('content')
<div class="container text-muted">
    <div class="row  bg-white p-3 mb-4">
        <div class="col-md-3 text-center">                      
            <img class="profile mb-2" src="{{asset($user->avatar) }}" alt="" />
        </div>

        <div class="col-md-9 text-md-right text-center">
            <h2>{{$user->name}}</h2>
            <p class="word-break">{{ $user->bio }}</p>   
            <a href="{{ $user->website }}"> {{ $user->website}}</a>   
        </div>
    </div>

    <div class="row p-3">
        <div  class="col-md-12">
            <ul class="nav nav-tabs mb-3">
                @php
                    $user_id = $user->id;
                    $comments = Route::current()->getName() == 'user_comments';
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ $comments ? '' : 'active' }}" href="{{ route('profile',$user_id) }}">المشاركات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $comments ? 'active' : '' }}" href="{{ route('user_comments',$user_id) }} ">التعليقات</a>
                </li>
            </ul>

            @if ($comments)
                @include('user.comments_section')
            @else
                @include('user.posts_section')
            @endif
        </div>
    </div>   
</div>
@endsection