<?php

namespace App\Http\Controllers;

use App\Mail\Weather\Weather4HourShift;
use App\Mail\Weather\WeatherNoStreets;
use App\Mail\Weather\WeatherUpdate;
use App\Models\Branch;
use App\Models\Employee;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WeatherForecastContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        
        try {
            
            $cities = [
            'kingston' => $this->kingston(),
            'montego'  => $this->montegoBay()
            ];

        } catch (Exception $e) {
            $e->getMessage();
        }

        return view('weather.forecast.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
          

        $this->itEmail();
       
       
        $this->lineStaffEmail();

      

      return back()->withSuccess('Emails Sent');
    }

    
    public function forecast($value='')
    {
        
        for ($i=0; $i < 40; $i+=8) { 
             
             $forecast[$value[$i]->dt_txt] = $value[$i]->weather[0];
        }

        return $forecast;
    }

    public function kingston()
    {
        try {
        $client = new Client();

        $response = $client->request('GET', 'api.openweathermap.org/data/2.5/forecast?id=3489297&APPID=777c229e6b56df7606cfe66185a4cefb');
        $kingstonDetails = json_decode($response->getBody(), false);
        $forecast = $this->forecast($kingstonDetails->list); 

        } catch (Exception $e) {
            
        }
        


        $kingston['city'] = $kingstonDetails->city->name;
        $kingston['forecasts'] = $forecast;
        return $kingston;
    }

    public function montegoBay($value='')
    {
            try {

            $client = new Client();
            $response = $client->request('GET', 'api.openweathermap.org/data/2.5/forecast?id=3489460&APPID=777c229e6b56df7606cfe66185a4cefb');
            $montegoDetails = json_decode($response->getBody(), false);
            $forecast = $this->forecast($montegoDetails->list);

            } catch (Exception $e) {
                
            }
            

            $montego['city'] = $montegoDetails->city->name;
            $montego['forecasts'] = $forecast;
            return $montego;
    }

    public function kingstonWeatherForToday()
    {
        $kingston2 = $kingston = $this->kingston();
        
        $first_key = key($kingston['forecasts']);
        return $kingston['forecasts'][$first_key ];
    }

    public function montegoBayWeatherForToday()
    {
        $kingston = $this->montegoBay();

        $first_key = key($kingston['forecasts']);
        return $kingston['forecasts'][$first_key ];
    }

    public function itEmail()
    {
        $employees = new Employee;
        $weather = $this->montegoBayWeatherForToday();


        if ($weather->main == 'Rain') {

           
        foreach ($employees->it()->montegoBayBranch()->get() as $employee) {

         Mail::to($employee)->send(new WeatherNoStreets($employee));

        }

       }else {

        foreach ($employees->it()->montegoBayBranch()->get() as $employee) {

         Mail::to($employee)->send(new WeatherUpdate($employee, $weather));

        }

       }

       $kingstonWeather = $this->kingstonWeatherForToday();

       if ( $kingstonWeather->main == 'Rain') {
           
        foreach ($employees->it()->kingstonBranch()->get() as $employee) {

         Mail::to($employee)->send(new WeatherNoStreets($employee));

        }

       }else {

        foreach ($employees->it()->kingstonBranch()->get() as $employee) {

         Mail::to($employee)->send(new WeatherUpdate($employee, $kingstonWeather));

        }
        
       }

    }

    public function lineStaffEmail()
    {
        $employees = new Employee;
        $weather = $this->montegoBayWeatherForToday();

        if ($weather->main == 'Rain') {

           
        foreach ($employees->lineStaff()->montegoBayBranch()->get() as $employee) {

         Mail::to($employee)->send(new Weather4HourShift($employee));

        }

       }else {

        foreach ($employees->lineStaff()->montegoBayBranch()->get() as $employee) {

         Mail::to($employee)->send(new WeatherUpdate($employee, $weather));

        }

       }

       $kingstonWeather = $this->kingstonWeatherForToday();

       if ($kingstonWeather->main == 'Rain') {
           
        foreach ($employees->lineStaff()->kingstonBranch()->get() as $employee) {

         Mail::to($employee)->send(new Weather4HourShift($employee));

        }

       }else {

        foreach ($employees->lineStaff()->kingstonBranch()->get() as $employee) {

         Mail::to($employee)->send(new WeatherUpdate($employee, $kingstonWeather));

        }
        
       }

    }


}
