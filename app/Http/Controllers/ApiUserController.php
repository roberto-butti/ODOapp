<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiUserController extends Controller
{

  public function __construct() {
    //$this->middleware('auth');
  }

    /**
     * Follow.
     *
     * @param  Request  $request
     * @return Response
     */
    public function follow(Request $request)
    {
      //var_dump($request->user());
      var_dump($request->follower_id);
      //die();
      $request->user()->FollowingList()->attach($request->follower_id,[
// other fields
'created_at' => date('Y-m-d H:i:s'),
'updated_at' => date('Y-m-d H:i:s')
]);
        //return view('home');
    }
}
