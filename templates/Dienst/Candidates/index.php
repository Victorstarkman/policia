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
                <a href="<?= $this->Url->build(  DS . strtolower($this->request->getParam('prefix')) . '/aspirantes/agregar', ['fullBase' => true]); ?>" class="btn btn-outline-primary col-12"><i class="mr-2 fas fa-info-circle" aria-hidden="true"></i>Agregar aspirante</a>
            </div>

            <?= $this->Form->create(null,['type' => 'file','url' => [
                                                                    'controller' => 'Candidates',
                                                                    'action' => 'excelphp'
        ]]  )?>
                <div class="custom-input-file pl-0 ">
                    <input  type="file" class="input-file form-control-blue" name="import file" > 
                </div>
            </div>
            <div class="mx-auto form-group col-lg-12 col-md-12 my-4">
                <button type="submit" class="btn btn-outline-primary btn-block"><i class="mr-2 fas fa-save" aria-hidden="true"></i>Guardar excel</button>
            </div>
            <?= $this->Form->end()?>
        <p class="title-results">Aspirantes</p>

	    <?= $this->Flash->render() ?>
	    <?= $this->Form->create(null, ['type' => 'GET', 'class' => 'col-lg-12 col-md-12 row']) ?>
            <div class="pt-0 col-lg-3 col-sm-12">
                <div class="form-group">
                    <?= $this->Form->control('cuil', ['label'=> false, 'placeholder' => 'Buscar por DNI o Email', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => (isset($search['cuil'])) ? $search['cuil'] : '']); ?>
                </div>
            </div>
            <div class="pt-0 col-lg-3 col-sm-12">
                <div class="form-group">
                    <?= $this->Form->control('preoccupationalStatus', ['options' => $preoccupationalStatusList, 'label'=> false, 'empty' => 'Estado', 'class' => 'form-control form-control-blue m-0 col-12', 'value' => (isset($search['preoccupationalStatus'])) ? $search['preoccupationalStatus'] : '']); ?>
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
                <th><?= $this->Paginator->sort('cuil', __('DNI')) ?></th>
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
                            $unsubscribe = FALSE;
                            $presentorAbsentDate = FALSE;
                        } else {
		                    $needDate = $candidate->preoccupationals[$getPos]->noNeedForNewDate();
		                    $presentorAbsentDate = $candidate->preoccupationals[$getPos]->presentOrAbsent();
		                    $unsubscribe = $candidate->preoccupationals[$getPos]->unsubscribe();

                        }  ?>
                        <?php if(($auth->group_id == 5 and (!$unsubscribe))):?>
                        
                        <?= ($needDate) ? $this->Html->link(__('Asignar turno'),   DS .  strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id, ['fullBase' => true]) : (($presentorAbsentDate) ? $presentorAbsentDate : $candidate->preoccupationals[$getPos]->showDate()); ?>
                        <?php elseif($unsubscribe):?>
                            Dado de Baja
                        <?php else:?>
                            <?= (!empty($candidate->preoccupationals) and !is_null($candidate->preoccupationals[$getPos]->preocuppationalstype)) ? $candidate->preoccupationals[$getPos]->showDate() : 'Sin Turno' ?>
                        <?php endif;?>
                    </td>
                    <td>
                        <?= (!empty($candidate->preoccupationals) and !is_null($candidate->preoccupationals[$getPos]->preocuppationalstype)) ? $candidate->preoccupationals[$getPos]->preocuppationalstype->name : '-' ?>
                    </td>
                    <td>
                        <?= (!empty($candidate->preoccupationals) and !is_null($candidate->preoccupationals[$getPos]->aptitude_id)) ? $candidate->preoccupationals[$getPos]->aptitude->name : '-' ?>
                    </td>
                    <!-- ---------------- Acciones -------------------------------- -->
                    <td class="actions">
                        <?php if(!$unsubscribe):?>
	                    <?= $this->Html->link('Editar',   DS . strtolower($this->request->getParam('prefix')) . '/aspirantes/editar/' . $candidate->id, ['fullBase' => true]); ?>
                        |
	                    <?php if (!empty($candidate->preoccupationals) and $candidate->preoccupationals[$getPos]->haveAptitudAssign() and $auth->group_id == 2) : ?>
		                    <?= $this->Html->link('Actualizar Aptitud',   DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $candidate->id, ['fullBase' => true]); ?>
                                |
	                    <?php elseif (!empty($candidate->preoccupationals) and $candidate->preoccupationals[$getPos]->readyForAptitud()  and $auth->group_id == 2) : ?>
	                        <?= $this->Html->link('Aptitud',   DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $candidate->id, ['fullBase' => true]); ?>

                        <?php elseif(!empty($candidate->preoccupationals) and !$candidate->preoccupationals[$getPos]->haveAptitudAssign() and $auth->group_id == 5) : ?>
	                        
                            <?= $this->Html->link('Baja ',   DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/darBaja/' . $candidate->id, ['fullBase' => true]);?>
                                |
                            <?php elseif(!$presentorAbsentDate and $auth->group_id == 5) : ?>
                                <?= $this->Html->link('Baja ',   DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/darBaja/' . $candidate->id, ['fullBase' => true]);?>
                                |    
		                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $candidate->id], ['confirm' => __('Estas seguro que queres eliminar al apirante # {0}?', $candidate->id)]) ?>
                                |
                            
	                        <?php endif; ?>
                            <?= $this->Html->link('Ver ',   DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $candidate->id, ['fullBase' => true]); ?>
                            <?php if (empty($candidate->preoccupationals)) : ?>
	                    <?php endif; ?>
	                    <?php endif; ?>

                    </td>
                </tr>
			<?php endforeach;?>
            </tbody>
        </table>
        <?= $this->element('paginator'); ?>
    </div>
</div>