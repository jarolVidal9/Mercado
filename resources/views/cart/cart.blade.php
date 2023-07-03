@extends('layouts.app')

@section('content')
    <div class="container mt-3">
    <shopping-cart :user_id="{{Auth::id()}}"></shopping-cart>
    </div>
@endsection
