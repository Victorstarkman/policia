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
        <div class="mx-auto form-group row col-lg-12 col-md-12">
            <div class="pl-0 col-6">
                <a href="<?= $this->Url->build( strtolower($this->request->getParam('prefix')) . '/aspirantes/agregar', ['fullBase' => true]); ?>" class="btn btn-outline-primary col-12"><i class="mr-2 fas fa-info-circle" aria-hidden="true"></i>Agregar aspirante</a>
            </div>
            <div class="pl-0 col-6">
                <a href="#"<?php //echo $this->Url->build(strtolower($this->request->getParam('prefix')).  '/aspirantes/importar', ['fullBase' => true]); ?>" class="btn btn-outline-primary col-12" ><i class="mr-2 fas fa-info-circle" aria-hidden="true"></i>Subir excel</a>
            </div>
        </div>
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
                <th><?= $this->Paginator->sort('aptitude_id', __('Apto')) ?></th>
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
                    <td><?php
	                    $getPos = count($candidate->preoccupationals) - 1;
                        if (empty($candidate->preoccupationals) ) {
		                    $needDate = true;
                        } else {
		                    $needDate = $candidate->preoccupationals[$getPos]->noNeedForNewDate();
		                    $presentorAbsentDate = $candidate->preoccupationals[$getPos]->presentOrAbsent();

                        }  ?>
                        <?= ($needDate) ? $this->Html->link(__('Asignar turno'),   strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id, ['fullBase' => true]) : (($presentorAbsentDate) ? $presentorAbsentDate : $candidate->preoccupationals[$getPos]->showDate()); ?>
                    </td>
                    <td>
                        <?= (!empty($candidate->preoccupationals) and !is_null($candidate->preoccupationals[$getPos]->preocuppationalstype)) ? $candidate->preoccupationals[$getPos]->preocuppationalstype->name : '-' ?>
                    </td>
                    <td>
                        <?= (!empty($candidate->preoccupationals) and !is_null($candidate->preoccupationals[$getPos]->aptitude_id)) ? $candidate->preoccupationals[$getPos]->aptitude->name : '-' ?>
                    </td>
                    <td class="actions">
	                    <?= $this->Html->link('Editar',   strtolower($this->request->getParam('prefix')) . '/aspirantes/editar/' . $candidate->id, ['fullBase' => true]); ?>
                        |
	                    <?php if (!empty($candidate->preoccupationals) and $candidate->preoccupationals[$getPos]->readyForAptitud()) : ?>
	                        <?= $this->Html->link('Dar apto',   strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $candidate->id, ['fullBase' => true]); ?>
                        <?php else : ?>
	                        <?= $this->Html->link('Ver',   strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $candidate->id, ['fullBase' => true]); ?>
                        <?php endif; ?>
                    </td>
                </tr>
			<?php endforeach;?>
            </tbody>
        </table>
        <?= $this->element('paginator'); ?>
    </div>
</div>