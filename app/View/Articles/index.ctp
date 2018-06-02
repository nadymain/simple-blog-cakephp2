<?php 
    echo $this->Html->meta('canonical', 
        $this->Html->url(array(
            'controller' => 'articles',
            'action' => 'index'
        ), true), 
        array('rel' => 'canonical', 'type' => null, 'title' => null, 'inline' => false)
    );
?>

<div class="articlelist">
	<?php echo $this->element('Main/articlelist'); ?>
</div>

<div class="paginate clear">
	<?php echo $this->element('Main/paginate'); ?>
</div>
