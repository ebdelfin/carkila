@extends('layouts.app')

@section('template_title')
@endsection


@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/investment-list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search.css') }}" />

@endsection

@section('content')
    @include('partials.lists.investment-list')
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/rating/star-rating.min.js') }}"></script>

@endsection



