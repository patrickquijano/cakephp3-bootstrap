<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
$dismiss = '';
if (!isset($params['dismiss']) || $params['dismiss'] !== false) {
    $dismiss = ' alert-dismissible fade show';
}
?>
<div class="alert alert-success<?= $dismiss; ?>" role="alert">
    <?= $message; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>