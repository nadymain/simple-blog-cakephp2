<?php 
	$this->assign('title', 'Index Images'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
	</div>
	<h1 class="title">Index <span>Images</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'images', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="filter">
	<ul>
		<li class="<?php echo(empty($this->request->query)) ? 'active' : 'inactive' ?>">
			<?php echo $this->Html->link('Total ('.$total.')', 
				array(
					'controller' => 'images',
					'action' => 'index'
				)
			) ?>
		</li>
	</ul>

	<?php
		echo $this->Form->create();
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
				<th width="150" >
					<?php echo $this->Paginator->sort('file', 'Image'); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('file'); ?>
				</th>
				<th width="80" class="mob-hide">
					<?php echo $this->Paginator->sort('size'); ?>
				</th>
				<th width="100" class="mob-hide">
					<?php echo $this->Paginator->sort('type'); ?>
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
							'title' => $image['Image']['created'],
							'alt' => 'thumb'
						)
					); ?>				
				</td>
				<td>
					<?php echo h($image['Image']['file']); ?>
				</td>
				<td class="mob-hide">
					<?php echo $this->Number->toReadableSize($image['Image']['size']); ?>
				</td>
				<td class="mob-hide">
					<?php echo h($image['Image']['type']); ?>
				</td>
				<td class="actions">
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $image['Image']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $image['Image']['id']))); ?>
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
