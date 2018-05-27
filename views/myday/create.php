<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Myday */

$this->title = 'Today, I learnt ';
$this->params['breadcrumbs'][] = ['label' => 'Mydays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="myday-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
