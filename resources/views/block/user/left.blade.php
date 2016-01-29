            <div class="col-2">
                <div class="col-pad">
                    <div pin-to=".clips-container">
                        <div class="elementCards noPadding tCenter padOnlyB">
                            <div class="card-header" style="background-image:url(/img/profile/{{ $user->photo_header }});">
                                <div class="photo-profile"><img src="/img/profile/{{ $user->photo_profile }}"></div>
                            </div>
                            <div>{{ $user->name }}</div>
                            <div>I have {{ $user->Followers()->count() }} followers</div>
                            <div>I follow {{ $user->FollowingList()->count() }} people</div>
                        </div>
                    </div>
                </div>
            </div>
