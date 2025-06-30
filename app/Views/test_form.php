<!doctype html>
<html><body>
<h1>Test Form (should show POST data after submit)</h1>
<form method="post" action="test-form">
    <?= csrf_field() ?>
    <input name="foo" placeholder="Type anything" required>
    <button type="submit">Submit</button>
</form>
</body></html>
