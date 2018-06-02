<?php if (empty($articles)) : ?>
	<p><?php echo __('No articles found.'); ?></p>
<?php endif ?>

<?php foreach ($articles as $article): ?>
<article>
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
	<div class="content">
		<p>
		<?php
			$excerpt = strip_tags($article['Article']['content']);
			echo $this->Text->excerpt($excerpt, 'method', 385, '... ');
		?>
		</p>
	</div>
	<footer>
		<div class="category">
		<?php
			echo $this->Html->link($article['Category']['name'],
				array(
					'controller' => 'categories',
					'action' => 'view',
					'slug' => $article['Category']['slug']
				)
			);
		?>
		</div>
	</footer>
</article>
<?php endforeach; ?>
