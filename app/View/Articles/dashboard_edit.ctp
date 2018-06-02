<?php 
	$this->assign('title', 'Edit Article'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M17.75 7L14 3.25l-10 10V17h3.75l10-10zm2.96-2.96c.39-.39.39-1.02 0-1.41L18.37.29c-.39-.39-1.02-.39-1.41 0L15 2.25 18.75 6l1.96-1.96z"/><path fill-opacity=".36" d="M0 20h24v4H0z"/></svg>
	</div>
	<h1 class="title">Edit <span>Article</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array('controller' => 'articles', 'action' => 'index'),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="articles form clear">
<?php echo $this->Form->create('Article', array('novalidate')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', 
			array('class' => 'title')
		);
		echo $this->Form->input('slug', 
			array(
				'class' => 'input-left',
				'readonly',
				'after' => '<a href="#" class="link-right change">Change</a><a href="#" class="link-right link-hidden cancel">Cancel</a>',
			)
		);
		echo $this->Form->input('content',
			array(
				'id' => 'content',
				'rows' => 20,
			)
		);
		echo $this->Form->input('description');
		echo $this->element('Dashboard/featuredimage');
		echo $this->Form->input('category_id');
		echo $this->Form->input('Tag');
		echo $this->Form->input('status', 
			array(
				'options' => array('draft' => 'Draft', 'published' => 'Published')
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>

<?php 
	if($this->request->data['Article']['status'] == 'published') {
		echo $this->Html->link('View', array(
			'dashboard' => false,
			'controller' => 'articles',
			'action' => 'view',
			'slug' => $this->request->data['Article']['slug']
		), array(
			'class' => 'view'
		));
	}
?>
</div>

<?php 
	echo $this->element('Dashboard/modalimage'); 
	echo $this->element('Dashboard/tinymcescript');
	echo $this->element('Dashboard/select2script');
?>

<?php $this->start('inline-script'); ?>
<script>
$(function(){
	// change-cancel
	$('.change').on('click', function(e) {
		e.preventDefault();
		$("#ArticleSlug").removeAttr('readonly');
		$('#ArticleSlug').focus();
		$('.change').css('display','none');
		$('.cancel').css('display','inline-block');
	});
	$('.cancel').on('click', function(e) {
		e.preventDefault();
		$('.cancel').css('display','none');
		$('.change').css('display','inline-block');
		$('#ArticleSlug').val("<?php echo $this->request->data['Article']['slug'] ?>");
		$("#ArticleSlug").attr('readonly', true);
	});
});
</script>
<?php $this->end(); ?>
