<div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 menu-column vh-100 hide-md">
    <button class="show-md close-menu">
        X
    </button>
    <div class="mx-auto col-12 mt-5 logoContainer">
		<?= $this->Html->image('logo-white.png', ['alt' => 'Logo Dienst', 'class' => 'logo']); ?>
    </div>
    <div class="mx-auto col-12 mt-5 pt-3 menu-left-column">
        <div class="menu" id="menuHome">
			<?= $this->element('menu'); ?>
            <a href="<?= $this->Url->build(  '/salir', ['fullBase' => true]); ?>" class="btn btn-link">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar sesi贸n
            </a>
        </div>
    </div>
</div>