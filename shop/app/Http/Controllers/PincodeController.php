<?php

namespace App\Http\Controllers;

use App\pincode;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {   
        $sort_search=null;
        $pincode=pincode::orderBy('created_at','desc');
        if($request->has('search'))
        {
            $sort_search=$request->input('search');
            $pincode=pincode::where('name' ,'like'. $sort_search);
        }
        $pincode=$pincode->paginate(15);
        return view ('pincode.index',compact('pincode'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pincode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['pincode'=>'required','usertype'=>'required','amount'=>'required'
        ]);
        $pincode=new pincode();
        $pincode->usertype=$request->usertype;
        $pincode->pincode=$request->pincode;
        $pincode->amount=$request->amount;
        if($pincode->save())
        {
             flash(translate('pincode added successfully'))->success();
            return redirect()->route('pincodes.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function show(pincode $pincode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function edit(pincode $pincode)
    {       
       return view('pincode.edit',compact('pincode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pincode $pincode)
    {
       
        $request->validate(['pincode'=>'required','usertype'=>'required','amount'=>'required'
        ]);     
        $pincode->usertype=$request->usertype;
        $pincode->pincode=$request->pincode;
        $pincode->amount=$request->amount;
        if($pincode->save())
        {
            flash(translate('pincode updated successfully'))->success();
            return redirect()->route('pincodes.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function destroy(pincode $pincode)
    {
        //
    }
     public function updatestatus(Request $request)
    {
        $category = pincode::findOrFail($request->id);
        $category->status = $request->status;
        if($category->save()){
            return 1;
        }
        return 0;
    }
}
