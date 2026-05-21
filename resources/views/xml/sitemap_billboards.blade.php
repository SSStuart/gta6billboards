<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach ($billboards as $billboard)
<url>
        <loc>https://gta6billboards.ssstuart.net/billboard/{{ $billboard->slug }}</loc>
        <lastmod>{{ $billboard->updated_at ? $billboard->updated_at->toAtomString() : \Carbon\Carbon::createFromDate(2026, 5, 1)->toAtomString() }}</lastmod>
        <priority>0.90</priority>
        <changefreq>yearly</changefreq>
    </url>

    @endforeach
</urlset>