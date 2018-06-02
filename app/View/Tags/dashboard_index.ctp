<?php 
	$this->assign('title', 'Index Tags'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/></svg>
	</div>
	<h1 class="title">Index <span>Tags</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'tags','action' => 'add'),
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
			<?php foreach ($tags as $tag): ?>
			<tr>
				<td>
					<h2>
					<?php if ($tag['Tag']['article_count'] >= '1') {
						echo $this->Html->link($tag['Tag']['name'], array(
							'dashboard' => false,
							'controller' => 'tags',
							'action' => 'view',
							'slug' => $tag['Tag']['slug']
						));
					} else {
						echo h($tag['Tag']['name']);
					} ?>
					</h2>
				</td>
				<td class="mob-hide">
					<?php echo h($tag['Tag']['article_count']); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tag['Tag']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tag['Tag']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $tag['Tag']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$tags): ?>
		<p class="no-content">
			<?php echo __('No tags found.'); ?>
		</p>
	<?php endif ?>
</div>

<div class="paginate">
	<?php echo $this->element('Dashboard/paginate'); ?>
</div>
