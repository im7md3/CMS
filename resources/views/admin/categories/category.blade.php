@extends('admin.app')

@section('breadcrumb')
        إضافة تصنيف
@endsection

@section('content')

    <div class="container-fluid">
      <div class="card mb-3">
        
        <div class="card-header">
        <i class="fa fa-table"></i> إضافة التصنيفات
          <form method="post" action="{{ route('category.store') }}">
          @csrf
          <div class="row">
            
            <div class="col">
              <input type="text" class="form-control" name="title" placeholder="عنوان التصنيف" required>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary">حفظ </button>
            </div>
          </div>
        </form>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>الرقم</th>
                  <th>التصنيف</th>
                  <th>الإسم اللطيف</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل </th>
                  <th >تعديل</th>
                  <th >حذف</th>
                </tr>
              </thead>
              <tbody>
              @foreach($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{ $category->title }}</td>
                  <td>{{$category->slug}}</td>
                  <td>{{$category->created_at}}</td>
                  <td>{{$category->updated_at}}</td>
                  
                  <td>
                    <form method="post" action="{{ route('category.update',$category) }}" class="d-flex">
                        @csrf
                        @method('Patch')
                        <input type="text" class="form-control" name="title" placeholder="عنوان التصنيف" required>
                        <button type="submit" class="btn btn-primary mr-2">حفظ </button>
                    </form>
                  </td>
                   <td>
                    <form method="post" action="{{ route('category.destroy',$category) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link p-0 mr-2"><i class="fa fa-trash fa-2x text-danger"></i> </button>       
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
 
@endsection

@section('script')

@endsection