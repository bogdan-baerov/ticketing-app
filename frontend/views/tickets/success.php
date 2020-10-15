<?php 
use yii\web\View;

$this->registerJs("
    $(document).ready(function(){
        var delay = 10000; 
        var url = '/tickets/create';
        setTimeout(function(){ window.location = url; }, delay);

    });", View::POS_END);
?>
<div class="jumbotron">
    <i class="fas fa-check-square fa-10x" style="color:#5cb85c;"></i><h1>Tichetul #<?= $model->id ?> a fost trimis cu succes!</h1>
    <h3>O să fiți redirecţionaţi către pagina de trimitere tichet în <span class="large">10</span> secunde</h3><i class="fas fa-cog fa-spin fa-8x"></i>
</div>

