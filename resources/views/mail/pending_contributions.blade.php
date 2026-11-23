<html style="color-scheme: light dark; font-family: system-ui, sans-serif;">
    <body style="max-width: 80ch; margin-inline: auto;">
        <h1 style="background-image: linear-gradient(#5989b1,#c285a6,#ffb16f); padding: 1em; color: #000;">GTA 6 Billboards</h1>
        <h2>Weekly billboards contribution</h2>
        @foreach ($contributions as $contribution)
            <div style="background-image: linear-gradient(#5989b144,#c285a644,#ffb16f44); border: solid 2px #8888; padding: 1em; margin-block: 1em;">
                <span><strong>From:</strong> {{ $contribution->username }}</span>
                <p style="border-inline-start: 2px solid #8888; padding-inline-start: 2ch;">{!! nl2br($contribution->comment) !!}</p>
                <img src="{{ $message->embed(storage_path("app/private/pictures/uploaded/$contribution->filename")) }}" alt="" style="max-width: 100%; height: auto;">
            </div>
        @endforeach
        <a href="{{ route('admin.create') }}" style="background-color: #c085a6; color: #FFF; padding: 0.5em 1em; text-decoration: none; border-radius: 5px; margin-inline: auto; display: block; width: fit-content; font-size: 1.5em;">Page admin</a>
    </body>
</html>