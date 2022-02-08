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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $preocuppationalstype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $preocuppationalstype->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Preocuppationalstypes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="preocuppationalstypes form content">
            <?= $this->Form->create($preocuppationalstype) ?>
            <fieldset>
                <legend><?= __('Edit Preocuppationalstype') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
