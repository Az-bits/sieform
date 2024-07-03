<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php $conter = 0; ?>
<?php foreach (Hasher::getMenu() as $mKey => $mVal) : ?>
    <?php $conter++ ?>
    <?php if (gettype($mVal) == "string") : ?>
        <?php if (isset($mMenu)) : ?>
            <?php if ($mKey == $mMenu) : ?>
                <!-- echo "<li class='active'>"; -->
            <?php else : ?>
                <!--echo "<li>"; -->
            <?php endif ?>
        <?php else : ?>
            <!--echo "<li>"; -->
        <?php endif ?>
        <li class="nav-item  ">
            <a class="nav-link" href="<?= site_url($mVal) ?>">
                <i class="material-icons"><?= Mapping::icon()[$conter] ?></i>
                <p><?= $mKey ?></p>
            </a>
        </li>
    <?php elseif (gettype($mVal) == "array") : ?>
        <?php if (isset($mMenu)) : ?>
            <?php if ($mKey == $mMenu) : ?>
                <!-- echo "<li class='active'>"; -->
            <?php else : ?>
                <!--echo "<li>"; -->
            <?php endif ?>
        <?php else : ?>
            <li class="nav-item <?= $mKey == $title ? 'active' : '' ?>">
                <a class="nav-link" data-toggle="collapse" href="#<?= $mKey ?>">
                    <i class="material-icons"><?= Mapping::icon()[$conter] ?></i>
                    <p> <?= $mKey ?>
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?= $mKey == $title ? 'show' : '' ?>" id="<?= $mKey ?>">
                    <ul class="nav">
                        <?php foreach ($mVal as $smKey => $smVal) : ?>
                            <li class="nav-item <?= $mKey == $title ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= site_url($smVal)  ?>">
                                    <span class="sidebar-mini"><?= substr($smKey, 0, 1)  ?></span>
                                    <span class="sidebar-normal"> <?= $smKey ?> </span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </li>
        <?php endif ?>
    <?php endif ?>
<?php endforeach ?>



<!-- <script>
    var focusLink = document.querySelectorAll('.nav-item')[5];
    focusLink.addEventListener('click', function() {
        focusLink.classList.add("active");
    });
</script> -->