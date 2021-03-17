@includewhen(!count($user->posts),'alerts.empty',['msg' => 'لا توجد أي مشاركات بعد'])

<div class="row mb-2">
    @foreach ($user->posts as $post)
        <div class="col-lg-3 col-md-4 text-center">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                </div>

                <div class="d-flex py-2 px-3">
                    @can('edit-post', $post)
                    <a class="btn btn-outline-info ml-auto" href="{{ route('posts.edit', $post) }}">تعديل</a>
                    
                        
                    @endcan
                    @can('delete-post', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger"
                                onclick="return confirm('هل تريد حذف المنشور')">حذف</button>
                        </form>
                    @endcan


                </div>

            </div>

        </div>
    @endforeach
</div>
