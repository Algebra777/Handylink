<?php
session_start();

// Save incoming availability data to session (simple persistence for dev)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $data = [];
    // Parse weekdays
    $days = ['mon','tue','wed','thu','fri','sat','sun'];
    foreach ($days as $d) {
        $enabled = isset($_POST["day_{$d}_enabled"]) ? true : false;
        $from = $_POST["day_{$d}_from"] ?? '';
        $to = $_POST["day_{$d}_to"] ?? '';
        $data['schedule'][$d] = ['enabled' => $enabled, 'from' => $from, 'to' => $to];
    }
    $data['radius'] = isset($_POST['radius']) ? (int)$_POST['radius'] : 15;
    $locations = [];
    if (!empty($_POST['locations']) && is_array($_POST['locations'])) {
        foreach ($_POST['locations'] as $loc) $locations[] = trim($loc);
    }
    $data['locations'] = $locations;

    $_SESSION['availability'] = $data;

    if ($action === 'save_exit') {
        header('Location: /Handylink/artisan/onboarding-step1.php');
        exit;
    }
    if ($action === 'complete') {
        header('Location: /Handylink/artisan/dashboard.php');
        exit;
    }
    // default: reload
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}
?>
<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Artisan Onboarding - Step 3: Availability &amp; Service Area</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#434648",
                        "on-secondary-fixed": "#2a1700",
                        "surface": "#f8f9ff",
                        "surface-container": "#e6eeff",
                        "primary-fixed": "#b5ede7",
                        "on-primary-fixed": "#00201e",
                        "secondary-container": "#fea619",
                        "on-secondary-container": "#684000",
                        "on-primary": "#ffffff",
                        "on-surface": "#0d1c2e",
                        "secondary": "#855300",
                        "surface-container-highest": "#d5e3fc",
                        "error-container": "#ffdad6",
                        "surface-container-high": "#dce9ff",
                        "inverse-surface": "#233144",
                        "secondary-fixed": "#ffddb8",
                        "on-surface-variant": "#404847",
                        "on-primary-container": "#87beb8",
                        "primary": "#003633",
                        "on-error": "#ffffff",
                        "primary-container": "#134e4a",
                        "error": "#ba1a1a",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed-dim": "#c4c7c9",
                        "on-background": "#0d1c2e",
                        "on-tertiary-fixed-variant": "#444749",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-dim": "#ccdbf3",
                        "secondary-fixed-dim": "#ffb95f",
                        "on-primary-fixed-variant": "#144f4b",
                        "outline": "#707977",
                        "on-tertiary-fixed": "#191c1e",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed-variant": "#653e00",
                        "on-tertiary-container": "#b1b4b6",
                        "on-secondary": "#ffffff",
                        "primary-fixed-dim": "#9ad1cb",
                        "surface-variant": "#d5e3fc",
                        "outline-variant": "#bfc8c6",
                        "tertiary": "#2c3032",
                        "surface-container-low": "#eff4ff",
                        "on-tertiary": "#ffffff",
                        "surface-bright": "#f8f9ff",
                        "background": "#f8f9ff",
                        "surface-tint": "#316763",
                        "tertiary-fixed": "#e0e3e5",
                        "inverse-primary": "#9ad1cb"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "24px",
                        "xs": "4px",
                        "margin-mobile": "20px",
                        "lg": "40px",
                        "sm": "12px",
                        "xl": "64px",
                        "gutter": "16px",
                        "max-width": "1200px",
                        "base": "8px",
                        "margin-desktop": "auto"
                    },
                    "fontFamily": {
                        "label-md": ["Public Sans"],
                        "label-sm": ["Public Sans"],
                        "display-lg": ["Public Sans"],
                        "headline-md": ["Public Sans"],
                        "headline-lg": ["Public Sans"],
                        "body-md": ["Public Sans"],
                        "headline-lg-mobile": ["Public Sans"],
                        "body-lg": ["Public Sans"]
                    },
                    "fontSize": {
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "34px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Public Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1;
        }
        
        /* Custom Toggle Switch */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #134e4a;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #134e4a;
        }
        
        /* Custom Range Slider */
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 24px;
            width: 24px;
            border-radius: 50%;
            background: #134e4a;
            cursor: pointer;
            margin-top: -10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 4px;
            cursor: pointer;
            background: #dce9ff;
            border-radius: 2px;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface text-on-surface min-h-screen pb-xl antialiased">
