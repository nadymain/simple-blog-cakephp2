<?php
	$mainmenu = $this->requestAction('/menus/mainmenu');
?>

<div class ="btn-menu">
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><path d="M4 27h28v-3H4v3zm0-8h28v-3H4v3zM4 8v3h28V8H4z"/></svg>
    </a>
</div>

<ul class="main-menu dropit">
<?php foreach ($mainmenu as $menu) : ?>
    <?php if (!empty($menu['children'])) : ?>
        <li>
            <?php echo $this->Html->link($menu['Menu']['name'], '#') ?>
            <ul>
            <?php foreach ($menu['children'] as $child) : ?>
                <li>
                    <?php echo $this->Html->link($child['Menu']['name'], $child['Menu']['link']) ?>
                </li>
            <?php endforeach ?>
            </ul>
        </li>
    <?php else : ?>
        <li class="<?php echo $this->Menu->main($menu['Menu']['link'])?>">
            <?php echo $this->Html->link($menu['Menu']['name'], $menu['Menu']['link']) ?>
        </li>
    <?php endif ?>
<?php endforeach ?>
</ul>
