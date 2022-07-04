<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Actualizaci&oacute;n de Aspirante</h4>
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
            <?php $lastPreoc = 0; $getPos = -1;
            foreach($candidate->preoccupationals as $preoccupational) : $lastPreoc = $preoccupational->id; $getPos++;?>
                <div class="col-12">
                    <p class="title-results">Preocupacional </p>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('appointment', __('Fecha')) ?></th>
                        <th><?= $this->Paginator->sort('status', __('Estado')) ?></th>
                        <th><?= $this->Paginator->sort('preocuppationalsType_id', __('Tipo')) ?></th>
                        <th><?= $this->Paginator->sort('aptitude_id',  __('Apto')) ?></th>
                        <?php if (!empty($preoccupational->observations)) { echo '<th>Observacion</th>'; } ?>
                        <?php if (!empty($preoccupational->aptitudeBy)) { echo '<th>Médico</th>'; } ?>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= h($preoccupational->appointment) ?></td>
                            <td><?= h($preoccupational->presentOrAbsent('view')) ?></td>
                            <td><?= h($preoccupational->preocuppationalstype->name) ?></td>
                            <td><?= (!is_null($preoccupational->aptitude_id)) ? $preoccupational->aptitude->name : '-' ?></td>
	                        <?php if (!empty($preoccupational->observations)) { echo '<td>' . $preoccupational->observations . '</td>'; } ?>
	                        <?php if (!empty($preoccupational->aptitudeBy)) { echo '<td>' . $preoccupational->aptitudeBy->name . ' ' .$preoccupational->aptitudeBy->lastname . '</td>'; } ?>
                        </tr>
                    </tbody>
                </table>
                    <?php if (!empty($preoccupational->files)) : ?>
                    <div class="col-12 p-0">
                        <div class="col-12">
                            <p class="title-results">Archivos para preocupacional </p>
                        </div>
                        <div id="table-files-preoccupational-<?= $preoccupational->id; ?>" class="col-12 tablaFiles">
                            <table class="table table-bordered col-12" >
                                <thead>
                                <tr>
                                    <th><?= __('Nombre') ?></th>
                                    <th><?= __('Documentos') ?></th>
                                    <th><?= __('Acciones') ?></th>
                                </tr>
                                </thead>
                                <tbody>
		                        <?php foreach ($preoccupational->files as $file) :?>
                                    <tr id="file-<?= $file->id; ?>">

                                        <td><?= h($file->name) ?></td>
                                        <td><img src="<?= $file->getUrl(); ?>" height="100px"/></td>
                                        <td>
					                        <?= $this->Html->link(__('Descargar'),  DS.  'files'. DS . $preoccupational->id . DS . $file->name, ['fullBase' => true, 'class' => 'text-center', 'target' => '_blank']); ?>
                                            |
					                        <?= $this->Html->link(__('Borrar'),  DS.  'files'. DS . $preoccupational->id . DS . $file->name, ['fullBase' => true, 'class' => 'text-center', 'target' => '_blank']); ?>
                                            |
					                        <?= $this->Html->link(__('Reemplazar'),  'javascript:void(0)', ['class' => 'text-center loadNewFile', 'data-id' => $file->id]); ?>
                                        </td>
                                    </tr>
		                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>


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
        <?php if ($auth->group_id == 2) : ?>
	    <?= $this->Form->create(null, ['url' =>  ['controller' => 'Preoccupationals', 'action' => 'changeAptitud'], 'class' => 'col-lg-12 col-md-12 row']) ?>
        <div class="col-12">
            <p class="title-results">Aptitud</p>
        </div>
        <div class="mx-auto form-group row col-lg-3 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-danger col-12" id="noApto" data-id="3"><i class="fa-solid fa-circle-xmark"></i> NO APTO</button>
            </div>
        </div>
        <div class="mx-auto form-group row col-lg-3 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-info col-12" id="aptoConPrexistencia" data-id="2">APTO CON PREEXISTENCIA
                </button>
            </div>
        </div>
        <div class="mx-auto form-group row col-lg-3 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-success col-12" id="apto" data-id="1"><i class="fa-solid fa-square-check"></i> APTO</button>
            </div>
        </div>
        <div class="mx-auto form-group row col-lg-3 col-md-12">
            <div class="pl-0 col-12">
                <button type="button" class="btn btn-outline-success col-12" id="otro" data-id="4"><i class="fa-solid fa-square-check"></i> CIVIL</button>
            </div>
        </div>
        <div id="observaciones" class="pl-0 col-12" style="display:none;">
	        <?= $this->Form->control('preoccupational_id', ['type'=> 'hidden', 'class' => 'form-control form-control-blue m-0 col-12',  'readonly', 'value' => $lastPreoc]); ?>
	        <?= $this->Form->control('aptitud', ['type'=> 'hidden', 'class' => 'form-control form-control-blue m-0 col-12',  'readonly', 'value' => 1]); ?>
            <div class="mx-auto form-group row col-lg-12 col-md-12">
                <label for="observations">Observaciones</label>
                <textarea id="observations" name="observations" class="form-control form-control-blue m-0 col-12"><?php
                     if (!empty($candidate->preoccupationals[$getPos]->observations))  {
                         echo  $candidate->preoccupationals[$getPos]->observations;
                     }
                     ?></textarea>
            </div>
            <div class="mx-auto form-group row col-lg-4 col-md-12">
                <div class="pl-0 col-12">
                    <button type="submit" class="btn btn-outline-primary col-12" id="sendApto"><i class="fa-solid fa-square-check"></i> Enviar</button>
                </div>
            </div>
        </div>
	    <?= $this->Form->end() ?>
        <?php endif; ?>
        <div class="col-12">
            <p class="title-results">Nuevo turno</p>
        </div>
        <div class="row container mx-auto">
            <div class="pl-0 col-12">
	            <?= $this->Html->link('<i class="fa-solid fa-clock"></i> Asignar nuevo turno',   strtolower(DS . $this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id . '/f', ['fullBase' => true, 'escape' => false, 'class' => 'btn btn-outline-primary col-12']); ?>
            </div>
        </div>
        <?php else : ?>
            <?php
		    if (empty($candidate->preoccupationals) ) {
			    $needDate = true;
		    } else {
			    $needDate = $candidate->preoccupationals[$getPos]->noNeedForNewDate();
			    $presentorAbsentDate = $candidate->preoccupationals[$getPos]->presentOrAbsent();

		    }
            if (!empty($candidate->preoccupationals) and $candidate->preoccupationals[$getPos]->waitingResults()) : ?>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
                    El aspirante esta esperando la carga de estudios/documentos.
                </div>
            <?php elseif (!empty($candidate->preoccupationals) and (!$candidate->preoccupationals[$getPos]->isPresent()) and !$needDate) : ?>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
                    El aspirante no esta marcado como presente.
                </div>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
		            <?= $this->Html->link(__('Modificar turno'),   strtolower(DS . $this->request->getParam('prefix')) . '/preocupacionales/modificarTurno/' . $candidate->id, ['fullBase' => true]); ?>
                </div>
            <?php else : ?>
                <?php if ($needDate) : ?>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
	                <?= ($needDate) ? $this->Html->link(__('Asignar turno'),   strtolower(DS . $this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id, ['fullBase' => true]) : (($presentorAbsentDate) ? $presentorAbsentDate : $candidate->preoccupationals[$getPos]->showDate()); ?>
                </div>
                 <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
</div>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reemplazo de archivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="form-reemplazo-archivo" method="post">
                        <input class="form-control form-control-lg" id="fileID" name="fileID" type="hidden">
                        <div>
                            <label for="formFileLg" class="form-label">Seleccione el nuevo archivo</label>
                            <input class="form-control form-control-lg" id="formFileLg" type="file" name="newFile">
                        </div>
                    </form>
                    <div class="msg alert alert-danger mt-4" style="display: none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary reemplazo-archivo-submit">Reemplazar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php $this->start('scriptBottom'); ?>
<script>
    $(".tablaFiles").on("click", '.loadNewFile', function (){
        var fileID = $(this).data('id');
        $('.modal').modal('show');
        $('.modal #fileID').val(fileID);
    });

    $(".reemplazo-archivo-submit").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var data = new FormData();
        jQuery.each($('#form-reemplazo-archivo input[type=file]')[0].files, function(i, file) {
            data.append('file-'+i, file);
        });
        var other_data = $('#form-reemplazo-archivo').serializeArray();
        $.each(other_data,function(key,input){
            data.append(input.name,input.value);
        });
        $.ajax({
            url: "/dienst/files/replaceFile",
            type: "POST",
            dataType: "json",
            data: data,
            processData: false,
            contentType: false
        })
        .done(function(res) {
            if (res.error == true) {
                $('.modal .msg').html(res.message).show();
            } else {
                $('.modal .msg').html('').hide();
                $('.modal').modal('hide');
                $('#formFileLg').attr("value", '');
                $('#formFileLg').change();
                var preoccupation_id = res.data.preoccupational_id
                $.ajax({
                    url: "/dienst/files/viewFiles/" + preoccupation_id,
                    type: "GET"
                })
                .done(function(res) {
                    $('#table-files-preoccupational-' + preoccupation_id).html(res);
                });
            }
        });
    });

    $("#noApto, #aptoConPrexistencia").on("click", function (){
        $("#observaciones").show();
        $("#aptitud").val($(this).attr('data-id'));
    });

    $("#apto").on("click", function (){
        $("#observaciones").hide();
        $("#aptitud").val($(this).attr('data-id'));
        $("#sendApto").trigger('click');
    });
    $("#otro").on("click", function (){
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
