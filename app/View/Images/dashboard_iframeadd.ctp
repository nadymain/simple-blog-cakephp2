<?php 
	$this->assign('title', 'Iframe Add Image'); 
	$this->layout = 'iframe';
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
	</div>
	<h1 class="title">Add <span>Image</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array(
			'controller' => 'images', 
			'action' => 'iframeindex',
			'?' => 'type=' . ($this->request->query('type') === 'modal' ? 'modal' : 'tinymce'),
		),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="images form clear">
<?php echo $this->Form->create('Image', array('novalidate', 'type' => 'file')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('file', 
			array(
				'type' => 'file',
				'after' => '<div class="file-preview"><p class="file-no-img">Choose a image.</p></div>'
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->start('inline-script'); ?>
<script>
$(function(){
	$("#ImageFile").on('change', function () {
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $(".file-preview");
		image_holder.empty();
		if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
			for (var i = 0; i < countFiles; i++) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("<img />", {
						"src": e.target.result,
						"class": "file-img",
						"alt": "dummy"
					}).appendTo(image_holder);
				}
				image_holder.show();
				reader.readAsDataURL($(this)[0].files[i]);
			}
		} else {
			image_holder.show();
			image_holder.append(
				"<p class='file-no-img'>Oops! Please select image.</p>");
		}
	});
});
</script>
<?php $this->end(); ?>
