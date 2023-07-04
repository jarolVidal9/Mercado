@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @if ( Auth::user())
            <show-products :user_id="{{ Auth::user()->id}}" />
        @else
            <show-products />
        @endif
    </div>
@endsection
