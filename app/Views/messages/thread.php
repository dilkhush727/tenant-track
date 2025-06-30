<?php foreach ($messages as $message): ?>
    <div class="<?= $message['sender_id'] == session('user_id') ? 'repaly' : 'sender' ?>">
        <p><?= esc($message['body']) ?></p>
        <span class="time">
            <?php
            $date = new DateTime($message['created_at']);
            echo $date->format('h:i A');
            ?>
        </span>
    </div>
<?php endforeach; ?>
