<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate[]|\Cake\Collection\CollectionInterface $candidates
 */
?>
<div class="mx-auto mt-5 col-12">
	<div class="col-12 title-section">
		<h4>Turnos Masivos</h4>
	</div>
	<div class="results">
		<p class="title-results">Aspirantes</p>
		<div class="mx-auto form-group row col-lg-12 col-md-12">
			<div class="pl-0 col-4">
				<?= $this->Form->control('appointment', ['label'=> false, 'type' => 'datetime', 'class' => 'form-control form-control-blue m-0 col-12 dateToAssign', 'requiered' => true]); ?>
                <small>Seleccione la fecha que desea asignar a todos los turnos.</small>
			</div>
            <div class="pl-0 col-4">
				<?= $this->Form->control('preocuppationalstype_id', ['label'=> false, 'options' => $preocuppationalsTypes, 'empty' => 'Seleccione' , 'class' => 'form-control form-control-blue m-0 col-12 preocuppationalstype_id', 'requiered' => true]); ?>
                <small>Seleccione el tipo de preocupacional.</small>
			</div>
			<div class="pl-0 col-4">
				<button href="javascript:void(0)" class="btn btn-outline-primary col-12 assignDate" disabled><i class="mr-2 fas fa-clock" aria-hidden="true"></i>Asignar Turnos</button>
			</div>
		</div>
		<?= $this->Flash->render() ?>
		<table class="table table-bordered" id="tabla_actualizaciones">
			<thead>
			<tr>
				<th><?= $this->Paginator->sort('id') ?></th>
				<th><?= $this->Paginator->sort('name') ?></th>
				<th><?= $this->Paginator->sort('lastname') ?></th>
				<th><?= $this->Paginator->sort('cuil') ?></th>
				<th class="actions"><?= __('Seleccione') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($candidatesWithoutDate as $candidate): ?>
				<tr>
					<td><?= $this->Number->format($candidate->id) ?></td>
					<td><?= h($candidate->name) ?></td>
					<td><?= h($candidate->lastname) ?></td>
					<td><?= h($candidate->cuil) ?></td>
					<td class="actions">
						<input type="checkbox" class="appointment" data-id="<?= $this->Number->format($candidate->id) ?>">
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>

<?php $this->start('scriptBottom'); ?>
<script>
let candidateID = [];
$('input.appointment').change(function(){
    if ($(this).is(':checked')) {
        candidateID.push($(this).attr('data-id'))
    } else {
        candidateID.pop($(this).attr('data-id'))
    }

    if (candidateID.length > 0) {
        $(".assignDate").attr("disabled", false)
    } else {
        $(".assignDate").attr("disabled", true)
    }
});
<div class="loading"></div>
$(".assignDate").on("click", function(){
    dateInput = $(".dateToAssign").val();
    preocuppationalstype_id = $(".preocuppationalstype_id option").filter(':selected').val();

    $.ajax({
        cache: false,
        url: '<?php echo $this->Url->build(['controller' => 'Preoccupationals', 'action' => 'addMasive']); ?>/',
        data: {candidatesID: candidateID, date:  dateInput, preocuppationalstype_id: preocuppationalstype_id},
        dataType: "json",
        success: function(data) {
            location.reload();
        }
    });
})
</script>
<?php $this->end(); ?>
