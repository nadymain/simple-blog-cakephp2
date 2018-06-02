<?php 
	$this->assign('title', 'Index Users'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
	</div>
	<h1 class="title">Index <span>Users</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'users', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th>
					<?php echo __('Username'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['username']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$users): ?>
		<p class="no-content">
			<?php echo __('No users found.'); ?>
		</p>
	<?php endif ?>
</div>

