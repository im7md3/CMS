@extends('admin.app')

@section('breadcrumb')
    المستخدمين
@endsection

@section('content')

    <div class="container-fluid">
        
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>الإيميل </th>
        
                                <th>تاريخ الإنشاء </th>
                                
                                <th>تعديل دور المستخدم</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index=>$user)
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    
                                    <td>{{ $user->created_at }}</td>
                                    
                                    <td>
                                      <form method="POST" action="{{route('user.update',$user)}}" class="d-flex">
                                        @csrf
                                        @method('PATCH')
                                        <select class="form-control ml-2" name="role" id="">
                                          @foreach ($roles as $role)
                                              <option value="{{$role->id}}" @if ($user->role_id==$role->id)
                                                  selected
                                              @endif>{{$role->role}}</option>
                                          @endforeach
                                        </select>
                                        <button class="btn btn-outline-info">تعديل</button>
                                      </form>
                                    </td>
                                    <td class="">
                                        
                                        <form method="post" action="{{ route('user.destroy', $user) }}" class="text-center">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0"><i
                                                    class="fa fa-trash fa-2x text-danger"></i></button>
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
