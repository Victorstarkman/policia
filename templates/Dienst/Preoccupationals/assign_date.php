<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Preoccupational $preoccupational
 * @var \Cake\Collection\CollectionInterface|string[] $candidates
 * @var \Cake\Collection\CollectionInterface|string[] $aptitudes
 */
?>

<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Asignación de fecha</h4>
    </div>
    <div class="results">
        <div class="container mx-auto row">
            <div class="col-12">
                <p class="title-results">Formulario de asignación de fecha<br/><small>Los campos indicados con&nbsp;<span style="color:red">*</span>  son de llenado obligatorio</small></p>
            </div>
			<?= $this->Flash->render() ?>
            <div class="alert alert-info col-lg-12 text-center msg" role="alert" style="display: none;"></div>
			<?= $this->Form->create($preoccupational, ['class' => 'col-lg-12 col-md-12 row']) ?>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
                    <?= $this->Form->control('appointment', ['label'=> 'Día de cita*', 'class' => 'form-control form-control-blue m-0 col-12', 'requiered' => true]); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
                    <?=  $this->Form->control('preocuppationalsType_id', ['empty' => __('Seleccione'), 'label'=> 'Tipo de preocupacional*', 'class' => 'form-control form-control-blue m-0 col-12', 'requiered' => true]); ?>
                </div>
            </div>
            <div class="mx-auto form-group row col-lg-6 col-md-12">
                <div class="pl-0 col-12">
                    <a href="<?= $this->Url->build(  DS . strtolower($this->request->getParam('prefix')) . '/aspirantes/', ['fullBase' => true]); ?>" class="btn btn-outline-primary col-12"><i class="far fa-clock"></i> Asignar más tarde</a>
                </div>
            </div>
            <div class="mx-auto form-group row col-lg-6 col-md-12">
                <div class="pl-0 col-12">
                    <button type="submit" id="guardar" class="btn btn-outline-primary col-12" name="guardar"><i class="far fa-save"></i> Asignar turno</button>
                </div>
            </div>
			<?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?php $this->start('scriptBottom'); ?>

<script>
    var now = new Date(),
        // minimum date the user can choose, in this case now and in the future
        minDate = now.toISOString().substring(0,10);

    $('#appointment').prop('min', minDate)
    $("form").on('submit', function (e) {
        $date = $('#appointment').val();
        $preocupational = $('#preocuppationalstype-id option:selected').val();
        $msg = "";
        var varDate = new Date($date);
        if ($date === "" || $preocupational === "" || varDate < now) {
            if ($date === "" ) {
                $msg = "La fecha es obligatoria<br/>";
            } else if (varDate < now) {
                $msg += "La fecha tiene que ser mayor a: " + minDate + "<br/> ";
            }

            if ($preocupational === "") {
                $msg += "El tipo de preocupacional es obligatorio."
            }
            $('.msg').show();
            e.preventDefault();
        }
        $('.msg').html($msg);
    });
</script>
<?php $this->end(); ?>