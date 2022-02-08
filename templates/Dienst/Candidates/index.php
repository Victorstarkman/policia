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
        <div class="mx-auto form-group row col-lg-12 col-md-12">
            <div class="pl-0 col-6">
                <a href="<?= $this->Url->build( strtolower($this->request->getParam('prefix')) . '/aspirantes/agregar', ['fullBase' => true]); ?>" class="btn btn-outline-primary col-12"><i class="mr-2 fas fa-info-circle" aria-hidden="true"></i>Agregar aspirante</a>
            </div>
            <div class="pl-0 col-6">
                <a href="<?= $this->Url->build(strtolower($this->request->getParam('prefix')).  '/aspirantes/importar', ['fullBase' => true]); ?>" class="btn btn-outline-primary col-12"><i class="mr-2 fas fa-info-circle" aria-hidden="true"></i>Subir excel</a>
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
                <th><?= $this->Paginator->sort('Turno') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($candidates as $candidate): ?>
                <tr>
                    <td><?= $this->Number->format($candidate->id) ?></td>
                    <td><?= h($candidate->name) ?></td>
                    <td><?= h($candidate->lastname) ?></td>
                    <td><?= h($candidate->cuil) ?></td>
                    <td><?php if (empty($candidate->preoccupationals) ) {
		                    $needDate = true;
                        } else {
		                    $getPos = count($candidate->preoccupationals) - 1;
		                    $needDate = $candidate->preoccupationals[$getPos]->noNeedForNewDate();
		                    $presentorAbsentDate = $candidate->preoccupationals[$getPos]->presentOrAbsent();

                        }  ?>
                        <?= ($needDate) ? $this->Html->link(__('Asignar turno'),   strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id, ['fullBase' => true]) : (($presentorAbsentDate) ? $presentorAbsentDate : $candidate->preoccupationals[$getPos]->showDate()); ?>
                    </td>
                    <td class="actions">
						<?= $this->Html->link('<i class="mr-2 fas fa-eye" aria-hidden="true"></i>', ['action' => 'view', $candidate->id], [ 'escape' => false]); ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidate->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidate->id)]) ?>
                    </td>
                </tr>
			<?php endforeach;?>
            </tbody>
        </table>
        <?= $this->element('paginator'); ?>
    </div>
</div>