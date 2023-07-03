@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <show-Products-category :category="{{ json_encode($category) }}"/>
    </div>
@endsection
