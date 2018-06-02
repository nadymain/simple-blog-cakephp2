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
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->Html->css('dashboard');
		?>
	</head>
	<body>
		<div class="topbar">
			<?php echo $this->element('Dashboard/topbar'); ?>
		</div>

		<div class="aside">
			<?php echo $this->element('Dashboard/aside'); ?>
		</div>

		<div class="main">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
			<div class="version">
				<?php echo Configure::read('site_title'); ?> - <?php echo Configure::version() ?>
			</div>
			<?php echo $this->element('sql_dump'); ?>
		</div>
		
		<!-- script -->
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('dashboard'); ?>
		<?php echo $this->fetch('script'); ?>
		<?php echo $this->fetch('inline-script'); ?>
	</body>
</html>