@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                @can('show_user_list')
                <form action="{{ route('delete.check') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>User List <span class="float-right">Total: {{ $total_user }}</span></h3>
                        </div>
                        <div class="card-header">
                            <button type="submit" class="btn btn-danger">Delete Checked</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"> Check All</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($users as $sl=>$user)
                                <tr>
                                    <td><input type="checkbox" name="check[]" value="{{ $user->id }}"></td>
                                    <td>
                                        @if ($user->image == null)
                                        <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                                        @else
                                        <img width="50" src="{{ asset('uploads/user') }}/{{ $user->image }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @can('user_delete')
                                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                            <div class="py-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </form>
                @endcan
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
