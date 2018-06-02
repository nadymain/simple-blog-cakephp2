<?php 
	$this->assign('title', $info['Info']['title']); 

    if ($info['Info']['description']) {
        echo $this->Html->meta('description', 
            $info['Info']['description'], 
            array('inline' => false)
        );
    } 
    
    echo $this->Html->meta('canonical', 
        $this->Html->url(array(
            'controller' => 'infos',
            'action' => 'view',
            'slug' => $info['Info']['slug']
        ), true), 
        array('rel' => 'canonical', 'type' => null, 'title' => null, 'inline' => false)
    );
?>

<article>
	<header>
		<h2 class="title">
			<?php echo $this->Html->link($info['Info']['title'],
				array(
					'controller' => 'infos',
					'action' => 'view',
					'slug' => $info['Info']['slug']
				)
			); ?>
		</h2>
	</header>
    <div class="content clear">
        <?php echo $info['Info']['content']; ?>
    </div>
</article>

<?php 
    if ($this->Session->check('Auth.User.id')) {
        echo $this->Html->link('Edit', array(
            'dashboard' => true,
            'controller' => 'infos',
            'action' => 'edit',
            $info['Info']['id']
        ), array(
            'class' => 'edit-article'
        ));
    }
?>
