<?php if( ($categories = get_field('categories')) && ($tiles = $categories['tiles']) ): ?>

<section class="section section--dark section--tight">
    <div class="categories-grid">
        <?php $index = 1; foreach( $tiles as $tile ) {
            if( $index === 1 || $index === 6 ): ?>
                <a href="<?php echo $tile['link']; ?>" class="categories categories-grid__item categories-grid__item--<?php echo $index; ?> w-inline-block" <?php echo 'data-path="'.$tile['animation'].'" style="background-image:url('.$tile['banner'].');"' ?> id="<?php echo $index === 1 ? 'w-node-_88e54227-745a-a217-8dfd-879ecc4e46e2-c1d12c40' : 'w-node-_15cb076c-2761-e288-c0e2-39a4e6459944-c1d12c40'; ?>"></a>
            <?php else: ?>
                <a href="<?php echo $tile['link']; ?>" class="categories categories-grid__item categories-grid__item--<?php echo $index; ?> w-inline-block" <?php echo  'data-path="'.$tile['animation'].'" style="background-image:url('.$tile['banner'].');"' ?>></a>
            <?php endif; $index++;
        } ?>
    </div>
</section>

<?php endif; ?>