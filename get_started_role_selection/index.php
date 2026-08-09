<?php
$pageTitle = 'HandyLink - Get Started';
$bodyClass = 'bg-surface font-body-md text-on-surface antialiased min-h-screen flex flex-col items-center';
include dirname(__DIR__) . '/includes/header.php';
?>
<main class="w-full max-w-max-width mx-margin-desktop flex flex-col min-h-screen relative overflow-hidden bg-surface-bright pb-xl">
<div class="w-full h-[40vh] md:h-[45vh] relative hero-clip shrink-0">
<img alt="Artisan working" class="w-full h-full object-cover" data-alt="A warm, highly detailed illustration of a skilled female electrician working on a modern circuit board. The scene is bathed in golden hour sunlight streaming through a nearby window, creating a modern light-mode aesthetic. The color palette features warm amber and deep teal accents against a pristine background. The mood is professional, reliable, and deeply human." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOEPPNxs3Z_79IQ6GlmU0KaItLZlso0DlsBxiEmBSv9sWfhcgywIT6S4IHr8PrdQzubRiCMF1QZo7ivj3KNJ3aRXlK54Q8srSvmdfjWfsx1XmYWBhE6I5TtLbFh1ZqzzoF_U7IFQV0FIXUqz8tzY1jyMeYwlLdhcikOkslF4BooxgCxlaAlEC67-R-QUzfXOF-7gHG6mbyGZyfV_zrhwHVQ7KDvRRm6-zAlvoYOYvb5U7zh6Lax1Qt"/>
<div class="absolute inset-0 bg-gradient-to-t from-surface-bright/80 to-transparent"></div>
</div>
<div class="flex-1 flex flex-col items-center px-margin-mobile md:px-md -mt-md relative z-10 max-w-2xl mx-auto w-full">
<div class="mb-sm">
<img alt="HandyLink Logo" class="w-24 h-24 object-contain mx-auto rounded-md shadow-sm bg-surface-container-lowest" src="https://lh3.googleusercontent.com/aida-public/AB6AXuATI0OX5rPUmuEvyHP4Er-IHUvO3ZeI7fAlfs41TbpFIznYQqUmpe5hqbhx7Ns2OCdyQuOqyqP96PU2BbQzYixH7DzjOkLN3iUE7yE1SVFJSzfLofsShpoLQM3dZn42F5NkUGNW_D1gQR65ltgaovHGnio4J6z5gSQWsLPu5KJtnAxDjlkrC4anec0BfDigomVXyLBuCOefOcpa3DQ2648AgvljoWwtiUy8LfA6rCj0KuewQc1sgEFL"/>
</div>
<div class="text-center mb-lg w-full">
<h1 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-xs">What brings you here today?</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Choose how you'll use HandyLink</p>
</div>
<div class="w-full space-y-md flex flex-col items-center">
<a href="/Handylink/auth/register.php?role=customer" class="w-full text-left bg-surface-container-lowest rounded-xl p-md ambient-shadow-1 ambient-shadow-2 transition-all duration-300 ease-out group relative overflow-hidden border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary-container">
<div class="absolute inset-0 bg-gradient-to-r from-surface-container-lowest to-surface-container-low opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
<div class="relative z-10 flex items-start gap-md">
<div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center shrink-0 group-hover:bg-primary-container/20 transition-colors duration-300">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 0;">search</span>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface mb-xs group-hover:text-primary transition-colors duration-300">I need a service</h2>
<p class="font-label-md text-label-md text-on-surface-variant">Find trusted electricians, plumbers, tailors &amp; more near you</p>
</div>
</div>
</a>
<a href="/Handylink/auth/register.php?role=artisan" class="w-full text-left bg-surface-container-lowest rounded-xl p-md ambient-shadow-1 ambient-shadow-2 transition-all duration-300 ease-out group relative overflow-hidden border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary-container">
<div class="absolute inset-0 bg-gradient-to-r from-surface-container-lowest to-surface-container-low opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
<div class="relative z-10 flex items-start gap-md">
<div class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center shrink-0 group-hover:bg-secondary-container/30 transition-colors duration-300">
<span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 0;">home_repair_service</span>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface mb-xs group-hover:text-secondary transition-colors duration-300">I offer a service</h2>
<p class="font-label-md text-label-md text-on-surface-variant">Get hired, grow your business, get paid securely</p>
</div>
</div>
</a>
</div>
<div class="mt-xl text-center w-full">
<a class="font-label-md text-label-md text-primary font-semibold hover:text-primary-container hover:underline transition-colors focus:outline-none focus:ring-2 focus:ring-primary-container rounded px-xs py-1" href="/Handylink/auth/login.php">
                    Already have an account? Log in
                </a>
</div>
</div>
</main>
</body>
</html>
