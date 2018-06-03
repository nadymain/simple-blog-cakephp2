<?php if ($this->Paginator->hasPage(null, 2)) : ?>
<div class="paginate clear">
	<ul>
		<?php 
			echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('first' => 1, 'last' => 1, 'separator' => '', 'tag' => 'li', 'modulus' => '3', 'ellipsis' => ' - '));
			echo $this->Paginator->next(__('Next'), array('tag' => 'li'), null, array('class' => 'next disabled'));
		?>
	</ul>
	<p>
		<?php
			echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}')
			));
		?>
	</p>
</div>
<?php endif ?>
