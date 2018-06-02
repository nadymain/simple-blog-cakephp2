<?php 
	$this->assign('title', 'Index Categories'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V8h16v10z"/></svg>
	</div>
	<h1 class="title">Index <span>Categories</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'categories', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('name'); ?>
				</th>
				<th width="90" class="mob-hide">
					<?php echo $this->Paginator->sort('article_count', 'Count'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($categories as $category): ?>
			<tr>
				<td>
					<h2>
					<?php if ($category['Category']['article_count'] >= '1') {
						echo $this->Html->link($category['Category']['name'], array(
							'dashboard' => false,
							'controller' => 'categories',
							'action' => 'view',
							'slug' => $category['Category']['slug']
						));
					} else {
						echo h($category['Category']['name']);
					} ?>
					</h2>
				</td>
				<td class="mob-hide">
					<?php echo h($category['Category']['article_count']); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $category['Category']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$categories): ?>
		<p class="no-content">
			<?php echo __('No categories found.'); ?>
		</p>
	<?php endif ?>
</div>

<div class="paginate">
	<?php echo $this->element('Dashboard/paginate'); ?>
</div>
