<?php 
	$this->assign('title', 'Index Articles'); 
	$status = $this->request->query('status');
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M17.75 7L14 3.25l-10 10V17h3.75l10-10zm2.96-2.96c.39-.39.39-1.02 0-1.41L18.37.29c-.39-.39-1.02-.39-1.41 0L15 2.25 18.75 6l1.96-1.96z"/><path fill-opacity=".36" d="M0 20h24v4H0z"/></svg>
	</div>
	<h1 class="title">Index <span>Articles</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'articles', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="filter">
	<ul>
		<li class="<?php echo (empty($this->request->query)) ? 'active' : 'inactive' ?>">
			<?php echo $this->Html->link('Total ('. $total .')', 
				array(
					'controller' => 'articles',
					'action' => 'index'
				)
			) ?>
		</li>
		<li class="<?php echo (!empty($status) && ($status === 'published')) ? 'active' : 'inactive' ?>">
			<?php echo $this->Html->link('Published ('. $published .')', 
				array(
					'controller' => 'articles',
					'action' => 'index',
					'?' => 'status=published'
				)
			) ?>
		</li>
		<li class="<?php echo (!empty($status) && ($status === 'draft')) ? 'active' : 'inactive' ?>">
			<?php echo $this->Html->link('Draft ('. $draft .')', 
				array(
					'controller' => 'articles',
					'action' => 'index',
					'?' => 'status=draft'
				)
			) ?>
		</li>
	</ul>

	<?php
		echo $this->Form->create();
		echo $this->Form->input('title', 
			array(
				'label' => false, 
				'div' => false,
				'placeholder' => 'Title',
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
					<?php echo $this->Paginator->sort('title'); ?>
				</th>
				<th width="110" class="mob-hide">
					<?php echo $this->Paginator->sort('category_id'); ?>
				</th>
				<th width="110" class="mob-hide">
					<?php echo __('Tags'); ?>
				</th>
				<th width="110" class="mob-hide">
					<?php echo $this->Paginator->sort('status'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($articles as $article): ?>
			<tr>
				<td>
					<h2>
						<?php if ($article['Article']['status'] == 'published') {
							echo $this->Html->link($article['Article']['title'], 
								array(
									'dashboard' => false,
									'controller' => 'articles',
									'action' => 'view',
									'slug' => $article['Article']['slug']
								)
							);
						} else {
							echo h($article['Article']['title']);
						} ?>
					</h2>
					<p>
						<?php echo $this->Paginator->sort('created'); ?>: 
						<?php echo h($article['Article']['created']); ?>
					</p>
					<p>
						<?php echo $this->Paginator->sort('modified'); ?>: 
						<?php echo h($article['Article']['modified']); ?>
					</p>
				</td>
				<td class="mob-hide">
					<?php echo $this->Html->link($article['Category']['name'], 
						array(
							'controller' => 'articles', 
							'action' => 'index',
							'?' => 'category_id='.$article['Category']['id'],
						),
						array(
							'title' => 'Sort Category'
						)
					); ?>
				</td>
				<td class="mob-hide">
				<?php if (!empty($article['Tag'])): ?>
					<ul>
						<?php foreach ($article['Tag'] as $tags) : ?>
						<li>
							<?php echo $this->Html->link($tags['name'], 
								array(
									'controller' => 'articles', 
									'action' => 'index',
									'?' => 'tag_id='.$tags['id']
								),
								array(
									'title' => 'Sort Tag'
								)
							); ?>
						</li>
						<?php endforeach ?>
					</ul>
				<?php else : ?>
					<?php echo '---'; ?>
				<?php endif ?>
				</td>
				<td class="mob-hide actions">
					<?php echo $this->Status->update($article['Article']['status'], $article['Article']['id']) ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $article['Article']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $article['Article']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $article['Article']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$articles): ?>
		<p class="no-content">
			<?php echo __('No articles found.'); ?>
		</p>
	<?php endif ?>
</div>

<div class="paginate">
	<?php echo $this->element('Dashboard/paginate'); ?>
</div>
