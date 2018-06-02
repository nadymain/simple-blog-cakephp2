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
