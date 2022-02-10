<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate[]|\Cake\Collection\CollectionInterface $candidates
 */
?>
<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Lista de aspirantes para el dia: <?= $today->i18nFormat('dd/MM/yyyy'); ?></h4>
    </div>
    <div class="results">
        <p class="title-results">Aspirantes</p>
        <div class="mx-auto form-group row col-lg-12 col-md-12">
	        <?= $this->Form->create($candidatesWithAppoitment, ['type' => 'GET', 'class' => 'col-lg-12 col-md-12 row']) ?>
            <div class="pt-0 col-lg-6 col-sm-12">
                <div class="form-group">
			        <?= $this->Form->control('search', ['label'=> false, 'placeholder' => 'Buscar por CUIL o Email', 'class' => 'form-control form-control-blue m-0 col-12', 'value' =>     $search]); ?>
                </div>
            </div>
            <div class="pl-0 col-6">
	            <?= $this->Form->button(__('Buscar'), ['class' => 'btn btn-outline-primary col-12']) ?>
            </div>

	        <?= $this->Form->end() ?>
        </div>
		<?= $this->Flash->render() ?>
        <table class="table table-bordered" id="tabla_actualizaciones">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('#') ?></th>
                <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                <th><?= $this->Paginator->sort('lastname', __('Nombre')) ?></th>
                <th><?= $this->Paginator->sort('cuil', __('Nombre')) ?></th>
                <th><?= $this->Paginator->sort('$appoitment', __('Turno')) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($candidatesWithAppoitment as $appoitment): ?>
                <tr>
                    <td><?= $this->Number->format($appoitment->id) ?></td>
                    <td><?= h($appoitment->candidate->name) ?></td>
                    <td><?= h($appoitment->candidate->lastname) ?></td>
                    <td><?= h($appoitment->candidate->cuil) ?></td>
                    <td><?= $appoitment->showDate(); ?>
                    </td>
                    <td class="actions">
                        <?php if ($appoitment->isPresent()) : ?>
	                        <?= $this->Html->link('Subir Documentos',  '/centro-medico/preocupacionales/presente/' . $appoitment->id, [ 'escape' => false]); ?>
                        <?php else : ?>
	                        <?= $this->Html->link('Presente',  '/centro-medico/preocupacionales/presente/' . $appoitment->id, [ 'escape' => false]); ?>
                            /
	                        <?= $this->Form->postLink(__('Ausente'), ['controller' => 'Preoccupationals', 'action' => 'markAsAbsent', $appoitment->id], ['confirm' => __('Desea marcar como ausente a {1} {2} (#{0})?', $appoitment->id, $appoitment->candidate->name, $appoitment->candidate->lastname)]) ?>
                        <?php endif; ?>
                    </td>
                </tr>
			<?php endforeach;?>
            </tbody>
        </table>
		<?= $this->element('paginator'); ?>
    </div>
</div>