
<p>Name: <?php echo h($name); ?></p>
<p>Email: <?php echo h($email); ?></p>
<p>Message:</p>
<p><?php echo nl2br(h($message)); ?></p>
<br>
<br>
<hr>
<p>>> <?php echo Router::url('/', true); ?></p>
