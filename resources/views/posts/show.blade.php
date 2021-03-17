@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="content bg-white p-5">
            <div class="d-flex">
                <div class="info d-flex align-items-center ">
                    <img width="64" height="64" class="rounded-circle" src="{{ asset($post->user->avatar) }}" alt="">
                    <h6 class="mr-2"><a href="">{{ $post->user->name }}</a></h6>
                </div>

                <div class="op d-flex align-items-center mr-auto">
                    @can('edit-post', $post)
                        <a class="btn btn-outline-info ml-2" href="{{ route('posts.edit', $post) }}">تعديل</a>
                    @endcan
                    @can('delete-post', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" onclick="return confirm('هل تريد حذف المنشور')">حذف</button>
                        </form>
                    @endcan

                </div>


            </div>
            <h2 class="my-4">
                {{ $post->title }}
            </h2>
            <img class="card-img-top mb-4" src="{{ $post->image_path }}" alt="">

            <div style="word-break: break-word;">{{ $post->body }}</div>

            <!-- comments form -->
            <div class="row form-group mt-5">
                <div class="col-lg-11 col-md-6 col-xs-11">
                    <h3> التعليقات : </h3>
                    <form action=" {{ route('comment.store') }} " id="comments" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                    </form>
                </div>
            </div>
        </div>
        <div id="comments" class="word-break container mt-5">
            @include('comments.all')
        </div>
    </div>

    @include('partials.sidebar')

@endsection
