<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Preoccupational $preoccupational
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Preoccupational'), ['action' => 'edit', $preoccupational->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Preoccupational'), ['action' => 'delete', $preoccupational->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preoccupational->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Preoccupationals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Preoccupational'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="preoccupationals view content">
            <h3><?= h($preoccupational->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Candidate') ?></th>
                    <td><?= $preoccupational->has('candidate') ? $this->Html->link($preoccupational->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $preoccupational->candidate->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Aptitude') ?></th>
                    <td><?= $preoccupational->has('aptitude') ? $this->Html->link($preoccupational->aptitude->name, ['controller' => 'Aptitudes', 'action' => 'view', $preoccupational->aptitude->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Preocuppationalstype') ?></th>
                    <td><?= $preoccupational->has('preocuppationalstype') ? $this->Html->link($preoccupational->preocuppationalstype->name, ['controller' => 'Preocuppationalstypes', 'action' => 'view', $preoccupational->preocuppationalstype->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($preoccupational->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($preoccupational->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= h($preoccupational->appointment) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($preoccupational->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($preoccupational->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Files') ?></h4>
                <?php if (!empty($preoccupational->files)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Preoccupational Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Type') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($preoccupational->files as $files) : ?>
                        <tr>
                            <td><?= h($files->id) ?></td>
                            <td><?= h($files->preoccupational_id) ?></td>
                            <td><?= h($files->name) ?></td>
                            <td><?= h($files->type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Files', 'action' => 'view', $files->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Files', 'action' => 'edit', $files->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $files->id], ['confirm' => __('Are you sure you want to delete # {0}?', $files->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
