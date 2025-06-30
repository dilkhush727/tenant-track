<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Verify Email</title></head>
<body>
    <h3>Hello <?= esc($name) ?>,</h3>
    <p>Thanks for registering on <strong>TenantTrack</strong>.</p>
    <p>Click below to verify your email:</p>
    <p><a href="<?= esc($link) ?>">Verify Email</a></p>
    <p>If you didn't register, you can ignore this email.</p>
</body>
</html>
