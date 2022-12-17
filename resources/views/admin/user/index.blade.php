@extends('admin.layouts.backend')
@section('title', 'Users')


@section('css_after')

@endsection

@section('js_after')

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-md-9 text-start">
                <div class="pt-4 pb-4">
                    <h4 class="text-muted mt-3">Users</h4>
                </div>
            </div>
            <div class="col-md-3 text-end my-auto pt-4 d-none d-sm-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none"
                                href="{{ route('admin.activities.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12 text-start">

                <div class="card p-3">

                    <div class="card-body">
                        <div class=" table-responsive " style="">
                            <table class="table-centered mb-0 table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Activity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ ucwords($user->full_name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ formatDate($user->created_at) }}</td>
                                            <td>{{ $user->activities_count }}</td>

                                            <td>
                                                <div class="flex-shrink-0 dropdown">
                                                    <a class="text-body dropdown-toggle font-size-16" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">

                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.users.activities', $user->id) }}">View
                                                            activities</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h3 class="text-muted">No record found</h3>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-wrapper text-end mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>




                </div>
            </div>


        </div>

    </div>


@endsection
