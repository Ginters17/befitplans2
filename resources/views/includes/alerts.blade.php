<script type="text/javascript" src="{{ asset('js/alerts.js') }}"></script>

@if (session()->has('success'))
<div class="alert alert-success fade show fixed-bottom mb-0 px-1 pl-3 pr-3" role="alert">
    <strong>Success!</strong> {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger fade show fixed-bottom mb-0 px-1 pl-3 pr-3" role="alert">
    <strong>Error!</strong> {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('errorWithLink'))
<div class="alert alert-danger fade show fixed-bottom mb-0 px-1 pl-3 pr-3" role="alert">
    <strong>Error!</strong> {{ session()->get('errorWithLink')[0] }}
    <a href="{{ session()->get('errorWithLink')[2] }}">{{ session()->get('errorWithLink')[1] }}</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('info'))
<div class="alert alert-info fade show fixed-bottom mb-0 px-1 pl-3 pr-3" role="alert">
    <strong>Info!</strong> {{ session()->get('info') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif