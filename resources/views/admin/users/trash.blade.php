@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <form action="{{ route('hard.delete.check') }}" method="POST">
                @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Trash User List <span class="float-right">Total: {{ $total_user }}</span></h3>
                </div>
                <div class="card-header">
                    <button name="click" value="1" type="submit" class="btn btn-danger">Delete Checked</button>
                    <button name="click" value="2" type="submit" class="btn btn-success">Restore Checked</button>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th><input type="checkbox" id="checkAll"> Check All</th>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl=>$user)
                        <tr>
                            <td><input type="checkbox" name="check[]" value="{{ $user->id }}"></td>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->image == null)
                                <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                                @else
                                <img width="50" src="{{ asset('uploads/user') }}/{{ $user->image }}" alt="">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.restore', $user->id) }}" class="btn btn-success">Restore</a>
                                <a href="{{ route('user.delete.hard', $user->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endsection

