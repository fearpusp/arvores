@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('styles')
@parent
<style>
    /*seus estilos*/
</style>
@endsection

@section('footer')
    Seu código
@endsection

@section('javascripts_bottom')
@parent
<script src="{{ asset('js/share.js') }}"></script>
<script>
    // Seu código .js
</script>
@endsection
