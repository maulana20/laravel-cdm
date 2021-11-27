@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 col-lg-offset-1">
        <div class="card">
            <h3 class="card-header">create</h3>
            <div class="card-body">
                <table class="table table-bordered table-content" style="margin-bottom: 0px;" id="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th><a href="{{ route('paper.create') }}" class="btn btn-primary float-right">Create</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($papers as $paper)
                        <tr>
                            <td>{{ $paper->title }}</td>
                            <td>
                                <div class="d-flex float-right">
                                    <modal-image-button :images="{{ $paper->images }}"></modal-image-button>
                                    &nbsp;
                                    <button class="btn btn-sm btn-success" onclick="window.open('{{ $paper->document->final_full }}', '_blank')">PDF</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
