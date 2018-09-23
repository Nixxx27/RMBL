<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\interest;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function interest()

    {
        $interest = interest::first();
        return view('pages.interest.rate',compact('interest'));
    }

    public function update_interest(Request $request,$id)
    {
        $interest = interest::findorfail($id);

          $this->validate($request,
            [
                'interest'       => 'required',
        
            ],
                $messages = array('interest.required' => 'Default Interest is required!')
            );


        $interest->update( $request->all() );

        return redirect("interest")->with([
            'flash_message' =>  "Default Interest Successfully Updated!"
        ]);
 
    }
}
