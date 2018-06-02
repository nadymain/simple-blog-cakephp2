<?php
	echo $this->Form->input('image', 
		array(
			'label' => 'Image',
			'id' => 'input-image',
			'class' => 'input-left',
			'readonly',
			'after' => '<a href="#modal-image" class="link-right pick">Pick</a>',
		)
	);
	if (!empty($this->request->data['Article']['image'])) {
		echo '<div id="preview-image" class="preview-image">';
		echo '<img src="' . $this->Html->url('/img/uploads/', true) . $this->request->data['Article']['image']. '" alt="thumb">';
		echo '</div>';
	} else {
		echo '<div id="preview-image" class="preview-image"></div>';
	}
	echo '<a class="remove-image" href="#">Remove Image</a>';
?>
