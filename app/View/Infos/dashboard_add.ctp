<?php 
	$this->assign('title', 'Add Info'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.5 6v11.5c0 2.21-1.79 4-4 4s-4-1.79-4-4V5c0-1.38 1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5v10.5c0 .55-.45 1-1 1s-1-.45-1-1V6H10v9.5c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5V5c0-2.21-1.79-4-4-4S7 2.79 7 5v12.5c0 3.04 2.46 5.5 5.5 5.5s5.5-2.46 5.5-5.5V6h-1.5z"/></svg>
	</div>
	<h1 class="title">Add <span>Info</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array('controller' => 'infos', 'action' => 'index'),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="infos form clear">
<?php echo $this->Form->create('Info', array('novalidate')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('content',
			array(
				'id' => 'content',
				'rows' => 20,
			)
		);
		echo $this->Form->input('description');
		echo $this->Form->input('status', 
			array('options' => array('draft' => 'Draft', 'published' => 'Published'))
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php 
	echo $this->element('Dashboard/tinymcescript');
	echo $this->element('Dashboard/select2script');
?>
