@php
    $langBrowser = request()->getPreferredLanguage(['en', 'fr']);
    $langUser = Illuminate\Support\Facades\App::currentLocale();
    $localeUser =  $langUser == "fr" ? 'fr-FR' : 'en-US';

@endphp
<!DOCTYPE html>
<html lang="{{ $langUser }}" data-theme="auto" data-locale="{{ App::currentLocale() }}" @yield('html_attributes')>
    @include('layouts._head')

    <body @yield('body_attributes')>
        <noscript>
            <style>
                #noJSDisclaimer {
                    background-color: #d46310; 
                    color: #FFF; 
                    border: solid 1px;
                    box-shadow: 0 0 0 1px #000;
                    font-size: 1rem;
                    padding: 0.5em 1em; 
                    margin: 0; 
                    width: 100%;
                    position: relative; 
                    z-index: 99;
                }
            </style>
            <dialog id="noJSDisclaimer" open>
                <p>
                    ⚠ {{ __('general.noscript') }}
                </p>

                <form method="dialog">
                    <button>{{ __('general.Close') }}</button>
                </form>
            </dialog>
        </noscript>

        <a href="#main" id="skipNavLink">{{ __('general.Skip navigation links') }}</a>
        @include('layouts._header')

        @yield('content')

        @include('layouts._footer')

        <div id="toastsWrapper" data-expanded="false">
            <div id="toastsCommands">
                <button id="toastExpandToggle" class="discret"><svg width="100%" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><path id="chevronUp" style="fill:none;stroke:currentcolor;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1;stroke-dasharray:none" d="M7.523 2.523 25 20 42.523 2.477"/><path id="chevronDown" style="fill:none;stroke:currentcolor;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1" d="M42.477 47.477 25 30 7.477 47.523"/></svg></button>
            </div>
            <div id="toastQueueScrollCont">
                <div id="toastQueue">
    
                </div>
            </div>
			<span id="toastQueueNumber"></span>
		</div>

        <!-- JS files -->

        @stack('scripts')
        <script>
            const LANG = {
                "browser": "{{ $langBrowser }}",
                "user": "{{ $langUser }}",
                "locale": "{{ $localeUser }}"
            };
            {{-- const postUrlMissingTranslation = "{{ route('ssstatus.report') }}"; --}}

            @if (session('success'))
                document.addEventListener("DOMContentLoaded", function() {
                    displayToast("{{ session('success') }}", "checkmark", "forestgreen");
                });
            @endif
            @if (session('error'))
                document.addEventListener("DOMContentLoaded", function() {
                    displayToast("{{ session('error') }}", "close", "firebrick");
                });
            @endif
            @if ($errors->any())
                document.addEventListener("DOMContentLoaded", function() {
                    @foreach ($errors->all() as $error)
                    displayToast("{{ $error }}", "close", "firebrick");
                    @endforeach
                });
            @endif
        </script>
    </body>
</html>