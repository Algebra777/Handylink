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
            <img alt="HandyLink Logo" class="h-8 object-contain" src="logo2.png"/>
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

    <form id="onboardForm" method="post" action="/Handylink/artisan/verification-credentials.php" enctype="multipart/form-data" class="flex flex-col gap-lg bg-surface-container-lowest p-md md:p-lg rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant">
        <div class="flex flex-col items-center gap-md">
            <div id="photoUploadArea" class="relative w-32 h-32 rounded-full bg-surface-container-high border-2 border-dashed border-outline-variant flex flex-col items-center justify-center cursor-pointer hover:bg-surface-container transition-colors group overflow-hidden">
                <input id="photoInput" name="profilePhoto" type="file" accept="image/*" class="hidden" />
                <img id="photoPreview" alt="Profile preview" class="absolute inset-0 w-full h-full object-cover rounded-full hidden" />
                <div id="photoPlaceholder" class="w-full h-full flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-outline text-4xl mb-2 group-hover:text-primary">add_a_photo</span>
                    <span class="font-label-sm text-label-sm text-outline group-hover:text-primary">Upload Photo</span>
                </div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant text-center max-w-xs">A clear, professional photo helps build trust with potential customers.</p>
        </div>

        <hr class="border-outline-variant opacity-50"/>

        <div class="flex flex-col gap-md">
            <div class="flex flex-col gap-xs">
                <label class="font-label-md text-label-md text-on-surface font-semibold" for="businessName">Business or Artisan Name *</label>
                <input id="businessName" name="businessName" placeholder="e.g. Sarah's Electric Services" type="text" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="you@example.com" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                </div>
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="phone">Phone Number</label>
                    <input id="phone" name="phone" type="tel" placeholder="e.g. +1 555 555 5555" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="serviceCategory">Primary Service Category *</label>
                    <div class="relative">
                        <select id="serviceCategory" name="serviceCategory" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface appearance-none focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                            <option value="" disabled selected>Select a category</option>
                            <option value="plumbing">Plumbing</option>
                            <option value="electrical">Electrical</option>
                            <option value="carpentry">Carpentry</option>
                            <option value="landscaping">Landscaping</option>
                            <option value="cleaning">Cleaning</option>
                            <option value="hvac">HVAC / Heating &amp; Cooling</option>
                            <option value="painting">Painting</option>
                            <option value="appliance">Appliance Repair</option>
                            <option value="roofing">Roofing</option>
                            <option value="flooring">Flooring</option>
                            <option value="handyman">General Handyman</option>
                            <option value="remodeling">Remodeling</option>
                            <option value="tiling">Tiling</option>
                            <option value="locksmith">Locksmith</option>
                            <option value="garage">Garage Door Services</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                    </div>
                </div>
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="experience">Years of Experience *</label>
                    <input id="experience" name="experience" min="0" placeholder="e.g. 5" type="number" class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                </div>
            </div>
            <div class="flex flex-col gap-xs">
                <label class="font-label-md text-label-md text-on-surface font-semibold" for="bio">Short Bio *</label>
                <textarea id="bio" name="bio" rows="4" placeholder="Tell customers about your craft, your approach to work, and what makes your service special..." class="w-full rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all resize-y"></textarea>
            </div>
        </div>

        <hr class="border-outline-variant opacity-50"/>

        <div class="flex flex-col gap-sm">
            <div class="flex justify-between items-center">
                <label class="font-label-md text-label-md text-on-surface font-semibold">Specific Skills</label>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Optional but recommended</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant text-sm">Add specific skills to help customers find you for specialized tasks.</p>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <input id="skillInput" placeholder="e.g. Rewiring, Lighting installation" type="text" autocomplete="off" class="flex-grow rounded-[16px] border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                    <button id="addSkillBtn" type="button" class="bg-surface-container-high text-on-surface hover:bg-surface-variant px-4 rounded-[16px] font-label-md text-label-md transition-colors flex items-center justify-center">Add</button>
                </div>
                <ul id="skillSuggestions" class="hidden bg-surface-container-low border border-outline-variant rounded-md mt-1 max-h-40 overflow-auto"></ul>
            </div>
            <div id="skillsContainer" class="flex flex-wrap gap-2 mt-2"></div>
        </div>

        <!-- Footer Actions -->
        <div class="flex justify-end pt-sm pb-xl">
            <button id="continueBtn" type="button" class="bg-primary text-on-primary font-label-md text-label-md px-8 py-4 rounded-[16px] hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)] hover:bg-on-primary-fixed-variant transition-all active:scale-[0.98] min-h-[48px] inline-flex items-center gap-2">
                Continue to Step 2
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div>
    </form>
