<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate[]|\Cake\Collection\CollectionInterface $candidates
 */
?>
<div class="mx-auto mt-5 col-12">
	<div class="col-12 title-section">
		<h4>Lista de aspirantes</h4>
	</div>
	<div class="results">
		<p class="title-results">Aspirantes</p>

		<?= $this->Flash->render() ?>
		<?= $this->Form->create(null, ['type' => 'GET', 'class' => 'col-lg-12 col-md-12 row']) ?>
		<div class="pt-0 col-lg-6 col-sm-12">
			<div class="form-group">
				<?= $this->Form->control('search', ['label'=> false, 'placeholder' => 'Buscar por CUIL o Email', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => $search]); ?>
			</div>
		</div>
		<div class="pl-0 col-6">
			<?= $this->Form->button(__('Buscar'), ['class' => 'btn btn-outline-primary col-12']) ?>
		</div>

		<?= $this->Form->end() ?>
		<table class="table table-bordered" id="tabla_actualizaciones">
			<thead>
			<tr>
                <th><?= $this->Paginator->sort('id', __('#')) ?></th>
                <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                <th><?= $this->Paginator->sort('lastname', __('Apellido')) ?></th>
                <th><?= $this->Paginator->sort('cuil', __('CUIL')) ?></th>
                <th><?= $this->Paginator->sort('appoitment', __('Turno')) ?></th>
                <th><?= $this->Paginator->sort('preocuppationalstype_id', __('Tipo')) ?></th>
				<th class="actions"><?= __('Acciones') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($candidatesToCheck as $candidateToCheck): ?>
				<tr>
                    <td><?= $this->Number->format($candidateToCheck->id) ?></td>
                    <td><?= h($candidateToCheck->candidate->name) ?></td>
                    <td><?= h($candidateToCheck->candidate->lastname) ?></td>
                    <td><?= h($candidateToCheck->candidate->cuil) ?></td>
                    <td><?= $candidateToCheck->showDate(); ?>
                    <td><?= h($candidateToCheck->preocuppationalstype->name) ?></td>
                    <td>
	                    <?= $this->Html->link('Dar apto',   strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $candidateToCheck->candidate->id, ['fullBase' => true]); ?>

                    </td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?= $this->element('paginator'); ?>
	</div>
</div>