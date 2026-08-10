<?php
session_start();
$pageTitle = 'Confirm Submission';
include dirname(__DIR__) . '/includes/header.php';
?>
<main class="min-h-screen flex items-center justify-center px-4 py-8">
  <div class="max-w-md w-full bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.06)] text-center">
    <h1 class="font-headline-lg text-headline-lg mb-4">Submit your profile for review?</h1>
    <p class="text-on-surface-variant mb-6">You can still edit your details after submitting.</p>
    <div class="flex gap-4 justify-center">
      <a href="/Handylink/artisan/verification-credentials.php" class="px-6 py-3 rounded-lg border border-outline-variant text-primary">No, review again</a>
      <a id="yesSubmit" href="/Handylink/artisan/submitting.php" class="px-6 py-3 rounded-lg bg-primary text-on-primary">Yes, submit</a>
    </div>
  </div>
</main>
</body>
</html>
