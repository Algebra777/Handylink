<?php
if (!isset($pageTitle)) {
    $pageTitle = 'HandyLink';
}
if (!isset($bodyClass)) {
    $bodyClass = '';
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?= htmlspecialchars($pageTitle) ?></title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-container": "#fea619",
                        "on-primary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "outline-variant": "#bfc8c6",
                        "primary-fixed-dim": "#9ad1cb",
                        "surface-container-high": "#dce9ff",
                        "on-surface-variant": "#404847",
                        "surface-tint": "#316763",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#b1b4b6",
                        "surface": "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff",
                        "on-tertiary": "#ffffff",
                        "secondary-fixed-dim": "#ffb95f",
                        "secondary-fixed": "#ffddb8",
                        "surface-container-low": "#eff4ff",
                        "on-tertiary-fixed": "#191c1e",
                        "background": "#f8f9ff",
                        "on-secondary": "#ffffff",
                        "primary-container": "#134e4a",
                        "on-primary-container": "#87beb8",
                        "on-primary-fixed-variant": "#144f4b",
                        "secondary": "#855300",
                        "surface-container-highest": "#d5e3fc",
                        "tertiary-fixed": "#e0e3e5",
                        "surface-variant": "#d5e3fc",
                        "on-background": "#0d1c2e",
                        "inverse-primary": "#9ad1cb",
                        "tertiary-fixed-dim": "#c4c7c9",
                        "on-surface": "#0d1c2e",
                        "outline": "#707977",
                        "on-secondary-fixed-variant": "#653e00",
                        "on-tertiary-fixed": "#191c1e",
                        "tertiary": "#2c3032",
                        "primary": "#003633",
                        "tertiary-container": "#434648",
                        "surface-bright": "#f8f9ff",
                        "inverse-surface": "#233144",
                        "on-secondary-fixed": "#2a1700",
                        "primary-fixed": "#b5ede7",
                        "surface-dim": "#ccdbf3",
                        "on-secondary-container": "#684000",
                        "surface-container": "#e6eeff",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#00201e"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "lg": "40px",
                        "max-width": "1200px",
                        "margin-mobile": "20px",
                        "xl": "64px",
                        "sm": "12px",
                        "base": "8px",
                        "xs": "4px",
                        "margin-desktop": "auto",
                        "gutter": "16px",
                        "md": "24px"
                    },
                    "fontFamily": {
                        "body-md": ["Public Sans", "sans-serif"],
                        "display-lg": ["Public Sans", "sans-serif"],
                        "label-md": ["Public Sans", "sans-serif"],
                        "headline-lg": ["Public Sans", "sans-serif"],
                        "headline-md": ["Public Sans", "sans-serif"],
                        "label-sm": ["Public Sans", "sans-serif"],
                        "body-lg": ["Public Sans", "sans-serif"],
                        "headline-lg-mobile": ["Public Sans", "sans-serif"]
                    },
                    "fontSize": {
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "34px", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .ambient-shadow-1 {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .ambient-shadow-2:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }
        .ambient-shadow-2:active {
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
            transform: scale(0.98) translateY(1px);
        }
        .hero-clip {
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
        }
    </style>
<style>
        :root {
            --surface: #f8f9ff;
            --surface-container-lowest: #ffffff;
            --surface-container-low: #eff4ff;
            --primary: #003633;
            --primary-container: #134e4a;
            --on-primary: #ffffff;
            --on-surface: #0d1c2e;
            --on-surface-variant: #404847;
            --outline-variant: #bfc8c6;
            --outline: #707977;
            --error: #ba1a1a;
            --error-container: #ffdad6;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Public Sans', sans-serif;
            background: var(--surface);
            color: var(--on-surface);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        button, input { font: inherit; }
        .bg-surface { background-color: var(--surface) !important; }
        .bg-surface-container-lowest { background-color: var(--surface-container-lowest) !important; }
        .bg-surface-container-low { background-color: var(--surface-container-low) !important; }
        .bg-primary-container { background-color: var(--primary-container) !important; }
        .text-primary { color: var(--primary) !important; }
        .text-on-primary { color: var(--on-primary) !important; }
        .text-on-surface { color: var(--on-surface) !important; }
        .text-on-surface-variant { color: var(--on-surface-variant) !important; }
        .text-outline-variant { color: var(--outline-variant) !important; }
        .border-outline-variant { border-color: var(--outline-variant) !important; }
        .border-outline-variant\/40 { border-color: rgba(112, 121, 119, 0.4) !important; }
        .border-error { border-color: var(--error) !important; }
        .bg-error-container { background-color: var(--error-container) !important; }
        .text-error { color: var(--error) !important; }
        .w-full { width: 100% !important; }
        .max-w-md { max-width: 28rem !important; }
        .max-w-max-width { max-width: 1200px !important; }
        .mx-margin-desktop { margin-left: auto !important; margin-right: auto !important; }
        .flex { display: flex !important; }
        .flex-col { flex-direction: column !important; }
        .items-center { align-items: center !important; }
        .justify-center { justify-content: center !important; }
        .justify-between { justify-content: space-between !important; }
        .flex-grow { flex-grow: 1 !important; }
        .min-h-screen { min-height: 100vh !important; }
        .p-margin-mobile { padding: 20px !important; }
        .px-margin-mobile { padding-left: 20px !important; padding-right: 20px !important; }
        .py-sm { padding-top: 12px !important; padding-bottom: 12px !important; }
        .p-md { padding: 24px !important; }
        .p-lg { padding: 40px !important; }
        .mb-lg { margin-bottom: 40px !important; }
        .mb-md { margin-bottom: 24px !important; }
        .mb-sm { margin-bottom: 12px !important; }
        .mt-sm { margin-top: 12px !important; }
        .mt-lg { margin-top: 40px !important; }
        .my-md { margin-top: 24px !important; margin-bottom: 24px !important; }
        .gap-xs { gap: 4px !important; }
        .gap-sm { gap: 12px !important; }
        .gap-md { gap: 24px !important; }
        .rounded-xl { border-radius: 0.75rem !important; }
        .rounded-full { border-radius: 9999px !important; }
        .border { border: 1px solid currentColor !important; }
        .border-b { border-bottom: 1px solid currentColor !important; }
        .border-outline-variant { border-color: var(--outline-variant) !important; }
        .shadow-\[0_4px_12px_rgba\(0\,0\,0\,0\.05\)\] { box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important; }
        .hover\:bg-surface-container-low:hover { background-color: var(--surface-container-low) !important; }
        .hover\:bg-primary:hover { background-color: var(--primary) !important; }
        .text-center { text-align: center !important; }
        .font-bold { font-weight: 700 !important; }
        .font-label-md { font-size: 14px !important; line-height: 20px !important; font-weight: 500 !important; }
        .font-label-sm { font-size: 12px !important; line-height: 16px !important; font-weight: 600 !important; }
        .font-body-md { font-size: 16px !important; line-height: 24px !important; font-weight: 400 !important; }
        .font-headline-lg-mobile { font-size: 28px !important; line-height: 34px !important; font-weight: 600 !important; }
        .font-headline-lg { font-size: 32px !important; line-height: 40px !important; letter-spacing: -0.01em !important; font-weight: 600 !important; }
        .text-headline-lg-mobile { font-size: 28px !important; line-height: 34px !important; font-weight: 600 !important; }
        .text-headline-lg { font-size: 32px !important; line-height: 40px !important; letter-spacing: -0.01em !important; font-weight: 600 !important; }
        .h-12 { height: 3rem !important; }
        .h-px { height: 1px !important; }
        .w-5 { width: 1.25rem !important; }
        .h-5 { height: 1.25rem !important; }
        .w-24 { width: 6rem !important; }
        .h-24 { height: 6rem !important; }
        .pl-10 { padding-left: 2.5rem !important; }
        .pr-10 { padding-right: 2.5rem !important; }
        .pr-sm { padding-right: 12px !important; }
        .left-sm { left: 12px !important; }
        .right-sm { right: 12px !important; }
        .top-1\/2 { top: 50% !important; }
        .-translate-y-1\/2 { transform: translateY(-50%) !important; }
        .absolute { position: absolute !important; }
        .relative { position: relative !important; }
        .focus\:border-primary:focus { border-color: var(--primary) !important; }
        .focus\:ring-2:focus { box-shadow: 0 0 0 2px rgba(0,54,51,0.2) !important; }
        .focus\:outline-none:focus { outline: none !important; }
        .transition-all { transition: all 0.2s ease !important; }
        .placeholder\:text-outline::placeholder { color: var(--outline) !important; }
        .uppercase { text-transform: uppercase !important; }
        .tracking-wider { letter-spacing: 0.05em !important; }
        .max-w-\[280px\] { max-width: 280px !important; }
        .mx-auto { margin-left: auto !important; margin-right: auto !important; }
        .hover\:underline:hover { text-decoration: underline !important; }
        .hover\:shadow-\[0_8px_20px_rgba\(0\,0\,0\,0\.08\)\]:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important; }
        @media (min-width: 768px) {
            .md\:p-md { padding: 24px !important; }
            .md\:p-lg { padding: 40px !important; }
            .md\:px-md { padding-left: 24px !important; padding-right: 24px !important; }
            .md\:font-headline-lg { font-size: 32px !important; line-height: 40px !important; letter-spacing: -0.01em !important; font-weight: 600 !important; }
            .md\:text-headline-lg { font-size: 32px !important; line-height: 40px !important; letter-spacing: -0.01em !important; font-weight: 600 !important; }
        }
    </style>
</head>
<body class="<?= htmlspecialchars($bodyClass) ?>">
    <style>
        .nav-logo { height: 28px; width: auto; display: inline-block; vertical-align: middle; }
        .nav-logo--large { height: 40px; }
    </style>
    <script>
        // Robustly replace any textual occurrence of the word "HandyLink" with the logo image.
        // Skips the get-started index page.
        document.addEventListener('DOMContentLoaded', function(){
            try {
                var skipPath = '/Handylink/get_started_role_selection/index.php';
                if (window.location.pathname && window.location.pathname.indexOf(skipPath) !== -1) return;

                var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
                var textNodes = [];
                var node;
                while (node = walker.nextNode()) {
                    if (node.nodeValue && /\bHandyLink\b/.test(node.nodeValue)) textNodes.push(node);
                }

                textNodes.forEach(function(textNode) {
                    var parent = textNode.parentNode;
                    if (!parent) return;
                    var parts = textNode.nodeValue.split(/(HandyLink)/);
                    var frag = document.createDocumentFragment();
                    parts.forEach(function(part){
                        if (part === 'HandyLink') {
                            var img = document.createElement('img');
                            img.src = '/Handylink/logo2.png';
                            img.alt = 'HandyLink';
                            img.className = 'nav-logo';
                            frag.appendChild(img);
                        } else if (part.length) {
                            frag.appendChild(document.createTextNode(part));
                        }
                    });
                    parent.replaceChild(frag, textNode);
                });

                // Ensure logos in header/nav areas are a comfortable size
                var headerAreas = document.querySelectorAll('header, .nav, .navbar, .topbar');
                headerAreas.forEach(function(h){
                    var imgs = h.querySelectorAll('img.nav-logo');
                    imgs.forEach(function(img){ img.classList.add('nav-logo'); });
                });
            } catch (e) { console.warn('Logo replace script error', e); }
        });
    </script>
