<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Status;
use Illuminate\Contracts\Database;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class StatusCRUDController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$items = Status::orderBy('id','DESC')->paginate(1);
        $items = Status::orderBy('id', 'DESC')->get();
        $statuses = Status::$statuses;
        return view('statusCRUD.index', compact(array('items', 'statuses')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::$statuses;
        return view('statusCRUD.create', compact(array('statuses')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'requests' => 'required',
        ]);

        // set active to zero if unchecked
        if (!$request->has('active')) {
            $request->request->add(['active' => 0]);
        } else {
            Status::clear_active();
            $request->request->add(['active' => 1]);
        }
        Status::create($request->all());
        return redirect()->route('status.index')
            ->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $item = Status::find($id);
        return view('statusCRUD.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Status::find($id);
        $options = Status::$statuses;
        $codes = Response::$statusTexts;
        return view('statusCRUD.edit', compact(array('item', 'options', 'codes')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'requests' => 'required',
        ]);
        // set active to zero if unchecked
        if (!$request->has('active')) {
            $request->request->add(['active' => 0]);
        } else {
            $request->request->add(['active' => 1]);
            Status::clear_active();
        }

        Status::find($id)->update($request->all());
        return redirect()->route('status.index')
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Status::find($id)->delete();
        return redirect()->route('status.index')
            ->with('success', 'Item deleted successfully');
    }
}