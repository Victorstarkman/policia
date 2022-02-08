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
            <?= $this->Html->link(__('List Preocuppationalstypes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="preocuppationalstypes form content">
            <?= $this->Form->create($preocuppationalstype) ?>
            <fieldset>
                <legend><?= __('Add Preocuppationalstype') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
