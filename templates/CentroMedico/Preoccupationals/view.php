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
                    </tr>
					</thead>
					<tbody>
					<tr>
						<td><?= h($preoccupational->appointment) ?></td>
						<td><?= h($preoccupational->presentOrAbsent('view')) ?></td>
						<td><?= h($preoccupational->preocuppationalstype->name) ?></td>
						<td><?= (!is_null($preoccupational->aptitude_id)) ? $preoccupational->aptitude->name : '-' ?></td>
						<?php if (!empty($preoccupational->observations)) { echo '<td>' . $preoccupational->observations . '</td>'; } ?>
                    </tr>
					</tbody>
				</table>
				<?php if (!empty($preoccupational->files)) : ?>
					<div class="container row">
						<div class="col-12">
							<p class="title-results">Archivos para preocupacional </p>
						</div>
						<table class="table table-bordered">
							<thead>
							<tr>
								<th><?= __('Nombre') ?></th>
								<th><?= __('Documentos') ?></th>
								<th><?= __('Descargar') ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($preoccupational->files as $file) :?>
								<tr>

									<td><?= h($file->name) ?></td>
									<td><img src="<?= $file->getUrl(); ?>" height="100px"/></td>
									<td>
										<?= $this->Html->link(__('Descargar'),   DS . 'files/' . $preoccupational->id . DS . $file->name, ['fullBase' => true, 'class' => 'text-center', 'target' => '_blank']); ?>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>

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
		<?php endif; ?>
	</div>

