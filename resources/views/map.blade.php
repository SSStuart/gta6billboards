@extends('layouts.app')

@section('title', "GTA 6 Billboards")
@section('description', "...")

@push('styles')
    @vite(['resources/css/map.css'])
@endpush

@section('content')
    <main id="main">
        <section id="mapSection">
            <h2 style="text-align: center;">The map is <em>Coming later™</em></h2>
        </section>
    </main>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/map.js']) --}}
@endpush