<!-- Top Navigation (Transactional/Onboarding so global nav is suppressed, showing minimal header) -->
<header class="bg-surface-container-lowest w-full top-0 border-b border-outline-variant flex justify-between items-center px-md py-sm max-w-max-width mx-margin-desktop shadow-sm z-10 relative">
<div class="flex items-center gap-sm">
<span class="material-symbols-outlined text-primary text-2xl">handyman</span>
<h1 class="font-headline-md text-headline-md font-bold text-primary tracking-tight">HandyLink</h1>
</div>
<button id="saveExitBtn" class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md px-4 py-2 rounded-lg hover:bg-surface-container-low cursor-pointer active:opacity-80 flex items-center gap-2">
<span>Save &amp; Exit</span>
</button>
</header>
<main class="max-w-3xl mx-auto px-margin-mobile md:px-md py-lg md:py-xl">
<!-- Progress Indicator -->
<div class="mb-lg">
<div class="flex justify-between items-end mb-sm">
<div>
<span class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider block mb-1">Step 3 of 3</span>
<h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">Availability &amp; Service Area</h2>
</div>
<span class="font-label-md text-label-md text-on-surface-variant">100%</span>
</div>
<div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div class="bg-primary h-full rounded-full w-full transition-all duration-500 ease-out"></div>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mt-sm">Let clients know when and where you're available to work.</p>
</div>
<form id="availabilityForm" class="space-y-xl" method="POST">
<!-- Weekly Schedule Section -->
<section class="bg-surface-container-lowest rounded-xl p-md md:p-lg shadow-[0_4px_12px_rgba(0,0,0,0.05)] transition-all hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)]">
<div class="flex items-center gap-sm mb-lg">
<div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined">schedule</span>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Weekly Schedule</h3>
<p class="font-body-md text-body-md text-on-surface-variant text-sm mt-1">Set your standard working hours.</p>
</div>
</div>
<div class="space-y-sm">
<?php
$week = ['mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday'];
foreach ($week as $k=>$label) {
    $idToggle = "toggle-{$k}";
    $checked = ($k!=='sun') ? 'checked' : '';
    echo "<div class=\"flex flex-col md:flex-row md:items-center justify-between gap-sm p-sm rounded-lg bg-surface border border-transparent hover:border-surface-container-high transition-colors\">";
    echo "<div class=\"flex items-center justify-between md:w-32\"><span class=\"font-label-md text-label-md font-semibold text-on-surface\">{$label}</span>";
    echo "<div class=\"relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in\">";
    echo "<input {$checked} class=\"toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer z-10 transition-transform duration-200 ease-in-out left-0 top-0 translate-x-0 checked:translate-x-6 border-surface-container-high checked:border-primary\" id=\"{$idToggle}\" name=\"day_{$k}_enabled\" type=\"checkbox\"/>";
    echo "<label class=\"toggle-label block overflow-hidden h-6 rounded-full bg-surface-container-high cursor-pointer transition-colors duration-200 ease-in-out\" for=\"{$idToggle}\"></label>";
    echo "</div></div>";
    echo "<div class=\"flex items-center gap-sm w-full md:w-auto\">";
    echo "<div class=\"relative flex-1 md:w-32\"><input name=\"day_{$k}_from\" type=\"time\" value=\"09:00\" class=\"w-full bg-surface-container-lowest border border-outline-variant text-on-surface font-body-md text-body-md rounded-lg px-3 py-2 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors\" " . ($k==='sun'?'disabled':'') . "/></div>";
    echo "<span class=\"text-on-surface-variant font-label-md text-label-md\">to</span>";
    echo "<div class=\"relative flex-1 md:w-32\"><input name=\"day_{$k}_to\" type=\"time\" value=\"17:00\" class=\"w-full bg-surface-container-lowest border border-outline-variant text-on-surface font-body-md text-body-md rounded-lg px-3 py-2 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors\" " . ($k==='sun'?'disabled':'') . "/></div>";
    echo "</div></div>";
}
?>
</div>
</section>
<!-- Service Area & Locations Section -->
<section class="bg-surface-container-lowest rounded-xl p-md md:p-lg shadow-[0_4px_12px_rgba(0,0,0,0.05)] transition-all hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)]">
<div class="flex items-center gap-sm mb-lg">
<div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined">map</span>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Service Area</h3>
<p class="font-body-md text-body-md text-on-surface-variant text-sm mt-1">Define where you are willing to travel for jobs.</p>
</div>
</div>
<!-- Service Radius Slider -->
<div class="mb-xl">
<div class="flex justify-between items-end mb-sm">
<label class="font-label-md text-label-md font-semibold text-on-surface" for="radius-slider">Service Radius</label>
<span class="font-headline-md text-headline-md text-primary" id="radius-display">15 miles</span>
</div>
<div class="relative w-full py-4">
<input class="w-full appearance-none bg-transparent focus:outline-none" id="radius-slider" max="50" min="5" oninput="document.getElementById('radius-display').innerText = this.value + ' miles'" type="range" value="15"/>
<div class="flex justify-between text-xs font-label-sm text-on-surface-variant mt-2 px-1">
<span>5 mi</span>
<span>50 mi</span>
</div>
</div>
</div>
<!-- Work Locations Input -->
<div>
<label class="block font-label-md text-label-md font-semibold text-on-surface mb-sm" for="location-input">Specific Neighborhoods or Zip Codes</label>
<div class="flex gap-sm mb-md">
<div class="relative flex-grow">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">location_on</span>
<input class="w-full bg-surface border border-outline-variant text-on-surface font-body-md text-body-md rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all placeholder:text-on-surface-variant" id="location-input" placeholder="e.g. Brooklyn, 11201" type="text"/>
</div>
<button id="addLocationBtn" class="bg-surface-container-high text-primary hover:bg-primary-fixed transition-colors px-4 rounded-lg font-label-md text-label-md font-semibold active:scale-95 flex items-center gap-1" type="button">
<span class="material-symbols-outlined text-sm">add</span> Add
                        </button>
