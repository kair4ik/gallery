<?php
/**
 * Created by PhpStorm.
 * User: kmuldash
 * Date: 03.05.2018
 * Time: 14:41
 */

/** @var \app\models\UploadImage $model */

use yii\web\View;
use yii\widgets\ActiveForm;


//unlink($url);
?>

<?php $form = ActiveForm::begin([
		'id'=>'main',
]) ?>
<?= $form->field($model, 'file')->fileInput(['id'=>'image']) ?>
<?php ActiveForm::end() ?>

	<br>

	<div class="images">
		<?php
		$images = \app\models\Image::find()->all();
		if (count($images) == 0) {
			echo "Изображений не найдено";
		}
		foreach ($images as $image) {
			?>
		<div class="myimg">
			<?php
			echo "Id: " . $image->id . "<br>";
			echo "Имя <p id='imgName' data-id='$image->id'>" . $image->title . "</p>";
			?>
			<img src="images/<?= $image->name ?>" alt="" width="200px" height="200px"> <br>
			<?php
			echo "Описание: " . $image->description . "<br>
			<a href='#' data-id='$image->id' id='deleteimg'>Удалить</a><br>
			</div>";
		} ?>
	</div>

<?php
$script = <<<JS

		$('#main').on('change', function(e) {
			e.preventDefault();
			
				var formData = new FormData($(this)[0]);        
				$.ajax({
					type: 'post',
					url:'index.php?r=site/upload',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						var response = JSON.parse(data);
						if (response.status == "success"){
							$(".images").prepend("<div class=\"myimg\">" +
							 "<img src=\"images/"+ response.text +"\" width=\"200px\" height=\"200px\">" +
							  "</div>");
							console.log("Картинка успешно загружена");
						}
					}
				});
				e.preventDefault();
				return false;
		});

		$(".myimg #imgName").mouseenter(function() {
			var id = $(this).data("id");
			var name = $(this).text();
			$(this).html("<input id =\"rename\" type=\"text\" value=\""+name+"\">" +
			 "<p><a href=\"#\" id=\"saveName\" onclick=\"saveName("+id+")\" data-id=\""+id+"\">Сохранить</a></p>");
			$(".myimg #rename").focus();
			console.log("Зашел  "+id);
		});
			
		
	
		$(".myimg #imgName").mouseleave(function() {
			var id = $(this).data("id");
			var newName = $("#rename").val();
			$(this).html(newName);
		  	console.log("Вышел "+id);
			  
			  $.ajax({
				url: 'index.php?r=site/edit-name',
				type: 'post',
				data: {id:id,newname:newName},
				beforeSend: function (msg) {
					},
				success: function(data) {
					if (data == "success"){
						console.log("Картинка переименована");
					}
					console.log(data);
				},
				error: function(data) {
					console.log(data);
				}
			  });
			  
		});
		
		$(".myimg #deleteimg").click(function() {
		  var id = $(this).data("id");
		  var el = $(this).parent();
		  
		  $.ajax({
				url: 'index.php?r=site/remove-image',
				type: 'post',
				data: {id:id},
				beforeSend: function (msg) {
					},
				success: function(data) {
					if (data == "success"){
						el.remove();
						console.log("Картинка с номером "+ id +" удалена");
					}
				},
				error: function(data) {
					console.log(data);
				}
			  });
		});
		

JS;
$this->registerJs($script, View::POS_END);
?>

