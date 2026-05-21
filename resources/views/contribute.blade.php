@extends('layouts.app')

@section('title', "GTA 6 Billboards")
@section('description', "...")

@push('styles')
    @vite(['resources/css/contribute.css'])
@endpush

@section('content')
    <main id="main">
        <div id="laterOverlay"><h2>User contributions are <em>Coming later™</em></h2></div>
        <section>
            <h2>Contributing</h2>
            <p>You can contribute by taking photos (screenshots) of billboards that haven't been listed yet (or of billboards of poor quality).</p>
        </section>
        <section id="contributorsSection">
            <h2>Contributors 💛</h2>
            <div id="contributorList">
                @foreach ($contributors as $contributor)
                <div class="contributorRow">
                    <div class="level">{{ $contributor->contribution_number }}</div>
                    <div class="username" {{ $contributor->username == "Anonymous" ? "id=anonymous" : "" }}>{{ $contributor->username }}</div>
                </div>
                @endforeach
            </div>
        </section>
        <section id="recomendationSection">
            <h2>Recommendations</h2>
            <ul id="recoList">
                <li>
                    <div class="helpItem">
                        <p>Capture the entire billboard, with <strong>some space around the sides</strong></p>
                        <img src="{{ asset('storage/pictures/contribute/help_margin.png') }}" alt="">
                    </div>
                </li>

                <li>
                    <div class="helpItem">
                        <p>Make sure the sign is <strong>not obstructed</strong> (if possible)</p>
                        <img src="{{ asset('storage/pictures/contribute/help_obstruction.png') }}" alt="">
                    </div>
                </li>

                <li>
                    <div class="helpItem">
                        <p>Make sure there is <strong>good lighting</strong> (preferably during the day)</p>
                        <img src="{{ asset('storage/pictures/contribute/help_lighting.png') }}" alt="">
                    </div>
                </li>

                <li>
                    <div class="helpItem">
                        <p>Use the <strong>highest texture quality</strong></p>
                        <img src="{{ asset('storage/pictures/contribute/help_quality.png') }}" alt="">
                    </div>
                </li>
            </ul>
        </section>
        <section id="formSection">
            <h2>Upload images</h2>
            <form action="{{ route('contribute.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="inputCont" id="imagesInputCont" data-dir="vertical">
                    <label for="images">Select/drop billboard(s) image(s)</label>
                    <small class="remark">JPG/PNG files, Max 10 files, Max 2MB/file</small>
                    <input type="file" name="images[]" id="images" accept="image/png, image/jpeg" multiple required>
                </div>
                <div id="selectedImagesCont">
                    <div id="selectedImagesLabel">
                        <span>Selected images:</span>
                        <button type="button" id="clearSelectedImages" class="btnLink"><i class='iiicon' data-name='delete'></i> Reset</button>
                    </div>
                    <div id="selectedImages"></div>
                    <div id="ignoredImages"></div>
                </div>
                <div class="inputCont" data-dir="vertical">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" placeholder="Anything special about the billboard(s)?" cols="30" rows="5"></textarea>
                </div>
                <div class="inputCont" data-dir="vertical">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Anonymous" style="width: 100%;">
                </div>
                <button type="submit">Submit</button>
            </form>
        </section>
    </main>
@endsection

@push('scripts')
    @vite(['resources/js/contribute.js'])
@endpush