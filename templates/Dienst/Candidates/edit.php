<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate $candidate
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="mx-auto mt-5 col-12">
	<div class="col-12 title-section">
		<h4>Alta de Aspirante</h4>
	</div>
	<div class="results">
		<div class="container mx-auto row">
			<div class="col-12">
				<p class="title-results">Formulario de Alta de aspirante<br/><small>Los campos indicados con&nbsp;<span style="color:red">*</span>  son de llenado obligatorio</small></p>
			</div>
			<?= $this->Flash->render() ?>
			<?= $this->Form->create($candidate, ['url' => ['controller' => 'candidates', 'action' => 'edit', $candidate->id],'class' => 'col-lg-12 col-md-12 row']) ?>
			<div class="pt-0 col-lg-4 col-sm-12">
				<div class="form-group">
					<?= $this->Form->control('name', ['label'=> 'Nombre', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
				</div>
			</div>
			<div class="pt-0 col-lg-4 col-sm-12">
				<div class="form-group">
					<?= $this->Form->control('lastname', ['label'=> 'Apellido', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
				</div>
			</div>
			<div class="pt-0 col-lg-4 col-sm-12">
				<div class="form-group">
					<?= $this->Form->control('cuil', ['label'=> 'Cuil', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
				</div>
			</div>
			<div class="pt-0 col-lg-4 col-sm-12">
				<div class="form-group">
					<?= $this->Form->control('phone', ['label'=> 'Celular', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
				</div>
			</div>
			<div class="pt-0 col-lg-4 col-sm-12">
				<div class="form-group">
					<?= $this->Form->control('email', ['label'=> 'Email', 'class' => 'form-control form-control-blue m-0 col-12']); ?>
				</div>
			</div>
			<div class="pt-0 col-lg-4 col-sm-12">
				<div class="form-group">
					<?= $this->Form->control('gender', ['label'=> 'Sexo', 'empty' => __('Seleccione'), 'class' => 'form-control form-control-blue m-0 col-12']); ?>
				</div>
			</div>
			<div class="mx-auto form-group row col-lg-12 col-md-12">
				<div class="pl-0 col-12">
					<button type="submit" class="btn btn-outline-primary col-12" ><i class="far fa-save"></i> Editar</button>
				</div>
			</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>