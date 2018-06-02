<article>
	<div class="content">
	<?php echo $this->Form->create('Contact', array('novalidate')); ?>
	<fieldset>
		<?php 
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('website', array('label' => false, 'style' => 'display:none'));
		echo $this->Form->input('message', array('type' => 'textarea'));
		?>
	</fieldset>
	<?php echo $this->Form->end(__d('Contact', 'Send')); ?>
	</div>
</article>
