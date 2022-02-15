<div class="text-center">
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->first('<< ' . __('Primera')) ?>
			<?= $this->Paginator->prev('< ' . __('Anterior')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('Siguiente') . ' >') ?>
			<?= $this->Paginator->last(__('Última') . ' >>') ?>
		</ul>
		<p><?= $this->Paginator->counter(__('P&aacute;gina {{page}} de {{pages}}, mostrando {{current}} registro(s) de un total de {{count}}')) ?></p>
	</div>
</div>