<?php 
	$this->assign('title', $category['Category']['name']); 

    if ($category['Category']['description']) {
        echo $this->Html->meta('description', 
            $category['Category']['description'], 
            array('inline' => false)
        );
    } 
    
    echo $this->Html->meta('canonical', 
        $this->Html->url(array(
            'controller' => 'categories',
            'action' => 'view',
            'slug' => $category['Category']['slug']
        ), true), 
        array('rel' => 'canonical', 'type' => null, 'title' => null, 'inline' => false)
    );
?>

<div class="archive">
    <h2>
        <?php echo $category['Category']['name']; ?>
    </h2>
</div>

<div class="articlelist">
	<?php echo $this->element('Main/articlelist'); ?>
</div>

<div class="paginate">
    <?php $this->Paginator->options(
       array('url' => 
           array(
            'controller' => 'categories', 
            'action' => 'view',
            'slug' => $category['Category']['slug']
        )
    )); ?>
	<?php echo $this->element('Main/paginate'); ?>
</div>
