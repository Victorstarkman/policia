<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aptitude $aptitude
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aptitude->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aptitude->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Aptitudes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="aptitudes form content">
            <?= $this->Form->create($aptitude) ?>
            <fieldset>
                <legend><?= __('Edit Aptitude') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
