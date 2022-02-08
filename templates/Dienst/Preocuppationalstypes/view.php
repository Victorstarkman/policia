<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Preocuppationalstype $preocuppationalstype
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Preocuppationalstype'), ['action' => 'edit', $preocuppationalstype->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Preocuppationalstype'), ['action' => 'delete', $preocuppationalstype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preocuppationalstype->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Preocuppationalstypes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Preocuppationalstype'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="preocuppationalstypes view content">
            <h3><?= h($preocuppationalstype->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($preocuppationalstype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($preocuppationalstype->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
