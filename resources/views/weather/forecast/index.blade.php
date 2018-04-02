@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Forecast Dashboard - {{ $cities['kingston']['city'] }}</div>

                <div class="panel-body">
                    <div>
                        @foreach($cities['kingston']['forecasts'] as $info )
                            <div class="card" style="width: 150px; float: left;">
                              <img class="card-img-top" src="http://openweathermap.org/img/w/{{$info->icon}}.png" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">{{$info->main}}</h5>
                                <p class="card-text">{{ ucfirst($info->description)}}</p>
                                <p class="card-text"></p>
                              </div>
                            </div>
                        @endforeach
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Forecast Dashboard - {{ $cities['montego']['city'] }}</div>

                <div class="panel-body">
                    <div>
                        @foreach($cities['montego']['forecasts'] as $info )
                            <div class="card" style="width: 150px; float: left;">
                              <img class="card-img-top" src="http://openweathermap.org/img/w/{{$info->icon}}.png" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">{{$info->main}}</h5>
                                <p class="card-text">{{ ucfirst($info->description)}}</p>
                                <p class="card-text"></p>
                              </div>
                            </div>
                        @endforeach
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{ route('weather.email') }}" method="POST">
                {{ csrf_field() }}

                <button class="btn btn-primary">Send weather update - email</button>
                
            </form>
             
        </div>
    </div>
    </div>
</div>
@endsection
