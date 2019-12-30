@extends('layouts.index.app')
@section('content')
<section class="jumbotron text-center bg-light">
    <div class="container">
        <h1 class="font-weight-bold">Create Your SpyLink</h1>
        <form action="/link/create" method="post">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                {!!$errors->first()!!}
            </div>
            @endif
            <p class="lead text-muted">
                <div class="input-group mb-3 shadow">
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" placeholder="Paste your link here..." aria-label="Paste your link here..." aria-describedby="button-addon2" value="{{ old('url') }}">
                    <div class="input-group-append @error('url') is-invalid @enderror">
                        <button class="btn btn-primary @error('url') is-invalid @enderror" type="submit" id="button-addon2">Create</button>
                    </div>
                </div>
            </p>
        </form>
        <p>
            <small class="text-muted">
                SpyLink is in alpha stage which has very minimum features.
            </small>
        </p>
    </div>
</section>
@endsection