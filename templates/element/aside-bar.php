<div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 menu-column vh-100 hide-md">
    <button class="show-md close-menu">
        X
    </button>
    <div class="mx-auto col-12 mt-5 logoContainer">
		<?= $this->Html->image('logo-white.png', ['alt' => 'Logo Dienst', 'class' => 'logo']); ?>
    </div>
    <?php
        $isManual = ($this->request->getParam('action') == 'manual' && $this->request->getParam('controller') == 'Pages');
        $group = $this->Identity->get('groupIdentity');
        $prefix = (!empty($group)) ?$group['redirect'] : '';
    ?>
    <div class="mx-auto col-12 mt-5 pt-3 menu-left-column">
        <div class="menu" id="menuHome">
            <?php if (!empty($group)) : ?>
			<?= $this->element('menu'); ?>
            <?php endif;?>
            <div class="card">
                <div class="card-header" id="manual-menu">
                    <h2 class="mb-0">
                        <button class="btn btn-link  btn-principal" type="button" data-toggle="collapse" data-target="#collapsePacientes" aria-expanded="true" aria-controls="collapsePacientes">
                            <i class="far fa-user"></i>
                            Manual
                        </button>
                    </h2>
                </div>
                <div id="collapsePacientes" class="collapse <?= ($isManual) ? 'show' : 'hide"'; ?>" aria-labelledby="pacientes" data-parent="#menuHome">
                    <div class="card-body">
                        <ul class="sub-menu">
                            <li><a href="<?= $this->Url->build($prefix . '/manual#general',['fullBase'=>true])?>" class="btn btn-link" >General</a></li>
                            <li><a href="<?= $this->Url->build($prefix . '/manual#admin',['fullBase'=>true])?>" class="btn btn-link" >Administraci&oacute;n</a></li>
                            <li><a href="<?= $this->Url->build($prefix . '/manual#centro_medico',['fullBase'=>true])?>" class="btn btn-link" >C.M&eacute;dico</a></li>
                            <li><a href="<?= $this->Url->build($prefix . '/manual#policia',['fullBase'=>true])?>" class="btn btn-link" >Polic&iacute;a</a></li>
                        </ul>
                    </div>
                </div>
            </div>
	        <?php if (!empty($group)) : ?>
                <a href="<?= $this->Url->build(  '/salir', ['fullBase' => true]); ?>" class="btn btn-link">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar sesi&oacute;n
                </a>
            <?php else : ?>
                <a href="<?= $this->Url->build(  '/', ['fullBase' => true]); ?>" class="btn btn-link">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
	        <?php endif;?>

        </div>
    </div>
</div>