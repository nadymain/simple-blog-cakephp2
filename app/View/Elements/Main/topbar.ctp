<div class="dashboard">
	<?php echo $this->Html->link('Dashboard', 
		array(
			'dashboard' => true,
			'controller' => 'articles', 
			'action' => 'index'
		)
	); ?>
</div>

<ul class="btn-add dropit">
	<li>
		<a href="#" title="Toggle Add">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14 10H2v2h12v-2zm0-4H2v2h12V6zm4 8v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM2 16h8v-2H2v2z"/></svg>
		</a>
		<ul>
			<li>
				<?php echo $this->Html->link('Add Article', 
					array(
						'dashboard' => true,
						'controller' => 'articles', 
						'action' => 'add'
					)
				); ?>
			</li>
			<li>
				<?php echo $this->Html->link('Add Category', 
					array(
						'dashboard' => true,
						'controller' => 'categories', 
						'action' => 'add'
					)
				); ?>
			</li>
			<li>
				<?php echo $this->Html->link('Add Tag', 
					array(
						'dashboard' => true,
						'controller' => 'tags', 
						'action' => 'add'
					)
				); ?>
			</li>
			<li>
				<?php echo $this->Html->link('Add Info', 
					array(
						'dashboard' => true,
						'controller' => 'infos', 
						'action' => 'add'
					)
				); ?>
			</li>
		</ul>
	</li>
</ul>

<ul class="btn-user dropit">
	<li>
		<a href="#" title="Toggle User">
			<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path d="M9 8c1.66 0 2.99-1.34 2.99-3S10.66 2 9 2C7.34 2 6 3.34 6 5s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V16h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
			<?php if ($this->Session->check('Auth.User.username')): ?>
				<?php echo h($this->Session->read('Auth.User.username')); ?>
			<?php endif ?>
		</a>
		<ul>
			<li>
				<?php echo $this->Html->link('Edit Profile', 
					array(
						'dashboard' => true,
						'controller' => 'users',
						'action' => 'edit',
						$this->Session->read('Auth.User.id')
					)
				); ?>
			</li>
			<li>
				<?php echo $this->Html->link('Logout', 
					array(
						'dashboard' => false,
						'controller' => 'users',
						'action' => 'logout'
					)
				); ?>
			</li>
		</ul>
	</li>
</ul>
