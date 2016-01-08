// resources/views/clips/index.blade.php

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clip Form -->
        <form action="/clip" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- clip Name -->
            <div class="form-group">
                <label for="clip-name" class="col-sm-3 control-label">Clip</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="clip-name" class="form-control">
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

    <!-- TODO: Current Clips -->
@endsection