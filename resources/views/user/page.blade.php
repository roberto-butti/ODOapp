{{-- resources/views/clips/index.blade.php --}}

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clip Form -->
        <div class="clips-container">
            @include('block.user.left')

            <div class="col-4"><div>
            @include('block.formrecordclip')

        <!-- Current clips -->
            @if (count($clips) > 0)
               <ul class="clips_content">
                @foreach ($clips as $clip)
                <li>
                    <div class="elementCards maxPadding" clips>
                        <!-- clip Caption -->
                        <div>{{ $clip->user->name }}</div>
                        <div>{{ $clip->caption }}</div>
                        <div class="clips-wave">
                            <div class="wave-controller play"><div class="player-morf"></div></div>
                            <div class="wave" data-url="{{ $url_clip_upload }}/{{ $clip->url_clip }}"></div>
                        </div>
                        <!--<div><audio src="{{ $url_clip_upload }}/{{ $clip->url_clip }}" controls ></audio></div>-->

                         <!-- Delete Button -->
                        <div class="options-clip">
                            <form action="/clip/{{ $clip->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <ul>
                                        <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li><button class="link-style">Delete Clip</button></li>
                                        </ul>
                                    </li>
                                </ul>
                            </form>
                        </div>


                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </div></div>
        <div class="col-2">
            <div class="col-pad">
                <div pin-to=".clips-container">
                    <div class="user elementCards">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection