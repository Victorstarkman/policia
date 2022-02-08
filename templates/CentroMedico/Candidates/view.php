<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate $candidate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Candidate'), ['action' => 'edit', $candidate->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Candidate'), ['action' => 'delete', $candidate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidate->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Candidates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Candidate'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidates view content">
            <h3><?= h($candidate->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($candidate->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($candidate->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cuil') ?></th>
                    <td><?= h($candidate->cuil) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($candidate->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($candidate->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $candidate->has('user') ? $this->Html->link($candidate->user->name, ['controller' => 'Users', 'action' => 'view', $candidate->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($candidate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= $this->Number->format($candidate->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($candidate->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($candidate->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Preoccupationals') ?></h4>
                <?php if (!empty($candidate->preoccupationals)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Candidate Id') ?></th>
                            <th><?= __('Appointment') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Aptitude Id') ?></th>
                            <th><?= __('PreocuppationalsType Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($candidate->preoccupationals as $preoccupationals) : ?>
                        <tr>
                            <td><?= h($preoccupationals->id) ?></td>
                            <td><?= h($preoccupationals->candidate_id) ?></td>
                            <td><?= h($preoccupationals->appointment) ?></td>
                            <td><?= h($preoccupationals->created) ?></td>
                            <td><?= h($preoccupationals->modified) ?></td>
                            <td><?= h($preoccupationals->status) ?></td>
                            <td><?= h($preoccupationals->aptitude_id) ?></td>
                            <td><?= h($preoccupationals->preocuppationalsType_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Preoccupationals', 'action' => 'view', $preoccupationals->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Preoccupationals', 'action' => 'edit', $preoccupationals->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Preoccupationals', 'action' => 'delete', $preoccupationals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preoccupationals->id)]) ?>
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
