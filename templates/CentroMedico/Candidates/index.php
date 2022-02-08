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
		<?= $this->Flash->render() ?>
        <table class="table table-bordered" id="tabla_actualizaciones">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('lastname') ?></th>
                <th><?= $this->Paginator->sort('cuil') ?></th>
                <th><?= $this->Paginator->sort('Turno') ?></th>
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
						<?= $this->Html->link('<i class="mr-2 fas fa-eye" aria-hidden="true"></i>', ['action' => 'view', $appoitment->id], [ 'escape' => false]); ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $appoitment->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appoitment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appoitment->id)]) ?>
                    </td>
                </tr>
			<?php endforeach;?>
            </tbody>
        </table>
		<?= $this->element('paginator'); ?>
    </div>
</div>