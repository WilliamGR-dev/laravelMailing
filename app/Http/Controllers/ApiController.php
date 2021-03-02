<?php

namespace App\Http\Controllers;

use App\Mail\Cancel;
use App\Mail\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function infos(){
        $infos = Config::get('information');
        return $infos;
    }

    public function create(){;
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
        $newDate = (new Carbon($date))->isoFormat('LLLL');

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


                        return response()->json(['message' => "Votre réservation à l'établissement Diteco le ".$newDate." a bien été confirmée ! Vous recevrez un mail de confirmation", 'token' => $token], 201);
                    }
                    else {
                        return response()->json("Cette reservation est en dehors des heures d'ouverture", 400);
                    }
                }
                else{
                    return response()->json("Toutes les reservations on etait prise pour cette horraires", 400);
                }
            }
            else {
                return response()->json("Cette reservation existe deja a votre nom", 400);
            }
        }
        else {
            return response()->json("Cette reservation n'est plus disponible", 400);
        }

    }

    public function delete($token) {
        request()->validate([
            'validate' => 'required|accepted',
        ]);
        $result = DB::select('select * from reservation where token = :token ', ['token' => $token]);
        if ($result){
            $array = json_decode(json_encode($result), true);
            $information = $array[0];
            $delete = DB::delete('delete from reservation where token = :token ', ['token' => $token]);
            if ($delete){
                Mail::to(trim($result[0]->email))->send(new Cancel($information));
                return response()->json(["Votre réservation a bien été annulée."], 200);
            }
            else{
                return response()->json("La réservation n'existe pas (ou plus car a déjà été annulée)", 400);
            }
        }
        else{
            return response()->json("La réservation n'existe pas (ou plus car a déjà été annulée)", 400);
        }


    }
}
