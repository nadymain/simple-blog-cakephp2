<?php 
	$this->assign('title', $tag['Tag']['name']); 

    if ($tag['Tag']['description']) {
        echo $this->Html->meta('description', 
           	$tag['Tag']['description'], 
            array('inline' => false)
        );
    } 
    
    echo $this->Html->meta('canonical', 
        $this->Html->url(array(
            'controller' => 'tags',
            'action' => 'view',
            'slug' => $tag['Tag']['slug']
        ), true), 
        array('rel' => 'canonical', 'type' => null, 'title' => null, 'inline' => false)
    );
?>

<div class="archive">
    <h2>
        <?php echo $tag['Tag']['name']; ?>
    </h2>
</div>

<div class="articlelist">
	<?php echo $this->element('Main/articlelist'); ?>
</div>

<?php $this->Paginator->options(
    array('url' => 
        array(
            'controller' => 'tags', 
            'action' => 'view',
            'slug' => $tag['Tag']['slug']
        )
    )
); ?>
<?php echo $this->element('Main/paginate'); ?>
