<?php 
	$this->assign('title', 'Index Infos'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.5 6v11.5c0 2.21-1.79 4-4 4s-4-1.79-4-4V5c0-1.38 1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5v10.5c0 .55-.45 1-1 1s-1-.45-1-1V6H10v9.5c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5V5c0-2.21-1.79-4-4-4S7 2.79 7 5v12.5c0 3.04 2.46 5.5 5.5 5.5s5.5-2.46 5.5-5.5V6h-1.5z"/></svg>
	</div>
	<h1 class="title">Index <span>Infos</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'infos', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('title'); ?>
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
			<?php foreach ($infos as $info): ?>
			<tr>
				<td>
					<h2>
						<?php if ($info['Info']['status'] == 'published') {
							echo $this->Html->link($info['Info']['title'], 
								array(
									'dashboard' => false,
									'controller' => 'infos',
									'action' => 'view',
									'slug' => $info['Info']['slug']
								)
							);
						} else {
							echo h($info['Info']['title']);
						} ?>
					</h2>
				</td>
				<td class="actions mob-hide">
					<?php echo $this->Status->update($info['Info']['status'], $info['Info']['id']) ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $info['Info']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $info['Info']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $info['Info']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$infos): ?>
		<p class="no-content">
			<?php echo __('No infos found.'); ?>
		</p>
	<?php endif ?>
</div>

<div class="paginate">
	<?php echo $this->element('Dashboard/paginate'); ?>
</div>
