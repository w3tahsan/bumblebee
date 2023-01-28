@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit User Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <h5>{{ $users->name }}<span class="float-right badge badge-success">
                                @foreach ($users->getRoleNames() as $role)
                                    {{ $role }}
                                @endforeach
                            </span></h5>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="user_id" value="{{ $users->id }}">
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input {{($users->hasPermissionTo($permission->name))?'checked':''}} type="checkbox" name="permission[]" class="form-check-input" value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                        <i class="input-frame"></i></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
