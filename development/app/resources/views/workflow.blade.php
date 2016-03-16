@extends('layouts.app')

@push('scripts')
    <link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="/css/workflow.css" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="/js/workflow.js"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">

                <h2>Books</h2>

                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Preview</th>
                        <th>Autor</th>
                        <th>Write At</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
@endsection