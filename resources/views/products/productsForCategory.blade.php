@extends('layouts.app')

@section('content')
    <div class="container">
        <show-Products-category :category="{{ json_encode($category) }}"/>
    </div>
@endsection
