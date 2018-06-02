<?php 
	$this->assign('title', 'Index Menus'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
	</div>
	<h1 class="title">Index <span>Menus</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'menus', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th>
					<?php echo __('Name'); ?>
				</th>
				<th width="90">
					<?php echo __('Move'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($menus as $menu): ?>
			<tr>
				<td>					
					<h2>
						<?php if ($menu['ParentMenu']['name']) {
							echo __('— ') . $this->Html->link($menu['Menu']['name'], $menu['Menu']['link']);
						} else {
							echo $this->Html->link($menu['Menu']['name'], $menu['Menu']['link']);
						} ?>
					</h2>
				</td>
				<td class="actions">
					<?php echo $this->Html->link('Up ', 
						array('action' => 'moveup', $menu['Menu']['id'], 1),
						array('class' => 'move')
					); ?>
					<?php echo $this->Html->link(' Down', 
						array('action' => 'movedown', $menu['Menu']['id'], 1),
						array('class' => 'move')
					); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $menu['Menu']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menu['Menu']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $menu['Menu']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$menus): ?>
		<p class="no-content">
			<?php echo __('No menus found.'); ?>
		</p>
	<?php endif ?>
</div>
