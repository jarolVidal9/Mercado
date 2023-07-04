@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @if ( Auth::user())
            <show-Products-category :user_id="{{ Auth::user()->id}}" :category="{{$category}}"/>
        @else
            <show-Products-category :category="{{$category}}"/>
        @endif
        
    </div>
@endsection
