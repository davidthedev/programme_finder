<?php require_once PARTIALS . '/header.php'; ?>

    <header>
        <div class="container">
            <a href="<?php echo BASE_URL; ?>"><img src="http://static.bbci.co.uk/frameworks/barlesque/3.21.17/orb/4/img/bbc-blocks-light.png"></a>
        </div>
    </header>

    <div class="main-body">
        <div class="container">
            <div class="col-1-3">
                <section>
                    <form id="search_form" name="search_form" method="GET">
                        <input type="text" name="search" id="search" class="search_input" autocomplete="off" placeholder="Begin typing to search for a programme">
                    </form>
                </section>

                <section id="titles" class="titles">
                    <?php require_once PARTIALS . '/../Home/Partials/results.php'; ?>
                </section>
            </div>

            <div class="col-2-3"></div>

            <div class="col-3-3"></div>
        </div>
    </div>

<?php require_once PARTIALS . '/footer.php'; ?>
