<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Preoccupational[]|\Cake\Collection\CollectionInterface $preoccupationals
 */
?>
<div class="preoccupationals index content">
    <?= $this->Html->link(__('New Preoccupational'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Preoccupationals') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('candidate_id') ?></th>
                    <th><?= $this->Paginator->sort('appointment') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('aptitude_id') ?></th>
                    <th><?= $this->Paginator->sort('preocuppationalsType_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($preoccupationals as $preoccupational): ?>
                <tr>
                    <td><?= $this->Number->format($preoccupational->id) ?></td>
                    <td><?= $preoccupational->has('candidate') ? $this->Html->link($preoccupational->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $preoccupational->candidate->id]) : '' ?></td>
                    <td><?= h($preoccupational->appointment) ?></td>
                    <td><?= h($preoccupational->created) ?></td>
                    <td><?= h($preoccupational->modified) ?></td>
                    <td><?= $this->Number->format($preoccupational->status) ?></td>
                    <td><?= $preoccupational->has('aptitude') ? $this->Html->link($preoccupational->aptitude->name, ['controller' => 'Aptitudes', 'action' => 'view', $preoccupational->aptitude->id]) : '' ?></td>
                    <td><?= $this->Number->format($preoccupational->preocuppationalsType_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $preoccupational->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $preoccupational->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $preoccupational->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preoccupational->id)]) ?>
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
        <p><?= $this->Paginator->counter(__('P&aacute;gina {{page}} of {{pages}}, mostrando {{current}} aspirante(s) out of {{count}} aspirantes')) ?></p>
    </div>
</div>
