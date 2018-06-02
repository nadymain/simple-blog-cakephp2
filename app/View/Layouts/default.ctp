<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php echo $this->fetch('title'); ?>
			<?php echo __(' - '); ?>
			<?php echo Configure::read('site_title'); ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->Html->css('main');
		?>
	</head>
	<body>	
		<?php if ($this->Session->check('Auth.User.username')): ?>
		<div class="topbar clear">
			<?php echo $this->element('Main/topbar'); ?>
		</div>
		<?php endif ?>

		<div class="wide">
			<div class="brand">
				<?php if (Configure::read('site_brand')) : ?> 
					<?php echo $this->Html->image('uploads/'.Configure::read('site_brand'),
						array(
							'alt' => Configure::read('site_title')
						)
				); ?>
				<?php else : ?>
					<h1>
						<?php echo $this->Html->link(Configure::read('site_title'),
							array(
								'controller' => 'pages',
								'action' => 'display',
								'home'
							)
						); ?>
					</h1>
				<?php endif ?>
				<p><?php echo Configure::read('site_tagline'); ?></p>
			</div>

			<div class="menu clear">
				<?php echo $this->element('Main/mainmenu'); ?>
			</div>
			
			<div class="main">
				<?php echo $this->Flash->render(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>

			<div class="footer">
				<?php echo __('&copy; ' . $this->Html->link(Configure::read('site_title'), '/') . date(' Y')); ?>
			</div>
		</div>

		<?php echo $this->element('sql_dump'); ?>

		<!-- script -->
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('dropit.min'); ?>
		<?php echo $this->Html->script('main'); ?>
		<?php echo $this->fetch('script'); ?>
		<?php echo $this->fetch('inline-script'); ?>
	</body>
</html>
