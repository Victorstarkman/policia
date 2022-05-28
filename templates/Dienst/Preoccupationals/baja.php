<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Baja de Aspirante</h4>
    </div>
    <div class="results">
        <div class="container mx-auto row">
            <div class="col-12">
                <p class="title-results">Datos del aspirante: <?= $candidate->name . ' ' . $candidate->lastname; ?></p>
            </div>
			<?= $this->Flash->render() ?>
            <?php if (!is_null($candidate->photo)) : ?>
            <div class="pt-0 col-lg-12 col-sm-12 text-center">
                <div class="form-group">
                    <?=  $this->Html->image('candidates/' . $candidate->id . DS . $candidate->photo, ['alt' => 'Foto Perfil', 'width'=> '250px']); ?>
                </div>
            </div>
            <?php endif; ?>
			<?= $this->Form->create($candidate, ['class' => 'col-lg-12 col-md-12 row']) ?>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('name', ['label'=> 'Nombre', 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('lastname', ['label'=> 'Apellido', 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('cuil', ['label'=> 'DNI', 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
                </div>
            </div>

            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('phone', ['label'=> 'Teléfono', 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('email', ['label'=> 'Email', 'class' => 'form-control form-control-blue m-0 col-12',  'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('genderType', ['label'=> 'Sexo', 'require' => true, 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $candidate->getGender(), 'readonly']); ?>
                </div>
            </div>
			<?= $this->Form->end() ?>
           
        </div>
	
       
    
        <div class="col-12">
            <p class="title-results">Baja de Aspirante</p>
        </div>
        <div class="row container mx-auto">
            <div class="pl-0 col-12">
	            <?= $this->Html->link('<i class="fa-solid fa-clock"></i> Dar de Baja al Aspirante',   strtolower(DS . $this->request->getParam('prefix')) . '/Preoccupationals/darBaja/' . $candidate->id . '/f', ['fullBase' => true, 'escape' => false, 'class' => 'btn btn-outline-primary col-12']); ?>
            </div>
        </div>
