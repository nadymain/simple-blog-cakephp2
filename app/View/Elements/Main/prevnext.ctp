<?php if (!empty($prevnext['prev'] || $prevnext['next'])) : ?>
<div class="prevnext clear">
<?php if ($prevnext['prev']) : ?>
	<?php echo $this->Html->link('&#10229;', array(
		'controller' => 'articles',
		'action' => 'view',
		'slug' => $prevnext['prev']['Article']['slug']
	), array(
		'title' => 'Prev: '.$prevnext['prev']['Article']['title'],
		'class' => 'prevnext-prev',
		'rel' => 'prev',
		'escape' => false
	)); ?>
<?php endif; ?>

<?php if ($prevnext['next']) : ?>
	<?php echo $this->Html->link('&#10230;', array(
		'controller' => 'articles',
		'action' => 'view',
		'slug' => $prevnext['next']['Article']['slug']
	), array(
		'title' => 'Next: '.$prevnext['next']['Article']['title'],
		'class' => 'prevnext-next',
		'rel' => 'next',
		'escape' => false
	)); ?>
<?php endif; ?>
</div>
<?php endif; ?>
