                <form action="/clip" method="POST" class="form-horizontal elementCards maxPadding" enctype="multipart/form-data" ng-controller="newClip">
                    {{ csrf_field() }}

                   <!-- clip Audio file -->
                    <div class="form-group">
                        <div class="record-button">
                            <span ng-click="start($event)">Record</span>
                            <div class="record-option">
                                <div id="recordCircle" class="rcircle">
                                    <button class="stop-rec button-circle" ng-click="stop($event)">Stop</button>
                                    <button class="start-rec btn btn-default re-record" ng-click="start($event)">Restart</button>
                                </div>
                                 <input type="hidden" name="audio" id="clip-audio" class="form-control">
                            </div>
                            <div class="message-option">
                                 <input type="text" name="caption" id="clip-caption" class="form-control" size="60" placeholder="Text">

                                <button type="submit" class="btn btn-default" >
                                    <i class="fa fa-plus"></i> Add clip
                                </button>
                            </div>
                        </div>
                            <!--<svg class="spinner-container" width="50px" height="50px" viewBox="0 0 52 52">
                              <circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="3px"></circle>
                            </svg>-->
                    </div>
                </form>