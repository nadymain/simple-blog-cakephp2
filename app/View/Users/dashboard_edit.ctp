<?php 
	$this->assign('title', 'Edit User'); 
?> 

<div class="heading clear">
	<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
	</div>
	<h1 class="title">Edit <span>Users</span></h1>
	<?php echo $this->Html->link('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" /></svg>', 
		array('controller' => 'users', 'action' => 'index'),
		array('class' => 'link', 'title' => 'Back', 'escape' => false)
	); ?>
</div>

<div class="users form clear">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', 
			array(
				'autocomplete' => 'off'
			)
		);
		echo $this->Form->input('new_password', 
			array(
				'autocomplete' => 'new-password',
				'label' => 'Change Password',
				'class' => 'input-left',
				'readonly',
				'after' => '<a href="#" class="link-right change">Change</a><a href="#" class="link-right link-hidden cancel">Cancel</a>',
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>

<?php $this->start('inline-script'); ?>
<script>
$(function(){
	// change-cancel
	$('.change').on('click', function(e) {
		e.preventDefault();
		$("#UserNewPassword").removeAttr('readonly');
		$('#UserNewPassword').focus();
		$('.change').css('display','none');
		$('.cancel').css('display','inline-block');
	});
	$('.cancel').on('click', function(e) {
		e.preventDefault();
		$('.cancel').css('display','none');
		$('.change').css('display','inline-block');
		$('#UserNewPassword').val("");
		$("#UserNewPassword").attr('readonly', true);
	});
});
</script>
<?php $this->end(); ?>
