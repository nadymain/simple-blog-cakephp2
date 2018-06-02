<?php 
	$this->assign('title', 'Edit Setting'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/></svg>
	</div>
	<h1 class="title">Edit <span>Setting</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array('controller' => 'settings', 'action' => 'index'),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="settings form clear">
<?php echo $this->Form->create('Setting', array('novalidate')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		// echo $this->Form->input('name');
		// echo $this->Form->input('set_key');
		if ($this->request->data['Setting']['set_key'] === 'site_brand') {
			echo $this->Form->input('set_value', 
				array(
					'label' => $this->request->data['Setting']['name'], 
					'type' => $this->request->data['Setting']['set_type'], 
					'id' => 'input-image',
					'class' => 'input-left',
					'readonly',
					'after' => '<a href="#modal-image" class="link-right pick">Pick</a>',
				)
			);
			if (!empty($this->request->data['Setting']['set_value'])) {
				echo '<div id="preview-image" class="preview-image">';
				echo '<img src="' . $this->Html->url('/img/uploads/', true) . $this->request->data['Setting']['set_value']. '" alt="thumb">';
				echo '</div>';
			} else {
				echo '<div id="preview-image" class="preview-image"></div>';
			}
			echo '<a class="remove-image" href="#">Remove Image</a>';
		} else {
			echo $this->Form->input('set_value', 
				array(
					'label' => $this->request->data['Setting']['name'], 
					'type' => $this->request->data['Setting']['set_type'], 
				)
			);
		}

		// echo $this->Form->input('set_type', 
		// 	array('options' => array(
		// 		'text' => 'Text', 
		// 		'textarea' => 'Textarea',
		// 		'number' => 'Number'
		// 	))
		// );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>

<?php if ($this->request->data['Setting']['set_key'] === 'site_brand') : ?>
	<div id="modal-image" class="modal">
		<a href="#close" rel="modal:close" class="modal-close">Close</a>
		<div class="modal-content">
		</div>
	</div>

	<?php
		echo $this->Html->script('jquery.modal.min.js', array('inline' => false));
		echo $this->Html->css('jquery.modal.min.css', array('inline' => false));
	?>

	<?php $this->start('inline-script'); ?>
	<script>
	$(function(){
	    $('.pick').on('click',function(e){
			e.preventDefault();
	        $('#modal-image').find('.modal-content').html('<iframe src="' + '<?php echo $this->Html->url('/', true); ?>' + 'dashboard/images/iframeindex?type=modal"></iframe>');
			$(this).modal({
				showClose: false,
				fadeDelay: 0
			});
	    });
		// remove image
	    $('.remove-image').on('click', function(e) {
			e.preventDefault();
	        $('#preview-image img').remove();
	        $('#input-image').val('');
	        $('.remove-image').hide();
	    });
	    if ($('#input-image').val().length) {
	        $('.remove-image').css('display','inline-block');
	    }
	});
	</script>
	<?php $this->end(); ?>
<?php endif ?>
