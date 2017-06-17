<?php if (!empty($results)) : ?>
    <?php foreach ($results as $result) : ?>
        <div class="title cf">
            <figure class="image">
                <img src="<?php echo $result['img_url']; ?>">
            </figure>
            <div class="text">
                <h2><?php echo $result['title']; ?></h2>
                <p><?php echo $result['short_synopsis']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>No results found</p>
<?php endif; ?>
