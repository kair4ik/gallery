<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<style>

</style>
<div class="site-index">

    <div class="jumbotron">
		<div id="folder">
			<?php
				$url = \yii\helpers\Url::to(['/site/upload']);
				echo \yii\helpers\Html::a("Галерея", $url);
			?>
		</div>
    </div>

    <div class="body-content">


    </div>
</div>
