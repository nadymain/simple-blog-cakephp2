<?php 
	$this->assign('title', 'Edit Menu'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
	</div>
	<h1 class="title">Edit <span>Menu</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array('controller' => 'menus', 'action' => 'index'),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="menus form clear">
<?php echo $this->Form->create('Menu', array('novalidate')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('link', array('default' => '/'));
		echo $this->Form->input('parent_id', array('empty' => 'None'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>

<?php 
	echo $this->element('Dashboard/select2script');
?>
