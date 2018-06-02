<ul>
	<li class="<?php echo $this->Aside->active('articles'); ?>">
		<?php echo $this->Html->link('Articles', 
			array('controller' => 'articles', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('categories'); ?>">
		<?php echo $this->Html->link('Categories', 
			array('controller' => 'categories', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('tags'); ?>">
		<?php echo $this->Html->link('Tags', 
			array('controller' => 'tags', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('infos'); ?>">
		<?php echo $this->Html->link('Infos', 
			array('controller' => 'infos', 'action' => 'index')
		); ?>
	</li>
	<li>
		<hr>
	</li>
	<li class="<?php echo $this->Aside->active('sliders'); ?>">
		<?php echo $this->Html->link('Sliders', 
			array('controller' => 'sliders', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('menus'); ?>">
		<?php echo $this->Html->link('Menus', 
			array('controller' => 'menus', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('images'); ?>">
		<?php echo $this->Html->link('Images', 
			array('controller' => 'images', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('settings'); ?>">
		<?php echo $this->Html->link('Settings', 
			array('controller' => 'settings', 'action' => 'index')
		); ?>
	</li>
	<li class="<?php echo $this->Aside->active('users'); ?>">
		<?php echo $this->Html->link('Users', 
			array('controller' => 'users', 'action' => 'index')
		); ?>
	</li>
</ul>
