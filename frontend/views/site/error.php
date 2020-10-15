<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Eroarea de mai sus a aparut în timpul procesării cererii de către serverul web.
    </p>
    <p>
        Vă rugăm să ne contactați dacă sunteti de parere că aceasta este o eroare de server. Mulțumim.
    </p>

</div>
