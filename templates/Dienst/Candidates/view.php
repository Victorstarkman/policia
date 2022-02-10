<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Actualización de Aspirante</h4>
    </div>
    <div class="results">
        <div class="container mx-auto row">
            <div class="col-12">
                <p class="title-results">Datos de aspirante: <?= $candidate->name . ' ' . $candidate->lastname; ?></p>
            </div>
			<?= $this->Flash->render() ?>
            <?php if (!is_null($candidate->photo)) : ?>
            <div class="pt-0 col-lg-12 col-sm-12 text-center">
                <div class="form-group">
                    <img src="/img/candidates/<?= $candidate->id . DS . $candidate->photo; ?>" alt="Foto Perfil" width="250px" />
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
					<?= $this->Form->control('cuil', ['label'=> 'CUIL', 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
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
            <?php $lastPreoc = 0; $getPos = -1;
            foreach($candidate->preoccupationals as $preoccupational) : $lastPreoc = $preoccupational->id; $getPos++;?>
                <div class="col-12">
                    <p class="title-results">Preocupacional #<?= $preoccupational->id; ?></p>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('appointment', __('Fecha')) ?></th>
                        <th><?= $this->Paginator->sort('status', __('Estado')) ?></th>
                        <th><?= $this->Paginator->sort('preocuppationalsType_id', __('Tipo')) ?></th>
                        <th><?= $this->Paginator->sort('aptitude_id',  __('Apto')) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= h($preoccupational->appointment) ?></td>
                            <td><?= h($preoccupational->presentOrAbsent('view')) ?></td>
                            <td><?= h($preoccupational->preocuppationalstype->name) ?></td>
                            <td><?= (!is_null($preoccupational->aptitude_id)) ? $preoccupational->aptitude->name : '-' ?></td>
                        </tr>
                    </tbody>
                </table>
                    <?php if (!empty($preoccupational->files)) : ?>
                    <div class="container row">
                        <div class="col-12">
                            <p class="title-results">Archivos para preocupacional #<?= $preoccupational->id; ?></p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?= __('Nombre') ?></th>
                                <th><?= __('Preview') ?></th>
                                <th><?= __('Descargar') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($preoccupational->files as $file) :?>
                            <tr>

                                <td><?= h($file->name) ?></td>
                                <td><img src="<?= $file->getUrl(); ?>" height="100px"/></td>
                                <td><a href="/files/<?= $preoccupational->id . DS . $file->name; ?>" target="_blank">
                                        <p class="text-center">Descargar</p>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <?php endif; ?>
            <?php endforeach; ?>
        </div>
	    <?php if (!empty($candidate->preoccupationals) and $candidate->preoccupationals[$getPos]->readyForAptitud()) : ?>
	    <?php if ($candidate->preoccupationals[$getPos]->esApto() || $candidate->preoccupationals[$getPos]->haveObservations()) :  ?>
            <div class="alert alert-info col-lg-12 text-center" role="alert">
                El aspirante esta marcado como: <?= $candidate->preoccupationals[$getPos]->aptitude->name; ?>
                <?php if (!empty($candidate->preoccupationals[$getPos]->observations)) : ?>

                    <p>Con las siguientes observaciones: <?= $candidate->preoccupationals[$getPos]->observations; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
	    <?= $this->Form->create(null, ['url' =>  ['controller' => 'Preoccupationals', 'action' => 'changeAptitud'], 'class' => 'col-lg-12 col-md-12 row']) ?>
        <div class="col-12">
            <p class="title-results">Aptitud</p>
        </div>
        <div class="mx-auto form-group row col-lg-4 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-danger col-12" id="noApto" data-id="3"><i class="fa-solid fa-circle-xmark"></i> NO APTO</button>
            </div>
        </div>
        <div class="mx-auto form-group row col-lg-4 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-info col-12" id="aptoConPrexistencia" data-id="2">APTO CON PREEXISTENCIA
                </button>
            </div>
        </div>
        <div class="mx-auto form-group row col-lg-4 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-success col-12" id="apto" data-id="1"><i class="fa-solid fa-square-check"></i> APTO</button>
            </div>
        </div>
        <div id="observaciones" class="pl-0 col-12" style="display:none;">
	        <?= $this->Form->control('preoccupational_id', ['type'=> 'hidden', 'class' => 'form-control form-control-blue m-0 col-12',  'readonly', 'value' => $lastPreoc]); ?>
	        <?= $this->Form->control('aptitud', ['type'=> 'hidden', 'class' => 'form-control form-control-blue m-0 col-12',  'readonly', 'value' => 1]); ?>
            <div class="mx-auto form-group row col-lg-12 col-md-12">
                <label for="observations">Observaciones</label>
                <textarea id="observations" name="observations" class="form-control form-control-blue m-0 col-12">
                    <?= (!empty($candidate->preoccupationals[$getPos]->observations)) ? $candidate->preoccupationals[$getPos]->observations : ''; ?>

                </textarea>
            </div>
            <div class="mx-auto form-group row col-lg-4 col-md-12">
                <div class="pl-0 col-12">
                    <button type="submit" class="btn btn-outline-primary col-12" id="sendApto"><i class="fa-solid fa-square-check"></i> Enviar</button>
                </div>
            </div>
        </div>
	    <?= $this->Form->end() ?>
        <?php else : ?>
            <?php
		    if (empty($candidate->preoccupationals) ) {
			    $needDate = true;
		    } else {
			    $needDate = $candidate->preoccupationals[$getPos]->noNeedForNewDate();
			    $presentorAbsentDate = $candidate->preoccupationals[$getPos]->presentOrAbsent();

		    }

            if (!empty($candidate->preoccupationals) and !$candidate->preoccupationals[$getPos]->isPresent() and !$needDate) : ?>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
                    El aspirante no esta marcado como presente.
                </div>
            <?php else : ?>
                <?php if ($needDate) : ?>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
	                <?= ($needDate) ? $this->Html->link(__('Asignar turno'),   strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id, ['fullBase' => true]) : (($presentorAbsentDate) ? $presentorAbsentDate : $candidate->preoccupationals[$getPos]->showDate()); ?>
                </div>
                 <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
</div>

<?php $this->start('scriptBottom'); ?>
<script>
    $("#noApto, #aptoConPrexistencia").on("click", function (){
        $("#observaciones").show();
        $("#aptitud").val($(this).attr('data-id'));
    });

    $("#apto").on("click", function (){
        $("#observaciones").hide();
        $("#aptitud").val($(this).attr('data-id'));
        $("#sendApto").trigger('click');
    });

    $('#sendApto').on('click', function (e){
        var x = confirm( "Esta seguro que quiere cambiar el estado del aspirante?!");
        if(!x){
            e.preventDefault();
        }
    })
</script>
<?php $this->end(); ?>