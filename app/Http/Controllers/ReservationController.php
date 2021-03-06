<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Airline;
use App\Status;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller{
    public function checkLogin(){
        if(session("user") == null)
            redirect('/')->send();
    }

    public function reservation(){
        $this->checkLogin();

        return view('reservation')->with('reservation', Reservation::with('customer', 'destination', 'status')->get());
    }

    public function reservationDetail(Request $request){
        $this->checkLogin();

        $reservation = $request->id == "new" ? new Reservation() : Reservation::where('id', $request->id)->with('customer', 'destination', 'status')->first();
        if($request->id == "new"){
            $reservation->id = -1;
        }
        return view('reservation_detail')->with('reservation', $reservation)->with('status', Status::all());
    }

    public function reservationSave(Request $q){
        $this->checkLogin();

        $reservation = Reservation::find($q->id);
        
        $reservation->res_loc = $q->res_loc;
        $reservation->status_id = $q->status_id;
        $reservation->seat_code = $q->seat_code;
        $reservation->staff_id = session('user')->id;
    
        $reservation->save();

        return view('reservation_detail')->with('reservation', $reservation)->with('status', Status::all());
    }

    public function reservationConfirm(Request $q){
        $this->checkLogin();

        $reservation = Reservation::find($q->id);
        
        $reservation->status_id = $q->status;
        $reservation->staff_id = session('user')->id;
    
        $reservation->save();

        return view('reservation_pending')->with('reservation', Reservation::with('customer', 'destination')->where('status_id', 1)->get());
    }

    public function reservationDelete(Request $q){
        $this->checkLogin();

        $reservation = Reservation::find($q->id);
        $reservation->delete();

        return redirect('admin/reservation');
    }

    public function reservationPending(){
        $this->checkLogin();

        return view('reservation_pending')->with('reservation', Reservation::with('customer', 'destination')->where('status_id', 1)->get());
    }
}
