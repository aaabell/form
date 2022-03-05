@extends('layouts.form-app')

@section('css')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Forms Listing') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(Auth::user()->hasPermission('FormController@addForm'))
                    <div class="btn-toolbar float-sm-right pb-3">
                        <button type="submit" class="mr-1 btn btn-success" onclick="window.location='{{ route("form.add") }}'">Add New</button>
                    </div>
                    @endif

                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Form Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if(isset($forms) && count($forms) > 0)
                            @foreach($forms as $from)
                            <tr>
                                <td>{{ $from->id }}</td>
                                <td>{{ $from->title }}</td>
                                <td>{{ $from->created_at }}</td>
                                <td>{{ $from->updated_at }}</td>
                                <td><a href="{{ route('form.edit', $from->id) }}" style="color: black;"><i class="fa fa-edit"></a></i></td>
                            </tr>
                            @endforeach
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="11" class="no-results text-center">No records found!</td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection