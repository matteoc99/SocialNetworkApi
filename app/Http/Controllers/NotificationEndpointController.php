<?php

namespace App\Http\Controllers;

use App\NotificationEndpoint;
use Illuminate\Http\Request;

class NotificationEndpointController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "subscription" => "required",
        ]);
        
        $subscription = $request->get("subscription");
        
        $notif_ep = new NotificationEndpoint();
        $notif_ep->user_id = $this->authUser()->id;
        $notif_ep->endpoint = $subscription;
        $notif_ep->save();
        
        return response($notif_ep, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotificationEndpoint  $notificationEndpoint
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationEndpoint $notificationEndpoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotificationEndpoint  $notificationEndpoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationEndpoint $notificationEndpoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificationEndpoint  $notificationEndpoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationEndpoint $notificationEndpoint)
    {
        //
    }
}
