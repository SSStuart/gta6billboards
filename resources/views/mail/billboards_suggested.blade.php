<html style="color-scheme: light dark; font-family: system-ui, sans-serif;">
    <body style="max-width: 80ch; margin-inline: auto;">
        <h1 style="background-image: linear-gradient(#5989b1,#c285a6,#ffb16f); padding: 1em; color: #000;">GTA 6 Billboards</h1>
        <h2>New Billboards contribution</h2>
        <span><strong>From:</strong> {{ $username }}</span>
        <p style="border-inline-start: 2px solid #8888; padding-inline-start: 2ch;">{!! nl2br($comment) !!}</p>
        @foreach ($images as $image)
            <img src="{{ $message->embed(storage_path("app/private/pictures/uploaded/$image")) }}" alt="" style="max-width: 100%; height: auto;">
        @endforeach
    </body>
</html>