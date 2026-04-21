<header>
    <div id="headerContent">
        <div id="gameSelectorWrapper">
            <button id="openGameSelector">GTA VI <i class="iiicon" data-name="arrowDown"></i></button>
            <dialog id="gameSelector" closedby="any">
                <a href="https://gta5billboards.ssstuart.net">GTA V</a>
            </dialog>
        </div>
        <div id="headerTitle">
            <a href="/">
                <img src="{{ asset('storage/pictures/iconVI.svg') }}" alt="logo">
                <h1>GTA 6 Billboards</h1>
            </a>
        </div>
        <nav>
            <a href="{{ route('map') }}">Map</a>
            <a href="{{ route('contribute') }}">Contribute</a>
        </nav>
    </div>
</header>