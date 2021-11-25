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
                        <div class="float-right">
                            <button type="submit" class="btn btn-sm btn-success" onclick="window.open('{{ session()->get('pathDocx') }}', '_blank')">DOCX</button>
                            <button type="submit" class="btn btn-sm btn-success" onclick="window.open('{{ session()->get('pathPdf') }}', '_blank')">PDF</button>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('document.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="name" class="form-control" id="name" name="name" placeholder="Document Name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="content">content</label>
                        <input-content :content="'{{ old('content') }}'"></input-content>
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
