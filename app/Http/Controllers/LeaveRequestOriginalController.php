<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $leaverequest = LeaveRequest::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('leave_type_name', 'LIKE', "%$keyword%")
                ->orWhere('start_date', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->orWhere('total_leave', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('comments', 'LIKE', "%$keyword%")
                ->orWhere('approver_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $leaverequest = LeaveRequest::latest()->paginate($perPage);
        }



        return view('leave-request.index', compact('leaverequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('leave-request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        // $requestData['user_id'] = Auth::id();
        // $requestData['status'] = "pending";

        LeaveRequest::create($requestData);

        return redirect('leave-request')->with('flash_message', 'LeaveRequest added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $leaverequest = LeaveRequest::findOrFail($id);

        return view('leave-request.show', compact('leaverequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $leaverequest = LeaveRequest::findOrFail($id);

        return view('leave-request.edit', compact('leaverequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $leaverequest = LeaveRequest::findOrFail($id);

        // $requestData['approver_id'] = Auth::id();

        $leaverequest->update($requestData);

        return redirect('leave-request')->with('flash_message', 'LeaveRequest updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        LeaveRequest::destroy($id);

        return redirect('leave-request')->with('flash_message', 'LeaveRequest deleted!');
    }
}