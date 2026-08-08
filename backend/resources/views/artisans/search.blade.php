<?php
$prototypePath = base_path('../find_artisans/search-results.html');
$prototypeHtml = file_exists($prototypePath) ? file_get_contents($prototypePath) : '';

$cardsHtml = '';

if ($artisans->isEmpty()) {
    $cardsHtml = '<article class="bg-surface rounded-[16px] shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant overflow-hidden p-6 text-center"><h2 class="font-headline-sm text-headline-sm text-on-surface">No artisans matched your search yet</h2><p class="mt-2 font-body-sm text-on-surface-variant">Try a broader service or location to see more professionals.</p></article>';
} else {
    foreach ($artisans as $artisan) {
        $categoryLabel = $artisan->category?->name ?: 'General service';
        $cityLabel = $artisan->city ?: 'Location available';
        $serviceArea = $artisan->service_area ?: 'Service area available';
        $rating = (string) ($artisan->rating ?: 4.8);
        $hourlyRate = number_format((float) ($artisan->hourly_rate ?: 0), 0);
        $description = e($artisan->description ?: 'Local professional available for your job.');
        $businessName = e($artisan->business_name ?: 'Local Artisan');
        $imageUrl = 'https://images.unsplash.com/photo-1581578731548-c2461c5c0f1e?auto=format&fit=crop&w=900&q=80';
        $priceLabel = '$' . $hourlyRate;

        $cardsHtml .= <<<HTML
<article class="bg-surface rounded-[16px] shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant overflow-hidden flex flex-col active:scale-[0.98] transition-transform">
    <div class="relative h-48 w-full bg-surface-container">
        <img alt="Artisan work" class="w-full h-full object-cover" src="{$imageUrl}" />
        <div class="absolute top-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg flex items-center gap-1 shadow-sm">
            <span class="material-symbols-outlined text-tertiary text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
            <span class="font-label-md text-on-surface">{$rating}</span>
        </div>
        <button class="absolute top-3 left-3 w-8 h-8 rounded-full bg-surface/90 backdrop-blur-sm flex items-center justify-center shadow-sm hover:bg-surface transition-colors">
            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">favorite_border</span>
        </button>
    </div>
    <div class="p-4 flex flex-col gap-3">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="font-headline-sm text-headline-sm text-on-surface">{$businessName}</h2>
                <p class="font-body-sm text-on-surface-variant">{$categoryLabel}</p>
            </div>
            <div class="bg-secondary-container text-on-secondary-container px-2 py-1 rounded flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">verified</span>
                <span class="font-label-sm">Verified</span>
            </div>
        </div>
        <p class="font-body-sm text-on-surface-variant">{$description}</p>
        <div class="flex flex-wrap gap-2">
            <span class="bg-surface-container-low text-on-surface px-2 py-1 rounded-md font-label-sm border border-surface-variant">{$cityLabel}</span>
            <span class="bg-surface-container-low text-on-surface px-2 py-1 rounded-md font-label-sm border border-surface-variant">{$serviceArea}</span>
        </div>
        <div class="flex justify-between items-center mt-2 pt-3 border-t border-surface-variant">
            <div class="flex items-baseline gap-1">
                <span class="font-headline-md text-headline-md text-primary">{$priceLabel}</span>
                <span class="font-body-sm text-on-surface-variant">/hr</span>
            </div>
            <div class="flex items-center gap-2">
                <button class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:opacity-90 transition-opacity shadow-[0_4px_12px_rgba(0,76,205,0.2)]">
                    Book Now
                </button>
                <button class="text-primary font-label-sm text-label-sm hover:underline active:opacity-70 transition-opacity">
                    View Profile
                </button>
            </div>
        </div>
    </div>
</article>
HTML;
    }
}

$searchContext = trim((string) ($service ?: 'Any'));
$locationContext = trim((string) ($location ?: 'Any'));
$countHtml = '<span class="font-label-md text-on-surface-variant">' . e($artisans->count()) . ' Artisans Found</span>';

$prototypeHtml = str_replace('<!-- DYNAMIC_ARTISAN_COUNT -->', $countHtml, $prototypeHtml);
$prototypeHtml = str_replace('<!-- DYNAMIC_ARTISAN_CARDS -->', $cardsHtml, $prototypeHtml);
$prototypeHtml = str_replace('class="font-body-sm text-body-sm text-on-surface-variant mb-lg"', 'class="font-body-sm text-body-sm text-on-surface-variant mb-lg"', $prototypeHtml);

$prototypeHtml = str_replace('HandyLink - Search Results', 'HandyLink - Search Results', $prototypeHtml);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HandyLink - Search Results</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body>
    {!! $prototypeHtml !!}
</body>
</html>
