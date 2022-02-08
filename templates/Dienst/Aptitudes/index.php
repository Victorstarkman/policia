<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aptitude[]|\Cake\Collection\CollectionInterface $aptitudes
 */
?>
<div class="aptitudes index content">
    <?= $this->Html->link(__('New Aptitude'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Aptitudes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aptitudes as $aptitude): ?>
                <tr>
                    <td><?= $this->Number->format($aptitude->id) ?></td>
                    <td><?= h($aptitude->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $aptitude->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aptitude->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aptitude->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aptitude->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
