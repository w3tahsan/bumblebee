@extends('frontend.master')

@section('content')
 <!--Login-->
 <section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    @if (session('reqsend'))
                            <div class="alert alert-success">
                                {{ session('reqsend') }}
                            </div>
                    @endif
                    <!--form-->
                    <form action="{{ route('guest.store') }}" class="sign-form widget-form" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username*" name="name" value="">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address*" name="email" value="">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{ route('guest.login') }}" class="btn-link">Login</a> </p>
                    </form>
                       <!--/-->
                </div>
            </div>
         </div>
    </div>
</section>
@endsection
