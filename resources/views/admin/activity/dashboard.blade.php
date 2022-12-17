@php
    $user = auth()->user();
    $title = $user->full_name;
@endphp
@extends('admin.layouts.backend')
@section('title', $title)



@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 text-start">
                <div class="pt-4 pb-4">
                    <h4 class="text-muted mt-3">Welcome back <strong> {{ auth()->user()->full_name }}!</strong></h4>

                </div>
            </div>
        </div>


        <div class="row text-muted">
            <div class="col-xl-4 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h3 class="">{{ $activityForTodayCount }}</h3>
                                <p class="mb-0">Todays Activity</p>
                            </div>
                            <div class="align-self-center">
                                <a type="button" style="background: #FFA233;"
                                    class="btn-floating btn-lg lighten-1 ml-4 waves-effect waves-light"><i
                                        class="fas fa-users" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h3>{{ $activityCreatedTodayCount }}</h3>
                                <p class="mb-0">Activities Created Today</p>
                            </div>
                            <div class="align-self-center">
                                <a type="button" style="background: #092D85;"
                                    class="btn-floating btn-lg ml-4 waves-effect waves-light"><i class="fa fa-bullhorn"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h3 class="">{{ $totalActivity }}</h3>
                                <p class="mb-0">Total Activities</p>
                            </div>
                            <div class="align-self-center">
                                <a type="button" style="background: #D90000;"
                                    class="btn-floating btn-lg ml-4 waves-effect waves-light"> <i class="fa fa-users"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




        <div class="row mb-5">

            <div class="col-md-12 text-start">

                <div class="card p-3">

                    <div class="card-body">
                        <h4 class="text-muted mb-3">Users</h4>

                        <div class=" table-responsive" style="">
                            <table class="table-centered mb-0 table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ ucwords($user->full_name) }}</td>
                                            <td>{{ $user->email }}</td>

                                        </tr>
                                    @empty
                                    @endforelse





                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
            </div>

        </div>

    @endsection
