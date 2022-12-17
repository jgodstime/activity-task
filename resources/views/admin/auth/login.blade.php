@extends('admin.layouts.bare')
@section('title', 'Login')


@section('css_after')
    <style>
        body{
            
        }
    </style>
@endsection

@section('js_after')

@endsection

@section('content')
<!--Main layout-->
<section class="bg-image">
    <div class="row mt-5 mb-5">
        <div class="col-md-6 offset-md-3">

            <div class="" style="background: #FFFFFF;
            box-shadow: 0px 5px 40px 1px rgba(106, 67, 103, 0.12);
            border-radius: 8px;">

                <div class="card-body px-4">
                    <h3 class="mt-4">Welcome back! Sign in</h3>
                    <p>
                        {{-- /if previos url issset and previouse url doesnt contain tribearc domain or its not tribearc domain then display --}}
                        {{-- @if (url()->previous() && !strpos(url()->previous(), request()->getHttpHost()) !== false)
                        to continue to <a target="_blank" href="{{url()->previous()}}">{{url()->previous()}}</a> --}}
                    </p>
                        {{-- @endif --}}


                    <form method="POST" action="{{route('login.post')}}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input type="email" name="email" id="form3Example3" class="form-control" />
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" name="password" id="form3Example4" class="form-control" />
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>


                        <div class="mb-4">
                            <button type="submit" style="width:100%;" class="btn btn-blue col-12 ">Login</button>
                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>
</section>
<!--Main layout-->
@endsection
