@extends('frontend.master')

@section('content')
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Password Reset Request Form</h4>
                    <p></p>
                    @if (session('reqsend'))
                        <div class="alert alert-success">
                            {{ session('reqsend') }}
                        </div>
                    @endif
                    <form  action="{{ route('guest.pass.reset.req.send') }}" class="sign-form widget-form " method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*" name="email" value="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-custom">Send Request</button>
                        </div>
                        <div class="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
