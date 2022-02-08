<!--
  16/7/21 de rango a departamento y de nombre a usuario
 -->
<div class="col-12 navbar">
	<button class="show-md open-menu">
		<i class="icon icon-menu"></i>
	</button>
    <?= $this->Html->image('logo-blue.png', ['alt' => 'Logo Dienst', 'class' => 'logo show-md']); ?>
	<div class="profile-info pull-right">
		<div class="profile-text">
			<p class="profile-name"><?= $this->Identity->get('name') . ' ' . $this->Identity->get('lastname'); ?></p>
			<p class="profile-role"><?= $this->Identity->get('groupIdentity')['name']; ?></p>
		</div>
		<?= $this->Html->image('icons/no-pic.png', ['alt' => 'Sin foto de perfil', 'class' => 'profile-img']); ?>
	</div>

</div>