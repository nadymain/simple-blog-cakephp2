<?php 
	$this->assign('title', 'Iframe Index Images'); 
	$this->layout = 'iframe';
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
	</div>
	<h1 class="title">Index <span>Images</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array(
			'controller' => 'images', 
			'action' => 'iframeadd',
			'?' => 'type=' . ($this->request->query('type') === 'modal' ? 'modal' : 'tinymce'),
		),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="filter">
	<ul>
		<li class="<?php echo(empty($this->request->query)) ? 'active' : 'inactive' ?>">
			<?php echo $this->Html->link('Total ('.$total.')', 
				array(
					'controller' => 'images',
					'action' => 'iframeindex',
					'?' => 'type=' . ($this->request->query('type') === 'modal' ? 'modal' : 'tinymce'),
				)
			) ?>
		</li>
	</ul>

	<?php
		echo $this->Form->create(null, array(
			'url' => array_merge(
				array(
					'controller' => 'images',
					'action' => 'iframeindex',
					'?' => 'type=' . ($this->request->query('type') === 'tinymce' ? 'tinymce' : 'modal'),
				)
			)
		));
		echo $this->Form->input('file', 
			array(
				'label' => false, 
				'div' => false,
				'placeholder' => 'File',
			)
		);
		echo $this->Form->submit(__('Search'), array('div' => false));
		echo $this->Form->end();
	?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('file', 'Image'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($images as $image): ?>
			<tr>
				<td>
					<?php echo $this->Html->image('uploads/thumb/s_' . $image['Image']['file'], 
						array(
							'title' => $image['Image']['created']
						)
					); ?>
					<p><?php echo h($image['Image']['file']); ?></p>			
				</td>
				<td class="actions">
					<?php echo $this->Html->link('Select', '#', 
						array(
							'class' => 'select-image',
							'data-file' => $image['Image']['file']
						)
					); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'iframedelete', $image['Image']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $image['Image']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$images): ?>
		<p class="no-content">
			<?php echo __('No images found.'); ?>
		</p>
	<?php endif ?>
</div>

<div class="paginate">
	<?php echo $this->element('Dashboard/paginate'); ?>
</div>

<?php $this->start('inline-script'); ?>
<script>
$(function(){
	if (document.location.search.indexOf('type=tinymce') >= 0) {
		$('.select-image').on('click', function(e) {
			e.preventDefault();
			var args = top.tinymce.activeEditor.windowManager.getParams();
			win = (args.window);
			input = (args.input);
			win.document.getElementById(input).value = $(this).data('file');
			top.tinymce.activeEditor.windowManager.close();
		});
	}

	if (document.location.search.indexOf('type=modal') >= 0) {
		$('.select-image').on('click', function(e) {
			e.preventDefault();
			parent.document.getElementById('input-image').value = $(this).data('file');
			parent.document.getElementById('preview-image').innerHTML = '<img alt="thumb" src="' + '<?php echo $this->Html->url('/img/uploads/', true); ?>' + $(this).data('file') + '">';
			parent.$('.remove-image').css('display', 'inline-block');
			parent.$.modal.close();
		});
	}
});
</script>
<?php $this->end(); ?>
