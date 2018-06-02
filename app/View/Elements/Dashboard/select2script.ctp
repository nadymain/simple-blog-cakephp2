<?php
	echo $this->Html->css('select2.min.css', array('inline' => false));
	echo $this->Html->script('select2.min.js', array('inline' => false));
?>

<?php $this->start('inline-script'); ?>
<script>
$(function(){
	$('select').select2({
		minimumResultsForSearch: Infinity,
		width: '100%',
	});
});
</script>
<?php $this->end(); ?>