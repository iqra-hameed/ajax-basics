<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\LeadController;
use App\Models\Lead;
use App\Models\Refrel;
use App\Models\Enrollment;
use App\Models\Courses;
use Notification;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('index' , compact('notifications'));
        // return view('frount_end.sign-in');
        // $leads=Lead::$request->all();
        // return view('index')->compact('leads');
        // $leads = Lead::get();
        // return view('index',compact('leads'));

    }
    public function sendNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }



    public function noti(Request $request){
       return view('not');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forget(Request $request){
        return view('frount_end.password-reset');
    }
    public function BasiecForm(Request $request){
        return view('BasiecForm');
    }
    public function dataTable(Request $request){
        return view('dataTable');
    }
    public function created(Request $request){
        return view('frount_end.sign-up');
    }
    // public function leads(Request $request){
    //     return view('lead.leads');
    // }
    // public function enrollments(Request $request){
    //     $data=Enrollment::all();
    //     return view('enrollments', compact('data'));
    // }
    public function courses(Request $request){
        return view('courses');
    }

    // public function create(Request $request)
    // {
    //     // return $request;
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required'
    //     ]);
    //     return view('index');
    // }
//     public function create(Request $request)
//     {

//     return view('lead.leads');
// }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }
}
