@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Cities</h3></div>
                <div class="panel-heading"Page {{ $cities->currentPage() }} of {{ $cities->lastPage() }}</div>
                @foreach ($cities as $city)
                <div class="panel-body">
                    <li style="list-style-type:disc">
                        <a href="{{ route('cities.show', $post->id) }}"><b>{{ $city->name }}, {{ $city->state }}</b></a>
                    </li>
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
