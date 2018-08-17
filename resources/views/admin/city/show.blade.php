@extends('layouts.app')

@section('title', '| View City')

@section('content')

<div class="container">
    
    <h1>{{ $city->title }}, {{ $city->state }}</h1>
    <hr>
    <ul>
        <li><strong>Population:</strong> {{ $city->population }}</li>
        <li><strong>Growth 2000 - 2013:</strong> {{ $city->Growth_from_2000_to_2013 }}</li>
        <li><strong>Rank:</strong> {{ $city->rank }}</li>
        <li><strong>Latitude:</strong> {{ $city->latitude }}</li>
        <li><strong>Longitude:</strong> {{ $city->longitude }}</li>
    </ul>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['cities.destroy', $city->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit City')
    <a href="{{ route('city.edit', $city->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete City')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}
</div>

@endsection
