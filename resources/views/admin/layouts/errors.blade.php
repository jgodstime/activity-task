@if($errors->any())
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="alert alert-danger text-start">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    </div>
</div>

@endif
