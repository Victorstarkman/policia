<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Actualización de usuario</h4>
    </div>
    <div class="results">
        <div class="container mx-auto row">
            <div class="col-12">
                <p class="title-results">Formulario de Actualización de usuario<br/><small>Los campos indicados con&nbsp;<span style="color:red">*</span>  son de llenado obligatorio</small></p>
            </div>
			<?= $this->Flash->render() ?>
			<?= $this->Form->create($user, ['class' => 'col-lg-12 col-md-12 row']) ?>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('name', ['label'=> 'Nombre*', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('lastname', ['label'=> 'Apellido*', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('email', ['label'=> 'Email*', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('group_id', ['label'=> 'Grupo', 'empty' => __('Seleccione'), 'require' => true, 'class' => 'form-control form-control-blue m-0 col-12']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-12 col-sm-12">
                <p>Solo llenar los campos de contraseña si se desea cambiarla por una nueva.</p>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('password_one', ['label'=> 'Contraseña', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('password_two', ['label'=> 'Repetir Contraseña', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
                </div>
            </div>
            <div class="mx-auto form-group row col-lg-12 col-md-12">
                <div class="pl-0 col-12">
                    <button type="submit" id="guardar" class="btn btn-outline-primary col-12" name="guardar"><i class="far fa-save"></i> Actualizar</button>
                </div>
            </div>
			<?= $this->Form->end() ?>
        </div>
    </div>
</div>