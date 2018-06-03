<?php 
	$this->assign('title', 'Index Settings'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/></svg>
	</div>
	<h1 class="title">Index <span>Settings</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'settings', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th width="150">
					<?php echo __('Key'); ?>
				</th>
				<th>
					<?php echo __('Value'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($settings as $setting): ?>
			<tr>
				<td>
					<?php echo h($setting['Setting']['name']); ?>
				</td>
				<td>
					<?php 
						if (!empty($setting['Setting']['set_value'])) {
							echo h($setting['Setting']['set_value']); 
						} else {
							echo __('---');
						}
					?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $setting['Setting']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $setting['Setting']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $setting['Setting']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$settings): ?>
		<p class="no-content">
			<?php echo __('No settings found.'); ?>
		</p>
	<?php endif ?>
</div>
