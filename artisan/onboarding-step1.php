<?php
session_start();

$pageTitle = 'HandyLink - Artisan Onboarding Step 1';
$bodyClass = 'bg-surface min-h-screen flex flex-col text-on-surface';
include dirname(__DIR__) . '/includes/header.php';
?>
<!-- Top Navigation (Transactional, no shell nav) -->
<header class="bg-surface-container-lowest border-b border-outline-variant w-full top-0 sticky z-50">
    <div class="flex justify-between items-center px-md py-sm w-full max-w-max-width mx-margin-desktop">
        <div class="flex items-center gap-sm">
            <a class="p-2 rounded-full hover:bg-surface-container-low transition-colors text-on-surface-variant flex items-center justify-center" href="/Handylink/get_started_role_selection/index.php">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <img alt="HandyLink Logo" class="h-8 object-contain" src="https://lh3.googleusercontent.com/aida/AP1WRLu9TTpTz7KIDHX3nqDmVVYIcuwYXZBEnZPolYMZid9orxP6x1h8KG17UAQKorDo33_RtTCV-HJctvs6dwiGgADkCM-Pd8XYkJ8356bRbegYXIZJ7kd4INIL1TqX84EmYnNWgKqQgqj7Fdh7cI8w3NzFwoadB9sR6z7l33t6YM6nq6TLDQzgdEafzCn4clWrz_Lzelm2AycFQ4aeAWZ_MbSk4xMOGVUWS_fd4p1s3fduVQeiZFnFi3MJaCY"/>
        </div>
        <div class="text-right">
            <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Step 1 of 3</span>
        </div>
    </div>
    <div class="w-full bg-surface-variant h-1">
        <div class="bg-primary h-1" style="width: 33.33%;"></div>
    </div>
</header>
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-2xl mx-auto px-margin-mobile md:px-0 py-xl flex flex-col gap-xl">
    <div class="flex flex-col gap-sm">
        <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">Set up your Artisan Profile</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Tell us about your craft so customers can find you and book your services.</p>
    </div>

    <form class="flex flex-col gap-lg bg-surface-container-lowest p-md md:p-lg rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant">
        <div class="flex flex-col items-center gap-md">
            <div class="relative w-32 h-32 rounded-full bg-surface-container-high border-2 border-dashed border-outline-variant flex flex-col items-center justify-center cursor-pointer hover:bg-surface-container transition-colors group">
                <span class="material-symbols-outlined text-outline text-4xl mb-2 group-hover:text-primary">add_a_photo</span>
                <span class="font-label-sm text-label-sm text-outline group-hover:text-primary">Upload Photo</span>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant text-center max-w-xs">A clear, professional photo helps build trust with potential customers.</p>
        </div>

        <hr class="border-outline-variant opacity-50"/>

        <div class="flex flex-col gap-md">
            <div class="flex flex-col gap-xs">
                <label class="font-label-md text-label-md text-on-surface font-semibold" for="businessName">Business or Artisan Name *</label>
                <input id="businessName" placeholder="e.g. Sarah's Electric Services" type="text" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="serviceCategory">Primary Service Category *</label>
                    <div class="relative">
                        <select id="serviceCategory" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface appearance-none focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                            <option value="" disabled selected>Select a category</option>
                            <option value="plumbing">Plumbing</option>
                            <option value="electrical">Electrical</option>
                            <option value="carpentry">Carpentry</option>
                            <option value="landscaping">Landscaping</option>
                            <option value="cleaning">Cleaning</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                    </div>
                </div>
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="experience">Years of Experience *</label>
                    <input id="experience" min="0" placeholder="e.g. 5" type="number" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                </div>
            </div>
            <div class="flex flex-col gap-xs">
                <label class="font-label-md text-label-md text-on-surface font-semibold" for="bio">Short Bio *</label>
                <textarea id="bio" rows="4" placeholder="Tell customers about your craft, your approach to work, and what makes your service special..." class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all resize-y"></textarea>
            </div>
        </div>

        <hr class="border-outline-variant opacity-50"/>

        <div class="flex flex-col gap-sm">
            <div class="flex justify-between items-center">
                <label class="font-label-md text-label-md text-on-surface font-semibold">Specific Skills</label>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Optional but recommended</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant text-sm">Add specific skills to help customers find you for specialized tasks.</p>
            <div class="flex gap-2">
                <input id="skillInput" placeholder="e.g. Rewiring, Lighting installation" type="text" class="flex-grow rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                <button type="button" class="bg-surface-container-high text-on-surface hover:bg-surface-variant px-4 rounded-[16px] font-label-md text-label-md transition-colors flex items-center justify-center">Add</button>
            </div>
            <div class="flex flex-wrap gap-2 mt-2">
                <div class="inline-flex items-center gap-1 bg-surface-container-low border border-outline-variant text-on-surface px-3 py-1.5 rounded-full font-label-sm text-label-sm">Rewiring <span class="material-symbols-outlined text-[16px] cursor-pointer hover:text-error">close</span></div>
                <div class="inline-flex items-center gap-1 bg-surface-container-low border border-outline-variant text-on-surface px-3 py-1.5 rounded-full font-label-sm text-label-sm">Lighting <span class="material-symbols-outlined text-[16px] cursor-pointer hover:text-error">close</span></div>
                <div class="inline-flex items-center gap-1 bg-surface-container-low border border-outline-variant text-on-surface px-3 py-1.5 rounded-full font-label-sm text-label-sm">Safety Inspections <span class="material-symbols-outlined text-[16px] cursor-pointer hover:text-error">close</span></div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="flex justify-end pt-sm pb-xl">
            <a href="/Handylink/artisan/verification-credentials.php" role="button" class="bg-primary text-on-primary font-label-md text-label-md px-8 py-4 rounded-[16px] hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)] hover:bg-on-primary-fixed-variant transition-all active:scale-[0.98] min-h-[48px] inline-flex items-center gap-2">
                Continue to Step 2
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </form>
</main>
</body></html>
