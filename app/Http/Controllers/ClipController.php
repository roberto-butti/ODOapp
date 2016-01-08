<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a list of all of the user's clip.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = Clip::where('user_id', $request->user()->id)->get();

        return view('clips.index', [
            'clips' => $clips,
        ]);
    }

  /**
   * Create a new clip.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $this->validate($request, [
          'caption' => 'required|max:255',
      ]);
      $request->user()->clips()->create([
        'caption' => $request->caption,
    ]);

    return redirect('/clips');

  }
}
