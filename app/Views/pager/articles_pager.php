<?php

/**
 * @var CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav class="pagination" aria-label="<?= lang('Pager.pageNavigation') ?>">
    <?php if ($pager->hasPrevious()): ?>
        <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="page-link">
            <span aria-hidden="true"><?= lang('Pager.first') ?></span>
        </a>
        <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
            <i class="ri-arrow-left-s-line"></i> <?= lang('Pager.previous') ?>
        </a>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
        <a href="<?= $link['uri'] ?>" class="page-link <?= $link['active'] ? 'active' : '' ?>">
            <?= $link['title'] ?>
        </a>
    <?php endforeach ?>

    <?php if ($pager->hasNext()): ?>
        <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
            <?= lang('Pager.next') ?> <i class="ri-arrow-right-s-line"></i>
        </a>
        <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
            <span aria-hidden="true"><?= lang('Pager.last') ?></span>
        </a>
    <?php endif ?>
</nav>
