<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate $candidate
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $candidate->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Candidates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidates form content">
            <?= $this->Form->create($candidate) ?>
            <fieldset>
                <legend><?= __('Edit Candidate') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('lastname');
                    echo $this->Form->control('cuil');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('email');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