</div>
<!-- Location Tags -->
<div id="locationTags" class="flex flex-wrap gap-2">
<div class="inline-flex items-center gap-1 bg-surface-container-high text-on-surface font-label-sm text-label-sm px-3 py-1.5 rounded-full border border-outline-variant">
<span>Brooklyn</span>
<button class="text-on-surface-variant hover:text-error transition-colors rounded-full flex items-center justify-center p-0.5" type="button">
<span class="material-symbols-outlined text-[16px]">close</span>
</button>
</div>
<div class="inline-flex items-center gap-1 bg-surface-container-high text-on-surface font-label-sm text-label-sm px-3 py-1.5 rounded-full border border-outline-variant">
<span>Queens</span>
<button class="text-on-surface-variant hover:text-error transition-colors rounded-full flex items-center justify-center p-0.5" type="button">
<span class="material-symbols-outlined text-[16px]">close</span>
</button>
</div>
<div class="inline-flex items-center gap-1 bg-surface-container-high text-on-surface font-label-sm text-label-sm px-3 py-1.5 rounded-full border border-outline-variant">
<span>Manhattan</span>
<button class="text-on-surface-variant hover:text-error transition-colors rounded-full flex items-center justify-center p-0.5" type="button">
<span class="material-symbols-outlined text-[16px]">close</span>
</button>
</div>
</div>
</div>
</section>
<!-- Decorative visual element to add warmth as per brand guidelines -->
<div class="rounded-xl overflow-hidden h-48 relative shadow-sm">
<div class="absolute inset-0 bg-cover bg-center w-full h-full opacity-40 mix-blend-multiply" data-alt="A warm, bright workshop scene with a wooden table, scattered blueprints, and well-worn artisan hand tools bathed in soft, natural morning light, conveying a sense of professional craft and reliability in a modern humanist style." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD61abwStbGX67RS4TNPHl8gYwoCyHgdd56WLyGK73BIWhmAfD5eIehmqUgm_zBkNVopqiAPB4SYurmfnrK0DyhC1HZyjxZbvzhViJY_6sTlKcFjbPa3KOaLYZHjZlXgDXKZryWGZm4a4k2n3q8nBv_c0qyhEeiwsjqK6ZzMO3TDl272fCO-ZSLXLMnqxF2hen1c70yq5AunonZ_f59npQwNUkEutfnIf9KIvLm828auxgdQS-I4pCi')"></div>
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex items-end p-md">
<p class="text-on-primary font-headline-md text-headline-md font-semibold">Almost there. <br/><span class="font-body-md text-body-md font-normal text-primary-fixed">Ready to connect with clients.</span></p>
</div>
</div>
<!-- Footer Action -->
<div class="pt-lg flex flex-col sm:flex-row gap-sm justify-between items-center border-t border-outline-variant">
<button id="backBtn" class="w-full sm:w-auto text-primary hover:bg-surface-container-low transition-colors px-6 py-3 rounded-xl font-label-md text-label-md font-semibold active:opacity-80" type="button">
                    Back to Step 2
                </button>
