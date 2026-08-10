<?php
session_start();
$pageTitle = 'Submitting...';
include dirname(__DIR__) . '/includes/header.php';
?>
<main class="min-h-screen flex items-center justify-center px-4 py-8">
  <div class="max-w-md w-full bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.06)] text-center">
    <div id="spinner" class="mx-auto w-20 h-20 rounded-full bg-primary-container flex items-center justify-center mb-6">
      <div style="width:48px;height:48px;border:5px solid rgba(255,255,255,0.2);border-top-color:#ffffff;border-radius:50%;animation:spin 1s linear infinite"></div>
    </div>
    <h2 class="font-headline-md text-headline-md mb-2">Submitting...</h2>
    <p class="text-on-surface-variant mb-4">Please wait while we submit your profile.</p>
    <div id="error" class="hidden text-error mb-4"></div>
    <div id="retry" class="hidden">
      <a id="retryBtn" href="/Handylink/artisan/confirm-submission.php" class="px-4 py-2 bg-surface rounded-lg border border-outline-variant">Back to Confirm</a>
    </div>
  </div>
</main>
<style>@keyframes spin{to{transform:rotate(360deg)}}</style>
<script>
(async function(){
  try{
    // brief delay to ensure spinner is visible
    await new Promise(r=>setTimeout(r,400));
    const res = await fetch('/Handylink/artisan/submit-profile.php', { method: 'POST', credentials: 'same-origin' });
    const json = await res.json();
    if (json && json.success) {
      // show success page after a short pause
      setTimeout(()=> { window.location.href = '/Handylink/artisan/submit-success.php'; }, 3000);
    } else {
      document.getElementById('spinner').classList.add('hidden');
      const err = document.getElementById('error');
      err.textContent = json.message || 'Something went wrong, please try again.';
      err.classList.remove('hidden');
      document.getElementById('retry').classList.remove('hidden');
    }
  } catch (e) {
    document.getElementById('spinner').classList.add('hidden');
    const err = document.getElementById('error');
    err.textContent = 'Something went wrong, please try again.';
    err.classList.remove('hidden');
    document.getElementById('retry').classList.remove('hidden');
  }
})();
</script>
</body>
</html>
