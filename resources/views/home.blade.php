@extends('layout.app')

@section('content')
    {{Auth::user()->role}}
@endsection