<button id="completeBtn" class="w-full sm:w-auto bg-primary text-on-primary hover:bg-primary-container transition-colors px-8 py-4 rounded-xl font-headline-md text-[18px] font-bold active:scale-[0.98] shadow-md hover:shadow-lg flex items-center justify-center gap-2" type="button">
                    Complete Profile
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">check_circle</span>
</button>
</div>
</form>
</main>
<script>
// Reuse the interactive JS for functionality
const radius = document.getElementById('radius-slider');
const radiusDisplay = document.getElementById('radius-display');
if (radius && radiusDisplay) radius.addEventListener('input', ()=> radiusDisplay.innerText = radius.value + ' miles');

document.querySelectorAll('input[type=checkbox][id^="toggle-"]').forEach(cb=>{
    const day = cb.id.replace('toggle-','');
    const from = document.querySelector('input[name="day_'+day+'_from"]');
    const to = document.querySelector('input[name="day_'+day+'_to"]');
    function update(){
        const enabled = cb.checked;
        if (from) from.disabled = !enabled;
        if (to) to.disabled = !enabled;
        if (enabled){ from.classList.remove('opacity-50'); to.classList.remove('opacity-50'); } else { from.classList.add('opacity-50'); to.classList.add('opacity-50'); }
    }
    cb.addEventListener('change', update);
    update();
});

const addBtn = document.getElementById('addLocationBtn');
const locInput = document.getElementById('location-input');
const tags = document.getElementById('locationTags');
function addTag(text){
    if (!text) return;
    const wrap = document.createElement('div');
    wrap.className = 'inline-flex items-center gap-1 bg-surface-container-high text-on-surface font-label-sm px-3 py-1.5 rounded-full border';
    const span = document.createElement('span'); span.textContent = text;
    const btn = document.createElement('button'); btn.type='button'; btn.className='text-on-surface-variant p-0.5'; btn.innerHTML='<span class="material-symbols-outlined" style="font-size:16px">close</span>';
    btn.addEventListener('click', ()=> wrap.remove());
    wrap.appendChild(span); wrap.appendChild(btn); tags.appendChild(wrap);
}
if (addBtn) addBtn.addEventListener('click', ()=>{ if (locInput.value.trim()){ addTag(locInput.value.trim()); locInput.value=''; locInput.focus(); }});

document.getElementById('saveExitBtn').addEventListener('click', ()=>{
    const payload = collect();
    postForm(payload, 'save_exit');
});

document.getElementById('backBtn').addEventListener('click', ()=>{
    window.location.href = '/Handylink/artisan/verification-credentials.php';
});

document.getElementById('completeBtn').addEventListener('click', ()=>{
    const payload = collect();
    postForm(payload, 'complete');
});

function collect(){
    const data = new FormData();
    ['mon','tue','wed','thu','fri','sat','sun'].forEach(d=>{
        const enabled = !!document.getElementById('toggle-'+d)?.checked;
        data.append('day_'+d+'_enabled', enabled ? '1' : '');
        data.append('day_'+d+'_from', document.querySelector('input[name="day_'+d+'_from"]')?.value || '');
        data.append('day_'+d+'_to', document.querySelector('input[name="day_'+d+'_to"]')?.value || '');
    });
    if (document.getElementById('radius-slider')) data.append('radius', document.getElementById('radius-slider').value);
    tags.querySelectorAll('div > span:first-child').forEach(s=> data.append('locations[]', s.textContent));
    return data;
}

function postForm(formData, action){
    formData.append('action', action);
    fetch(window.location.href, { method: 'POST', body: formData, credentials: 'same-origin' })
    .then(r=>{ if (r.redirected) window.location.href = r.url; else window.location.reload(); })
    .catch(()=> alert('Could not save.'));
}
</script>
</body>
</html>
