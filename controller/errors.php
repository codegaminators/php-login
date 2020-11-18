<?php

if (isset($_SESSION['errors'])) { ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <ul>
    <?php foreach ($_SESSION['errors'] as $error) { ?>
        <li><?php echo $error; ?></li>
    <?php } ?>
    </ul>
</div>
<?php  unset($_SESSION['errors']); }