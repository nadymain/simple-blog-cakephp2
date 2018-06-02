<?php 
	$this->assign('title', 'Index Sliders'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg>
	</div>
	<h1 class="title">Index <span>Sliders</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" /></svg>', 
		array('controller' => 'sliders', 'action' => 'add'),
		array('class' => 'link', 'title' => 'Add New', 'escape' => false)
	); ?>
</div>

<div class="table">
	<table>
		<thead>
			<tr>
				<th width="150" >
					<?php echo __('Image'); ?>
				</th>
				<th>
					<?php echo __('Title'); ?>
				</th>
				<th width="90" class="actions">
					<?php echo __('Actions'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sliders as $slider): ?>
			<tr>
				<td>
					<?php echo $this->Html->image('uploads/thumb/s_' . $slider['Slider']['image'],
						array(
							'alt' => 'thumb',
							'title' => $slider['Slider']['title'],
						)
					); ?>
				</td>
				<td>
					<p><?php echo h($slider['Slider']['title']); ?></p>
					<p>Link: <?php echo h($slider['Slider']['link']); ?></p>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $slider['Slider']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $slider['Slider']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $slider['Slider']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php if (!$sliders): ?>
		<p class="no-content">
			<?php echo __('No sliders found.'); ?>
		</p>
	<?php endif ?>
</div>
