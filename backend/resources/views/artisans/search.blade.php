<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HandyLink - Artisan results</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-semibold">Artisan results</h1>
            <p class="mt-2 text-sm text-slate-600">
                Service: <span class="font-medium text-slate-900">{{ $service ?: 'Any' }}</span>
                • Location: <span class="font-medium text-slate-900">{{ $location ?: 'Any' }}</span>
            </p>
        </div>

        @if ($artisans->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-sm text-slate-600">
                No artisans matched your search yet.
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($artisans as $artisan)
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold">{{ $artisan->business_name }}</h2>
                                <p class="mt-1 text-sm text-slate-600">{{ $artisan->category?->name ?? 'General service' }}</p>
                            </div>
                            <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">${{ number_format($artisan->hourly_rate, 2) }}/hr</span>
                        </div>

                        <p class="mt-3 text-sm text-slate-600">{{ $artisan->description ?: 'Local professional available for your job.' }}</p>

                        <div class="mt-4 flex flex-wrap gap-2 text-sm text-slate-600">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1">{{ $artisan->city ?: 'Location available' }}</span>
                            <span class="rounded-full bg-slate-100 px-2.5 py-1">{{ $artisan->service_area ?: 'Service area available' }}</span>
                            <span class="rounded-full bg-slate-100 px-2.5 py-1">{{ $artisan->rating }}/5 rating</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
