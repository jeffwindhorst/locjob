@extends('layouts.app')
@section('content')
<div id="city-container" class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Cities</h3></div>
                <div class="panel-heading">
                    Page {{ $cities->currentPage() }} of {{ $cities->lastPage() }}
                    <span class="pull-right"><strong>Total cities: </strong>{{ $totalCities }}</span>
                </div>
                @foreach ($cities as $city)
                <div class="panel-body">
                    <ul>
                        <li>
                            <a href="{{ route('cities.show', $city->id) }}"><b>{{ $city->name }}, {{ $city->state }}</b></a>
                        </li>
                    </ul>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                {!! $cities->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
