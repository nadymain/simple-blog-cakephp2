<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php echo 'Dashboard' ?>: <?php echo $this->fetch('title'); ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css('dashboard');
			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
	</head>
	<body class="body-iframe">
		<div class="main">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->element('sql_dump'); ?>
		</div>
		
		<!-- script -->
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('dashboard'); ?>
		<?php echo $this->fetch('script'); ?>
		<?php echo $this->fetch('inline-script'); ?>
	</body>
</html>