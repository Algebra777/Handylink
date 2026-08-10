<?php
session_start();
$pageTitle = 'Success';
include dirname(__DIR__) . '/includes/header.php';
?>
<main class="min-h-screen flex items-center justify-center px-4 py-8">
  <div class="max-w-md w-full bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.06)] text-center">
    <div class="mx-auto w-20 h-20 rounded-full bg-primary-container flex items-center justify-center mb-6">
      <span class="material-symbols-outlined text-on-primary" style="font-size:36px">check</span>
    </div>
    <h2 class="font-headline-md text-headline-md mb-2">Profile completed successfully!</h2>
    <p class="text-on-surface-variant mb-4">Redirecting...</p>
  </div>
</main>
<script>
setTimeout(()=> { window.location.href = '/Handylink/artisan/under-review.php'; }, 1200);
</script>
</body>
</html>
