<?php 
	$this->assign('title', $article['Article']['title']); 

    if ($article['Article']['description']) {
        echo $this->Html->meta('description', 
            $article['Article']['description'], 
            array('inline' => false)
        );
    } 
    
    echo $this->Html->meta('canonical', 
        $this->Html->url(array(
            'controller' => 'articles',
            'action' => 'view',
            'slug' => $article['Article']['slug']
        ), true), 
        array('rel' => 'canonical', 'type' => null, 'title' => null, 'inline' => false)
    );
?>

<article>
    <?php if (!empty($article['Article']['image'])) : ?>
        <div class="featured-image">
        <?php echo $this->Html->image('uploads/' . $article['Article']['image'],
            array(
                'alt' => 'Image ' . $article['Article']['title']
            )
        ) ?>
        </div>
    <?php endif ?>

	<header>
		<div class="date">
			<?php
				echo $this->Time->format(
					'd F Y',
					$article['Article']['created']
				);
			?>
		</div>
		<h2 class="title">
			<?php echo $this->Html->link($article['Article']['title'],
				array(
					'controller' => 'articles',
					'action' => 'view',
					'slug' => $article['Article']['slug']
				)
			); ?>
		</h2>
	</header>
    <div class="content clear">
        <?php echo $article['Article']['content']; ?>
    </div>
    <footer>
    	<div class="category">
		<?php
			echo __('Category: ');
			echo $this->Html->link($article['Category']['name'],
				array(
					'controller' => 'categories',
					'action' => 'view',
					'slug' => $article['Category']['slug']
				)
			);
		?>
		</div>
        <div class="tag">
        <?php if (!empty($article['Tag'])): ?>
            <?php echo __('Tags: '); ?>
            <?php
                $total = count($article['Tag']);
                $i=0;
                foreach ($article['Tag'] as $tag) {
                    $i++;
                    echo $this->Html->link($tag['name'], 
                        array(
                            'controller' => 'tags',
                            'action' => 'view',
                            'slug' => $tag['slug']
                        )
                    );
                    if ($i != $total) {
                        echo ', ';
                    }
                }
            ?>
        <?php endif; ?>
        </div>
    </footer>
</article>

<?php 
    if ($this->Session->check('Auth.User.id')) {
        echo $this->Html->link('Edit', array(
            'dashboard' => true,
            'controller' => 'articles',
            'action' => 'edit',
            $article['Article']['id']
        ), array(
            'class' => 'edit-article'
        ));
    }
?>

<div class="prevnext clear">
    <?php echo $this->element('Main/prevnext'); ?>
</div>
