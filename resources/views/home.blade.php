@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    Hello {{ Auth::user()->name }}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
