<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusRequest;
use App\Status;
use Illuminate\Contracts\Database;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Config;


class RequestCRUDController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = StatusRequest::get_all();
        $status = Status::$statuses;
        return view('requestCRUD.index',compact(array('items','status')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codes = Response::$statusTexts;
        $status = Status::$statuses;
        return view('requestCRUD.create', compact(array('status','codes')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // current status total percents
        $current_percent = StatusRequest::get_curent_percents($request->post('status_id'));
        // requests +1
        Status::add_request($request->post('status_id'));
        $max = 100 - $current_percent;
        $this->validate($request, [
            'status_id' => 'required',
            'code' => 'required',
            'percent' => "required|integer|between:0,$max",
        ]);

        StatusRequest::create($request->all());
        return redirect()->route('request.index')
            ->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showitems($id)
    {
        //todo: use statusrequests rel
//        $item = Status::find($id);
//        $items = Status::status()->find($id)->statusrequests;
        $items = StatusRequest::where('status_id', $id)->get();
        return view('statusCRUD.showitems',compact('items'));
    }

    public function show($id)
    {
        $item = StatusRequest::find($id);
        return view('requestCRUD.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = StatusRequest::find($id);
        $statuses = Status::$statuses;
        $codes = Response::$statusTexts;
        return view('requestCRUD.edit',compact(array('item', 'codes', 'statuses')));
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
        $this->validate($request, [
            'status' => 'required',
            'requests' => 'required',
        ]);

        StatusRequest::find($id)->update($request->all());
        return redirect()->route('request.index')
            ->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StatusRequest::find($id)->delete();
        return redirect()->route('request.index')
            ->with('success','Item deleted successfully');
    }
}