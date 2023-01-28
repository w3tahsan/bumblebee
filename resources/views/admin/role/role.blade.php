@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Role</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>Role List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($roles as $sl=>$role)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->getAllPermissions() as $permission)
                                    <span class="badge badge-primary">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>User List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl=>$user)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge badge-success">{{ $role }}</span>
                                @empty
                                    <span class="badge badge-secondary">Not Assigned</span>
                                @endforelse
                                </td>
                                <td>
                                    @forelse ($user->getAllPermissions() as $permission)
                                        <span class="badge badge-warning">{{ $permission->name }}</span>
                                    @empty
                                        <span class="badge badge-secondary">Not Assigned</span>
                                    @endforelse
                                </td>
                            <td>
                                <a href="{{ route('edit.user.role.permission', $user->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('remove.role', $user->id) }}" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3>Add Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="permission_name">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Permission</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Add Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="role_name" placeholder="Role Name">
                        </div>
                        <div class="mb-3">
                            <h4>Permission</h4>
                            <div class="form-group">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="checkbox" name="permission[]" class="form-check-input" value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                        <i class="input-frame"></i></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Role</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign.role') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="user_id" class="form-control user_id" >
                                <option value=""> -- Select User --</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="role_id" class="form-control">
                                <option value=""> -- Select Role --</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Assign Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
        $('.user_id').select2();
    });
</script>
@endsection
