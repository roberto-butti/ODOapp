{{-- resources/views/clips/index.blade.php --}}

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clip Form -->
        <div class="clips-container">
            <div class="col-2">
                <div class="col-pad">
                    <div pin-to=".clips-container">
                        <div class="elementCards noPadding tCenter padOnlyB">
                            <div class="card-header" style="background-image:url(/img/profile/{{ Auth::user()->photo_header }});">
                                <div class="photo-profile"><img src="/img/profile/{{ Auth::user()->photo_profile }}"></div>
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div>I have {{ Auth::user()->Followers()->count() }} followers</div>
                            <div>I follow {{ Auth::user()->FollowingList()->count() }} people</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4"><div>
                <form action="/clip" method="POST" class="form-horizontal elementCards maxPadding" enctype="multipart/form-data" ng-controller="newClip">
                    {{ csrf_field() }}

                   <!-- clip Audio file -->
                    <div class="form-group">
                        <label for="clip-name" class="col-sm-3 control-label">Audio</label>

                            <input type="hidden" name="audio" id="clip-audio" class="form-control">
                        <div class="col-sm-6">
                            <div class="spectre"><div></div></div>
                            <button class="start-rec btn btn-default" ng-click="start($event)">Start</button>
                            <button class="stop-rec btn btn-default" ng-click="stop($event)">Stop</button>
                            <!--<svg class="spinner-container" width="50px" height="50px" viewBox="0 0 52 52">
                              <circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="3px"></circle>
                            </svg>-->
                        </div>
                    </div>

                    <!-- clip Name -->
                    <div class="form-group">
                        <label for="clip-name" class="col-sm-3 control-label">Caption</label>

                        <div class="col-sm-6">
                            <input type="text" name="caption" id="clip-caption" class="form-control" size="60">
                        </div>
                    </div>

                    <!-- Add clip Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default" >
                                <i class="fa fa-plus"></i> Add clip
                            </button>
                        </div>
                    </div>
                </form>

        <!-- Current clips -->
            @if (count($clips) > 0)
               <ul class="clips_content">
                @foreach ($clips as $clip)
                <li>
                    <div class="elementCards maxPadding">
                        <!-- clip Caption -->
                        <div>{{ $clip->user->name }}</div>
                        <div>{{ $clip->caption }}</div>
                        <div><audio src="{{ $url_clip_upload }}/{{ $clip->url_clip }}" controls ></audio></div>

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