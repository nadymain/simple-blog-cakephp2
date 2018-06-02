<?php
	echo $this->Html->script('/files/tinymce/tinymce.min.js', array('inline' => false));
?>

<?php $this->start('inline-script'); ?>
<script>
	var base_url = '<?php echo $this->Html->url('/', true); ?>';
	tinymce.init({
		selector: '#content',
		branding: false,
		height: 500,
		plugins: 'code fullscreen image link table hr anchor lists textcolor wordcount',
		toolbar1: 'formatselect | bold italic strikethrough forecolor | link image | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat',
		
		// image
		relative_urls : false,
		remove_script_host : false,
		document_base_url : base_url + 'img/uploads/',
		image_dimensions: false,
		object_resizing: false,
		file_browser_callback_types: 'image',
		file_browser_callback: function (field_name, url, type, win) {
			cmsURL = base_url + 'dashboard/images/iframeindex?type=tinymce';
			tinymce.activeEditor.windowManager.open({
				file: cmsURL,
				title: '',
				width: 400,
				height: 500,
			}, {
				window: win,
				input: field_name
			});
		}
	});
</script>
<?php $this->end(); ?>
