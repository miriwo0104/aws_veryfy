@extends('layouts.app')

@section('content')

@foreach ($image_infos as $image_info)
    <img src="{{ asset('storage/' . $image_info['filepath']) }}">
    <hr>
@endforeach


@endsection