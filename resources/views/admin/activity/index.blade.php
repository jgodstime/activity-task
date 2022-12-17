@extends('admin.layouts.backend')
@section('title', 'Activity')


@section('css_after')

@endsection

@section('js_after')

    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>

    <script>
        var ckEditor;

        var allEditors = document.querySelectorAll('.ckeditor-textarea');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]).then(editor => {
                    //  console.log( editor );
                    ckEditor = editor;
                    // editor.getData(); // -> '<p>Foo!</p>'
                    // editor.updateElement('Good')
                })
                .catch(error => {
                    console.error(error);
                })
        }


        // For edit post
        function showEditPost(data = null, description = null) {
            console.log(description);

            var data = JSON.parse(data);

            document.getElementById("activity-title-edit").value = data.title;
            // document.getElementById("activity-date-edit").value = (data.date);

            ckEditor.setData(description)
            document.getElementById("activity-no").value = data.activity_no;

            $('#editPostModal').modal('show')
        }

        // For read more
        function readMore(title = null, description = null) {
            document.getElementById("read-more-title").innerHTML = title;
            document.getElementById("read-more-description").innerHTML = description;
            $('#readMoreModal').modal('show')
        }
    </script>

@endsection

@section('content')

    <div class="container-fluid mt-3">

        <div class="row mb-4">
            <div class="col-md-9 mt-3 text-start">
                <h3 class="text-muted">Activities</h3>
            </div>

            <div class="col-md-3 text-end my-auto pt-4 d-none d-sm-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('admin.activities.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Activities</li>
                    </ol>
                </nav>
            </div>
        </div>



        <div class="row mb-4">
            <div class="col-md-10">
                <form role="search" action="{{ url()->current() }}" method="get">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button
                                style="padding:16px;background-color: #fff;border-top-left-radius: 5px;border-bottom-left-radius: 5px;"
                                class="input-group-text text-white" id="basic-addon2"> <i class="fa fa-search"
                                    style="color: #C0C0C1" aria-hidden="true"></i> </button>
                        </div>
                        <input style="height:50px; border-top-right-radius: 5px;border-bottom-right-radius: 5px;"
                            type="text" class="form-control" name="title" placeholder="Search for events by title"
                            aria-label="Search for anything..." aria-describedby="basic-addon2">

                    </div>
                </form>

                @if (request()->title)
                    <div class="alert alert-info text-left" role="alert">
                        <h6>{{ $count ?? '' }} result(s) found for your search! &nbsp; <a
                                href="{{ url()->current() }}">Reset</a></h6>
                    </div>
                @endif
            </div>
            <div class="col-md-2 text-end">

                <a class="btn btn-primaryi text-white" data-bs-toggle="modal" data-bs-target="#addPostModal" href="#">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> New Activity</a>


            </div>

        </div>



        <div class="row">
            @forelse ($activities as $activity)
                @php
                    // description keys gives an improper object during convertion to js object, thats why this is done individually
                    $description = $activity->description;
                    $activity->description = null;
                @endphp


                <div class="col-md-4 mb-4">
                    <div class="blog-card">
                        <img class="card-img-top card-img-top-blog-main" src="{{ $activity->image }}" alt="Title">
                        <div class="date-blog px-3 pt-3 pb-0 d-flex justify-content-between">
                            <span><i class="mdi mdi-calendar-blank text-blue"></i> {{ formatDate($activity->date) }}
                            </span>

                            <div class="flex-shrink-0 dropdown">
                                <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <li>

                                        <a class="dropdown-item"
                                            onclick="showEditPost('{{ json_encode($activity, true) }}', '{{ $description }}')"
                                            href="javascript:void(0)">Edit</a>

                                    </li>

                                    <form action="{{ route('admin.activities.delete.global', $activity->activity_no) }}"
                                        method="post">
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this activity?')"
                                            class="remove-button-style" type="submit"> <span
                                                class="dropdown-item">Delete</span>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 pb-4">


                            <h4 class="card-title-2 text-muted mt-3"> {{ ucwords($activity->title) }}</h4>
                            <p class="card-text text-muted mb-4">
                                {{ strLimit($description, 150) }} <a href="#" class="text-decoration-none"
                                    onclick="readMore('{{ $activity->title }}', '{{ $description }}')">Read more</a>
                            </p>

                        </div>
                    </div>
                </div>
            @empty
            @endforelse

            <div class="pagination-wrapper text-end">
                {{-- {{ $activities->links() }} --}}
            </div>
        </div>



    </div>







    <!-- Add post modal -->
    <div class="modal fade " id="addPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-4 text-dark" id="exampleModalLabel">New Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.activities.store.global') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <p class="text-muted">Changes to your name will be reflected across your bhss Account.</p> --}}
                        <div class="row">


                            <div class="mb-3">
                                <label for="title" class="form-label"> Date</label>
                                <input type="date" class="form-control" name="date" id="event_date">
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Enter title">
                            </div>


                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="description" class="form-control ckeditor-textarea" placeholder="Enter body/description (Optional)"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="banner_image" class="form-label">Image</label>
                                <input required type="file" class="form-control" name="image" id="banner_image"
                                    placeholder="" aria-describedby="banner_image_i">
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primaryi-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primaryi">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update category modal -->
    <div class="modal fade " id="editPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-4 text-dark" id="exampleModalLabel">Edit Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.activities.update.global') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <p class="text-muted">Changes to your name will be reflected across your bhss Account.</p> --}}
                        <div class="row">

                            <input type="hidden" name="activity_no" id="activity-no" value="">

                            {{-- <div class="mb-3">
                                <label for="title" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" value="2022-12-17" id="activity-date-edit">
                            </div> --}}

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="activity-title-edit"
                                    placeholder="Enter title eg Parent">
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="description" id="post-description-edit" class="ckeditor-textarea"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="post_image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primaryi-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primaryi">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Read more modal -->
    <div class="modal fade " id="readMoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-4 text-dark" id="exampleModalLabel">
                        <span id="read-more-title"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div id="read-more-description"></div>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primaryi-outline" data-bs-dismiss="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-primaryi" data-bs-dismiss="modal">Done</button>
                </div>

            </div>
        </div>
    </div>




@endsection
