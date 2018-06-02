<?php 
	$this->assign('title', 'Add Slider'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg>
	</div>
	<h1 class="title">Add <span>Slider</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array('controller' => 'sliders', 'action' => 'index'),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="sliders form clear">
<?php echo $this->Form->create('Slider', array('novalidate')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('title');

		echo $this->Form->input('image', 
			array(
				'label' => 'Image',
				'id' => 'input-image',
				'class' => 'input-left',
				'readonly',
				'after' => '<a href="#modal-image" class="link-right pick">Pick</a>',
			)
		);
		if (!empty($this->request->data['Slider']['image'])) {
			echo '<div id="preview-image" class="preview-image">';
			echo '<img src="' . $this->Html->url('/img/uploads/', true) . $this->request->data['Slider']['image']. '" alt="thumb">';
			echo '</div>';
		} else {
			echo '<div id="preview-image" class="preview-image"></div>';
		}
		echo '<a class="remove-image" href="#">Remove Image</a>';
		
		echo $this->Form->input('link',
			array(
				'default' => '#'
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php 
	echo $this->element('Dashboard/modalimage'); 
?>