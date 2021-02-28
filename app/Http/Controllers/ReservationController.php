<?php

namespace App\Http\Controllers;

use App\Mail\Cancel;
use App\Mail\Reservation;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class ReservationController extends Controller
{
    //
    public function create(){
        $information = Config::get('information');

        setlocale(LC_TIME, 'fra', 'fr_FR');
        request()->validate([
            'email' => 'required|email',
            'date' => 'required|date',
            'cgu' => 'required|accepted',
            'hour' => 'required|date_format:H:i',
        ]);
        $dateValidate = (new Carbon($_POST['date']))->isWeekDay();
        $dateHour = $_POST['date'].' '. $_POST['hour'];
        $date = date_create_from_format('Y-m-d H:i',$dateHour);
        $close = date_create_from_format('Y-m-d H:i',$_POST['date'].$information['reservation']['hours_max'].':00');
        $open = date_create_from_format('Y-m-d H:i',$_POST['date'].$information['reservation']['hours_min'].':00');

        $today = Carbon::now()->addHour();
        $start_reservation = (new Carbon($date))->startOfHour();
        $end_reservation = (new Carbon($date))->addHour()->startOfHour();
        $newDate = utf8_encode(strftime('%A %d %B %Y à %H:%M', strtotime($dateHour)));

        $results = DB::select('select * from reservation where email = :email AND date = :date', ['email' => $_POST['email'], 'date' => $start_reservation]);
        $count = DB::select('select * from reservation where date = :date', ['date' => $start_reservation]);
        if ($today < $start_reservation){
            if (!$results){
                if (count($count) != $information['reservation']['reservation_max']){
                    if ($dateValidate && $start_reservation->between($open, $close, true) && $end_reservation->between($open, $close, true)){
                        $token = md5(uniqid(true));
                        $information = [
                            'dateReservation' => $newDate,
                            'token' => $token,
                        ];

                        Mail::to(request('email'))->send(new Reservation($information));
                        DB::insert('insert into reservation (email, date, token) values (?, ?, ?)', [$_POST['email'], $start_reservation,$token]);




                        return redirect('/reservation')->with('message', $information);
                    }
                    else {
                        return redirect('/reservation')->with('error', "Cette reservation est en dehors des heures d'ouverture");
                    }
                }
                else{
                    return redirect('/reservation')->with('error', "Toutes les reservations on etait prise pour cette horraires");
                }
            }
            else {
                return redirect('/reservation')->with('error', "Cette reservation existe deja a votre nom");
            }
        }
        else {
            return redirect('/reservation')->with('error', "Cette reservation n'est plus disponible");
        }

    }

    public function confirmReservation($token) {
        $result = DB::select('select * from reservation where token = :token ', ['token' => $token]);
        if ($result){
            $confirm = DB::update('update reservation set confirm = ?  where token = ?', [1 , $token]);
            return redirect('/reservation')->with('status', "Cette reservation a etait confirmer");
        }
        else{
            return redirect('/reservation')->with('error', "Cette reservation n'existe pas");
        }
    }

    public function annulationVerification($token) {

        setlocale(LC_TIME, 'fra', 'fr_FR');
        $result = DB::select('select * from reservation where token = :token ', ['token' => $token]);
        if ($result){
            $array = json_decode(json_encode($result), true);
            $date = new Carbon($array[0]['date']);
            $array[0]['date'] = utf8_encode($date->formatLocalized('%A %d %B %Y à %H:%M'));

            if ($result){
                return view('annulation')->with('date', $array[0]['date'])->with('token', $array[0]['token']);
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/reservation')->with('error', 'La réservation n\'existe pas (ou plus car a déjà été annulée)');
        }



    }

    public function deletReservation($token) {
        request()->validate([
            'validate' => 'required|accepted',
        ]);
        $result = DB::select('select * from reservation where token = :token ', ['token' => $token]);
        $array = json_decode(json_encode($result), true);
        $information = $array[0];
        $delete = DB::delete('delete from reservation where token = :token ', ['token' => $token]);
        if ($delete){
            Mail::to($information['email'])->send(new Cancel($information));
            return redirect('/reservation')->with('status', 'Votre réservation a bien été annulée.');
        }
        else{
            return redirect('/reservation')->with('error', 'La réservation n\'existe pas (ou plus car a déjà été annulée)');
        }

    }
}