</main>
<script>
// Image selection & preview
const photoArea = document.getElementById('photoUploadArea');
const photoInput = document.getElementById('photoInput');
const photoPreview = document.getElementById('photoPreview');
const photoPlaceholder = document.getElementById('photoPlaceholder');
photoArea.addEventListener('click', () => photoInput.click());
photoInput.addEventListener('change', e => {
    const file = e.target.files && e.target.files[0];
    if (!file) return;
    if (!file.type.startsWith('image/')) { alert('Please select an image file.'); photoInput.value = ''; return; }
    const reader = new FileReader();
    reader.onload = () => {
        photoPreview.src = reader.result;
        photoPreview.classList.remove('hidden');
        photoPlaceholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
});

// Skills autocomplete and add
const SUGGESTIONS = [
    'Rewiring','Lighting Installation','Safety Inspections','Outlet Installation','Panel Upgrades','Ceiling Fan Installation','Switch Replacement','House Rewiring','Appliance Hookup','Emergency Repairs','Leak Detection','Drain Cleaning','Faucet Repair','Tile Work','Fence Repair','Lawn Mowing','Tree Trimming','Pressure Washing','HVAC Maintenance','Painting','Tiling','Roofing','Glazing','Locksmith Services','Garage Door Repair'
];
const skillInput = document.getElementById('skillInput');
const addSkillBtn = document.getElementById('addSkillBtn');
const skillsContainer = document.getElementById('skillsContainer');
const suggestionsBox = document.getElementById('skillSuggestions');

function showSuggestions(filtered) {
    suggestionsBox.innerHTML = '';
    if (!filtered.length) { suggestionsBox.classList.add('hidden'); return; }
    filtered.forEach(s => {
        const li = document.createElement('li');
        li.className = 'px-3 py-2 cursor-pointer hover:bg-surface-variant';
        li.textContent = s;
        li.addEventListener('click', () => { skillInput.value = s; suggestionsBox.classList.add('hidden'); skillInput.focus(); });
        suggestionsBox.appendChild(li);
    });
    suggestionsBox.classList.remove('hidden');
}

skillInput.addEventListener('input', () => {
    const val = skillInput.value.trim().toLowerCase();
    if (!val) { suggestionsBox.classList.add('hidden'); return; }
    const filtered = SUGGESTIONS.filter(s => s.toLowerCase().includes(val) && s.toLowerCase() !== val).slice(0,8);
    showSuggestions(filtered);
});

function createSkillChip(text) {
    const chip = document.createElement('div');
    chip.className = 'inline-flex items-center gap-1 bg-surface-container-low border border-outline-variant text-on-surface px-3 py-1.5 rounded-full font-label-sm text-label-sm';
    chip.textContent = text + ' ';
    const close = document.createElement('span');
    close.className = 'material-symbols-outlined text-[16px] cursor-pointer hover:text-error';
    close.textContent = 'close';
    close.addEventListener('click', () => { container.removeChild(chip); });
    const container = skillsContainer;
    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'skills[]';
    hidden.value = text;
    chip.appendChild(close);
    chip.appendChild(hidden);
    container.appendChild(chip);
}

addSkillBtn.addEventListener('click', () => {
    const val = skillInput.value.trim();
    if (!val) return;
    createSkillChip(val);
    skillInput.value = '';
    suggestionsBox.classList.add('hidden');
});

skillInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') { e.preventDefault(); addSkillBtn.click(); }
    if (e.key === 'ArrowDown') {
        const first = suggestionsBox.querySelector('li'); if (first) first.focus();
    }
});

// Form validation and continue
const continueBtn = document.getElementById('continueBtn');
const form = document.getElementById('onboardForm');
continueBtn.addEventListener('click', () => {
    const business = document.getElementById('businessName');
    const service = document.getElementById('serviceCategory');
    const experience = document.getElementById('experience');
    const bio = document.getElementById('bio');
    const required = [business, service, experience, bio];
    let firstInvalid = null;
    required.forEach(el => {
        el.classList.remove('ring-2','ring-error');
        if (!el.value || (typeof el.value === 'string' && !el.value.trim())) {
            if (!firstInvalid) firstInvalid = el;
            el.classList.add('border-error');
        }
    });
    if (firstInvalid) {
        firstInvalid.scrollIntoView({behavior:'smooth', block:'center'});
        firstInvalid.focus();
        alert('Please complete all required fields marked with * before continuing.');
        return;
    }
    saveOnboardDraft();
    form.submit();
});

// Persist form draft to sessionStorage so user edits are preserved when navigating
function saveOnboardDraft(){
    try{
        const draft = {
            businessName: document.getElementById('businessName')?.value || '',
            email: document.getElementById('email')?.value || '',
            phone: document.getElementById('phone')?.value || '',
            serviceCategory: document.getElementById('serviceCategory')?.value || '',
            experience: document.getElementById('experience')?.value || '',
            bio: document.getElementById('bio')?.value || '',
            skills: Array.from(document.querySelectorAll('#skillsContainer input[name="skills[]"]')).map(i=>i.value),
            photoPreview: document.getElementById('photoPreview')?.src || ''
        };
        sessionStorage.setItem('onboardDraft', JSON.stringify(draft));
    }catch(e){ /* ignore */ }
}

function restoreOnboardDraft(){
    try{
        const raw = sessionStorage.getItem('onboardDraft');
        if (!raw) return;
        const draft = JSON.parse(raw);
        if (draft.businessName) document.getElementById('businessName').value = draft.businessName;
        if (draft.email) document.getElementById('email').value = draft.email;
        if (draft.phone) document.getElementById('phone').value = draft.phone;
        if (draft.serviceCategory) document.getElementById('serviceCategory').value = draft.serviceCategory;
        if (draft.experience) document.getElementById('experience').value = draft.experience;
        if (draft.bio) document.getElementById('bio').value = draft.bio;
        if (draft.photoPreview) {
            photoPreview.src = draft.photoPreview; photoPreview.classList.remove('hidden'); photoPlaceholder.classList.add('hidden');
        }
        if (Array.isArray(draft.skills) && draft.skills.length){
            draft.skills.forEach(s=> createSkillChip(s));
        }
    }catch(e){ /* ignore */ }
}

// restore on load
document.addEventListener('DOMContentLoaded', ()=> restoreOnboardDraft());
</script>
</body></html>
