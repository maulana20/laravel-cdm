@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 col-lg-offset-1">
        <div class="card">
            <h3 class="card-header">create</h3>
            <div class="card-body">
                
                @if ($errors->any())
                    <validation-error :errors="'{{ json_encode($errors->all()) }}'"></validation-error>
                @endif
                
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {!! session()->get('success') !!}
                    </div>
                @endif
                
                <form action="{{ route('paper.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Paper Title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">sub title</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Paper Sub Title" value="{{ old('subtitle') }}">
                    </div>
                    <div class="form-group">
                        <label for="attachment">attachment</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>

@endsection
