@extends('layouts.app')

@section('title', "GTA 6 Billboards")
@section('description', "...")

@push('styles')
    @vite(['resources/css/billboard.css'])
@endpush

@section('content')
    <main id="main">
        <section id="billboardDisplay">
            <h2 id="billboardName">{{ $billboard->name }}</h2>
            {{-- <div id="imageContainer"> --}}
                <a id="navPrevious" class="navLink {{ !$previousBillboard ? 'unavailable' : ''}}" href="{{ $previousBillboard ? route('billboard.show', ['slug' => $previousBillboard->slug]) : '#' }}"><i class='iiicon' data-name='arrowLeftOutline'></i></a>
                <img id="billboardImg" src="{{ asset('storage/pictures/billboards/'.$billboard->filename) }}" alt="" aria-describedby="billboardDescription">
                <a id="navNext" class="navLink {{ !$nextBillboard ? 'unavailable' : ''}}" href="{{ $nextBillboard ? route('billboard.show', ['slug' => $nextBillboard->slug]) : '#' }}"><i class='iiicon' data-name='arrowRightOutline'></i></a>
                <div id="billboardsDetails">
                    <p id="billboardDescription">{{ $billboard->description }}</p>
                    @if ($billboard->remark)
                        <p id="billboardRemark">{!! $billboard->remark !!}</p>
                    @endif
                    <div id="detailsList">
                        <div><i class='iiicon' data-name='user' title="Contributor"></i> <span>{{ $billboard->contributor->username }}</span></div>
                        <div><i class='iiicon' data-name='location' title="Zone"></i> <a href="{{ route('map.show', ['slug' => $billboard->slug]) }}">{{ $billboard->zone->name }}</a></div>
                    </div>
                </div>
            {{-- </div> --}}
        </section>
    </main>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/billboard.js']) --}}
@endpush