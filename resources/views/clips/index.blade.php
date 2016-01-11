{{-- resources/views/clips/index.blade.php --}}

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clip Form -->

        <form action="/clip" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

           <!-- clip Audio file -->
            <div class="form-group">
                <label for="clip-name" class="col-sm-3 control-label">Audio</label>

                <div class="col-sm-6">
                    <input type="file" name="audio" id="clip-audio" class="form-control">
                </div>
            </div>

            <!-- clip Name -->
            <div class="form-group">
                <label for="clip-name" class="col-sm-3 control-label">Caption</label>

                <div class="col-sm-6">
                    <input type="text" name="caption" id="clip-caption" class="form-control">
                </div>
            </div>

            <!-- Add clip Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add clip
                    </button>
                </div>
            </div>
        </form>
    </div>

<!-- Current clips -->
    @if (count($clips) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current clips
            </div>

            <div class="panel-body">
                <table class="table table-striped clip-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Caption</th>
                        <th>File</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($clips as $clip)
                            <tr>
                                <!-- clip Caption -->
                                <td class="table-text">
                                    <div>{{ $clip->caption }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $clip->url_clip }}</div>
                                </td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="/clip/{{ $clip->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete Clip</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection