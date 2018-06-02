<?php 
    $this->assign('title', 'Login');

    echo $this->Html->meta(
		array(
			'name' => 'robots', 
			'content' => 'noindex, follow'
		), 
		null, 
		array('inline' => false)
	);
?>

<?php echo $this->Flash->render('auth'); ?>

<article>
	<div class="content">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
		<?php 
			echo $this->Form->input('username');
			echo $this->Form->input('password');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Login')); ?>
</div>
</article>