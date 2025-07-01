<?php

/**
 * @var CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(1);
?>

<nav class="pagination-nav" aria-label="<?= lang('Pager.pageNavigation') ?>">
    <?php if ($pager->hasPrevious()) : ?>
        <a href="<?= $pager->getPrevious() ?>" class="page-link" aria-label="<?= lang('Pager.previous') ?>">
            <i class="ri-arrow-left-s-line icon"></i> <?= lang('Pager.previous') ?>
        </a>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <a href="<?= $link['uri'] ?>" class="page-link <?= $link['active'] ? 'active' : '' ?>">
            <?= $link['title'] ?>
        </a>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <a href="<?= $pager->getNext() ?>" class="page-link" aria-label="<?= lang('Pager.next') ?>">
            <?= lang('Pager.next') ?> <i class="ri-arrow-right-s-line icon"></i>
        </a>
    <?php endif ?>
</nav>
