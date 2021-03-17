@extends('admin.app')

@section('breadcrumb')
        الأدوار
@endsection

@section('content')

    <div class="container-fluid">
      <div class="card mb-3">
        
        <div class="card-header">
        <i class="fa fa-table"></i> إضافة دور
          <form method="post" action="{{ route('role.store') }}">
          @csrf
          <div class="row">
            
            <div class="col">
              <input type="text" class="form-control" name="role" placeholder="اسم الدور" required>
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
                  <th>الدور</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل </th>
                  <th >تعديل</th>
                  <th >حذف</th>
                </tr>
              </thead>
              <tbody>
              @foreach($roles as $index=>$role)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{ $role->role }}</td>
                  <td>{{$role->created_at}}</td>
                  <td>{{$role->updated_at}}</td>
                  
                  <td>
                    <form method="post" action="{{ route('role.update',$role) }}" class="d-flex">
                        @csrf
                        @method('Patch')
                        <input type="text" class="form-control" name="title" placeholder="اسم الدور" required>
                        <button type="submit" class="btn btn-primary mr-2">حفظ </button>
                    </form>
                  </td>
                   <td>
                    <form method="post" action="{{ route('role.destroy',$role) }}">
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