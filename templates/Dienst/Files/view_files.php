<table class="table table-bordered" id="files-preoccupational-<?= $preoccupationalID; ?>">
	<thead>
	<tr>
		<th><?= __('Nombre') ?></th>
		<th><?= __('Documentos') ?></th>
		<th><?= __('Acciones') ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($files as $file) :?>
		<tr id="file-<?= $file->id; ?>">

			<td><?= h($file->name) ?></td>
			<td><img src="<?= $file->getUrl(); ?>" height="100px"/></td>
			<td>
				<?= $this->Html->link(__('Descargar'),  DS.  'files'. DS . $preoccupationalID . DS . $file->name, ['fullBase' => true, 'class' => 'text-center', 'target' => '_blank']); ?>
				|
				<?= $this->Html->link(__('Borrar'),  DS.  'files'. DS . $preoccupationalID . DS . $file->name, ['fullBase' => true, 'class' => 'text-center', 'target' => '_blank']); ?>
				|
				<?= $this->Html->link(__('Reemplazar'),  'javascript:void(0)', ['class' => 'text-center loadNewFile', 'data-id' => $file->id]); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
