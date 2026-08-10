<?php
session_start();
header('Content-Type: application/json');
// Basic validation: require a business/artisan name
$business = $_SESSION['businessName'] ?? $_SESSION['availability']['businessName'] ?? null;
$artisanName = isset($_SESSION['availability']) ? ($_SESSION['availability']['businessName'] ?? null) : null;
// also allow earlier onboarding field
if (empty($_SESSION)) {
    echo json_encode(['success'=>false,'message'=>'No session data']);
    exit;
}
if (empty($_SESSION['availability'])) {
    // still allow submission but mark as incomplete
    // For now, return failure to encourage saving availability first
    echo json_encode(['success'=>false,'message'=>'Availability not set']);
    exit;
}
// Simulate submission processing: set statuses in session
$_SESSION['profile_submission'] = [
    'submitted_at' => time(),
    'verification' => [
        'government_id' => 'received',
        'selfie' => 'received',
        'certificates' => 'received',
        'admin' => 'pending'
    ]
];
// Return success
echo json_encode(['success'=>true]);
exit;
?>