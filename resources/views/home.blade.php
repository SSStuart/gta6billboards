@extends('layouts.app')

@section('title', "GTA 6 Billboards")
@section('description', "List of billboards in GTA 6")

@push('styles')
    @vite(['resources/css/home.css'])
@endpush

@section('content')
    <main id="main">
        <section id="countdownCont">
            <span id="countdown">&nbsp;</span>
        </section>
        <section id="billboardsSection">
            <div id="filtersCont">
                <i class='iiicon' data-name='filter'>Filters</i>
                <input type="search" name="q" id="searchBillboards" placeholder="Filter billboards...">
                <div class="inputCont">
                    <input type="checkbox" name="onlyShowUnique" id="onlyShowUnique" checked>
                    <label for="onlyShowUnique">Only show unique billboards</label>
                </div>
            </div>
            <p id="billboardsOriginTemp">Billboards from the <a href="https://youtu.be/QdBZY2fkU-0"class="richLink" target="_blank">Trailer 1</a>, <a href="https://youtu.be/VQRLujxTm3c"class="richLink" target="_blank">Trailer 2</a> & the <a href="https://www.rockstargames.com/VI"class="richLink" target="_blank">website</a>:</p>

            <div id="billboardsList">
                @foreach ($billboards as $billboard)
                    <div class="billboardCont" data-width="{{ $billboard->width }}" data-height="{{ $billboard->height }}" style="--col-span: {{ $billboard->width }}; --row-span: {{ $billboard->height }}" data-name="{{ $billboard->name }}" data-description="{{ $billboard->description }}" data-remark="{{ $billboard->remark }}" data-contributor="{{ $billboard->contributor->username }}">
                        <a href="{{ route('billboard.show', ['slug' => $billboard->slug]) }}" class="imgLink">
                            <img class="billboardImage" src="{{ asset('storage/pictures/billboards/thumbnails/'.$billboard->filename) }}" alt="">
                            <img class="billboardImage" src="{{ asset('storage/pictures/billboards/'.$billboard->filename) }}" alt="{{ $billboard->name }}" loading="lazy">
                        </a>
                        <a href="{{ route('billboard.show', ['slug' => $billboard->slug]) }}" class="billboardName">{{ $billboard->name }}</a>
                        <a href="{{ route('map.show', ['slug' => $billboard->slug]) }}" class="mapLink tooltipTarget" data-tooltip-pos="left"><i class='iiicon' data-name='location'></i><span class="tooltip">See on the map</span></a>
                    </div>
                @endforeach
                <div id="noResults" class="hidden">
                    <p>No results :(</p>
                    <button type="button" id="clearFiltersBtn" class="btnLink"><i class='iiicon' data-name='close'></i> Clear filters</button>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    @vite(['resources/js/home.js'])
@endpush