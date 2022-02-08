<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Preoccupational $preoccupational
 * @var \Cake\Collection\CollectionInterface|string[] $candidates
 * @var \Cake\Collection\CollectionInterface|string[] $aptitudes
 * @var \Cake\Collection\CollectionInterface|string[] $preocuppationalstypes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Preoccupationals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="preoccupationals form content">
            <?= $this->Form->create($preoccupational) ?>
            <fieldset>
                <legend><?= __('Add Preoccupational') ?></legend>
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
