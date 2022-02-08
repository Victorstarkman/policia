<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Preoccupational $preoccupational
 * @var string[]|\Cake\Collection\CollectionInterface $candidates
 * @var string[]|\Cake\Collection\CollectionInterface $aptitudes
 * @var string[]|\Cake\Collection\CollectionInterface $preocuppationalstypes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $preoccupational->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $preoccupational->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Preoccupationals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="preoccupationals form content">
            <?= $this->Form->create($preoccupational) ?>
            <fieldset>
                <legend><?= __('Edit Preoccupational') ?></legend>
                <?php
                    echo $this->Form->control('candidate_id', ['options' => $candidates]);
                    echo $this->Form->control('appointment', ['empty' => true]);
                    echo $this->Form->control('status');
                    echo $this->Form->control('aptitude_id', ['options' => $aptitudes, 'empty' => true]);
                    echo $this->Form->control('preocuppationalsType_id', ['options' => $preocuppationalstypes]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
