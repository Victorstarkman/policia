<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Actualización de Aspirante</h4>
    </div>
    <div class="results">
        <div class="container mx-auto row">
            <div class="col-12">
                <p class="title-results">Datos de aspirante: <?= $preoccupational->candidate->name . ' ' . $preoccupational->candidate->lastname; ?></p>
            </div>
			<?= $this->Flash->render() ?>
			<?= $this->Form->create($preoccupational, ['class' => 'col-lg-12 col-md-12 row']) ?>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('name', ['label'=> 'Nombre', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $preoccupational->candidate->name, 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('lastname', ['label'=> 'Apellido', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $preoccupational->candidate->lastname, 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('cuil', ['label'=> 'DNI', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $preoccupational->candidate->cuil, 'readonly']); ?>
                </div>
            </div>

            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('phone', ['label'=> 'Teléfono', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $preoccupational->candidate->phone, 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('email', ['label'=> 'Email', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $preoccupational->candidate->email, 'readonly']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
					<?= $this->Form->control('gender', ['label'=> 'Sexo', 'require' => true, 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $preoccupational->candidate->getGender(), 'readonly']); ?>
                </div>
            </div>
			<?= $this->Form->end() ?>
            <?php if ($preoccupational->waitingResults()) : ?>
            <div class="col-12">
                <p class="title-results">Foto de aspirante(Máx. 1MB)</p>
            </div>
                <div id="fileuploader-profile" class="col-12">Cargar</div>
            <div class="col-12">
                <p class="title-results">Archivos e imagenes (Máx. 10 Archivos hasta 10MB cada uno)</p>
            </div>
            <div id="fileuploader" class="col-12">Cargar</div>
                <div class="alert alert-info col-lg-12 text-center mt-5" role="alert">
                   Una vez que se suban todos los archivos/estudios aprete el boton finalizar.
                </div>

	            <?= $this->Form->create($preoccupational, ['class' => 'col-lg-12 col-md-12 row']) ?>
	            <?= $this->Form->control('status', ['label'=> false, 'type' => 'hidden', 'value'=> $present, 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
                <div class="mx-auto form-group row col-lg-12 col-md-12">
                    <div class="pl-0 col-12">
                        <button type="submit" class="btn btn-outline-primary col-12" name="guardar"><i class="fa-solid fa-square-check"></i> Finalizar </button>
                    </div>
                </div>
	            <?= $this->Form->end() ?>
            <?php else : ?>
                <div class="alert alert-info col-lg-12 text-center" role="alert">
                    Marcar aspirante como PRESENTE para subir documentos
                </div>
	            <?= $this->Form->create($preoccupational, ['class' => 'col-lg-12 col-md-12 row']) ?>
	                 <?= $this->Form->control('status', ['label'=> false, 'type' => 'hidden', 'value'=> $waiting, 'class' => 'form-control form-control-blue m-0 col-12', 'readonly']); ?>
                <div class="mx-auto form-group row col-lg-12 col-md-12">
                    <div class="pl-0 col-12">
                        <button type="submit" class="btn btn-outline-primary col-12" name="guardar"><i class="fa-solid fa-square-check"></i> MARCAR PRESENTE</button>
                    </div>
                </div>
	            <?= $this->Form->end() ?>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php if ($preoccupational->waitingResults()) : ?>
<?php echo $this->Html->css('uploadFiles/styleUploadFile', ['block' => 'script']); ?>
<?php echo $this->Html->script('uploadFiles/uploadFile', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {

        var $preoccupationalID = $("#id").val();

        $("#fileuploader-profile").uploadFile({
            url: '<?php echo $this->Url->build(['controller' => 'Files','action' => 'profilePhoto', $preoccupational->candidate->id]); ?>',
            fileName:"profilePhoto",
            showCancel: false,
            showAbort: false,
            showFileSize: false,
            showPreview: true,
            allowedTypes: "jpeg,jpg,png,gif",
            multiple: false,
            previewHeight: "100px",
            headers: { 'X-XSRF-TOKEN' :'<?= $this->request->getAttribute('csrfToken'); ?>'},
            previewWidth: "100px",
            formData: {"_csrfToken": '<?= $this->request->getAttribute('csrfToken'); ?>'},
            dragDropStr: "<br/><span><b>Arrastra y solta</b></span>",
            uploadStr: 'Subir',
            fileCounterStyle: ') ',
            deleteStr: 'Eliminar',
            showDelete: true,
            onLoad:function(obj) {
                $.ajax({
                    cache: false,
                    url: '<?php echo $this->Url->build(['controller' => 'Files','action' => 'viewFiles', $preoccupational->candidate->id, 'candidate' ]); ?>',
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(
                                data[i]["name"],
                                data[i]["path"],
                                data[i]["size"]);
                        }
                    }
                });
            },
            deleteCallback: function (data, pd) {
                var name= '';
                if (typeof  data === 'string') {
                    data = $.parseJSON(data);
                    if (data.name) {
                        name = data.name;
                    }
                } else if (typeof  data === 'object') {
                    name = data[0];
                } else {
                    alert('No se pudo borrar. Intente nuevamente');
                    return;
                }

                if (name !== "") {
                    $.post('<?php echo $this->Url->build(['controller' => 'Files','action' => 'delete']); ?>', {'type': 'candidate', op: "delete",name: name, "_csrfToken": '<?= $this->request->getAttribute('csrfToken'); ?>'},
                        function (resp, textStatus, jqXHR) {
                            alert(resp);
                        });
                    pd.statusbar.hide(); //You choice.
                }
            },
            onSuccess:function(files,data,xhr,pd) {
                var getNumber = pd.statusbar[0].innerText.split(')')[0];
                console.log(data);
                if (typeof  data === 'string') {

                    data = $.parseJSON(data);

                    if (data.name) {
                        pd.filename.html(getNumber + ') ' + data.name);
                    }
                }
            }
        });

        $("#fileuploader").uploadFile({
            url: '<?php echo $this->Url->build(['controller' => 'Files','action' => 'addFile', $preoccupational->id]); ?>',
            fileName:"preoccupationFile",
            showCancel: false,
            showAbort: false,
            showFileSize: false,
            showPreview: true,
            previewHeight: "100px",
            headers: { 'X-XSRF-TOKEN' :'<?= $this->request->getAttribute('csrfToken'); ?>'},
            previewWidth: "100px",
            formData: {"preoccupational_id": $preoccupationalID, "_csrfToken": '<?= $this->request->getAttribute('csrfToken'); ?>'},
            dragDropStr: "<br/><span><b>Arrastra y solta</b></span>",
            uploadStr: 'Subir',
            fileCounterStyle: ') ',
            deleteStr: 'Eliminar',
            showDelete: true,
            returnType: 'json',
            onLoad:function(obj)
            {
                $.ajax({
                    cache: false,
                    url: '<?php echo $this->Url->build(['controller' => 'Files','action' => 'viewFiles', $preoccupational->id ]); ?>',
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(
                                data[i]["name"],
                                data[i]["path"],
                                data[i]["size"]);
                        }
                    }
                });
            },
            deleteCallback: function (data, pd) {
                var name= '';
                if (typeof  data === 'string') {
                    data = $.parseJSON(data);
                    if (data.name) {
                        name = data.name;
                    }
                } else if (typeof  data === 'object') {
                    name = data[0];
                } else {
                    alert('No se pudo borrar. Intente nuevamente');
                    return;
                }

                if (name !== "") {
                    $.post('<?php echo $this->Url->build(['controller' => 'Files','action' => 'delete']); ?>', {op: "delete",name: name, "_csrfToken": '<?= $this->request->getAttribute('csrfToken'); ?>'},
                        function (resp, textStatus, jqXHR) {
                            alert(resp);
                        });
                    pd.statusbar.hide(); //You choice.
                }
            },
            onSuccess:function(files,data,xhr,pd) {
                var getNumber = pd.statusbar[0].innerText.split(')')[0];
                if (typeof  data === 'string') {
                    data = $.parseJSON(data);
                    if (data.name) {
                        pd.filename.html(getNumber + ') ' + data.name);
                    }
                }
            },
            onError: function(files,status,errMsg,pd)
            {
                //console.log('a');
                //files: list of files
                //status: error status
                //errMsg: error message
            },
            afterUploadAll:function(obj)
            {
            }
        });
    });
</script>
<?php $this->end(); ?>
<?php endif; ?>