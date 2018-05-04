$('#main').on('change', function(e) {
	e.preventDefault();
	var folder = $("#folder").val();
	var formData = new FormData($(this)[0]);
	$.ajax({
		type: 'post',
		url:'index.php?r=site/upload&folder='+folder,
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function (msg) {
			alert("Картинка скоро будет загружена");
		},
		success: function(data) {
			var response = JSON.parse(data);
			if (response.status == "success"){
				$(".images").append("<div class=\"myimg\">" +
					"<img src=\"images/"+ response.text.folder +"/"+response.text.name +"\" width=\"200px\" height=\"200px\"><br>" +
					"Имя <p id='imgName' onmouseleave='renameImageStepTwo(this)' onclick='renameImageStepOne(this)' data-id='"+response.text.id+"'>"+ response.text.title +" </p>"+
					"Описание <p id='imgDesc' onmouseleave='editDescStepTwo(this)' onclick='editDescStepOne(this)' data-id='"+response.text.id+"'>"+ response.text.description +" </p>"+
					"<a href='#' data-id='"+response.text.id+"' onclick='deleteImage(this)' id='deleteimg'>Удалить</a>" +
					"</div>");
				console.log(response.text);
				console.log("Картинка успешно загружена");
			}
			alert("Картинка загружена");
		}
	});
	e.preventDefault();
	return false;
});

function renameImageStepOne(string) {
	var name = $(string).text();
	$(string).html("<input id =\"rename\" type=\"text\" value=\""+name+"\">");
	$(".myimg #rename").focus();
}

function editDescStepOne(string) {
	var name = $(string).text();
	$(string).html("<input id =\"descImage\" type=\"text\" value=\""+name+"\">");
	$(".myimg #descImage").focus();
}

$(".myimg #imgName").click(function() {
	renameImageStepOne(this);
});

$(".myimg #imgDesc").click(function() {
	editDescStepOne(this);
});

$(".myimg #imgName").mouseenter(function() {
	$(this).css('cursor', 'pointer');
});

function renameImageStepTwo(string) {
	var id = $(string).data("id");
	var newName = $("#rename").val();
	$(string).html(newName);
	if (newName !== undefined) {
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
				// console.log(data);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}
}

function editDescStepTwo(string) {
	var id = $(string).data("id");
	var newDesc = $("#descImage").val();
	$(string).html(newDesc);
	if (newDesc !== undefined) {
		$.ajax({
			url: 'index.php?r=site/edit-desc',
			type: 'post',
			data: {id:id,newdesc:newDesc},
			beforeSend: function (msg) {
			},
			success: function(data) {
				if (data == "success"){
					console.log("Описание картинки изменено");
				}
				// console.log(data);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}
}

$(".myimg #imgName").mouseleave(function() {
	renameImageStepTwo(this);
});

$(".myimg #imgDesc").mouseleave(function() {
	editDescStepTwo(this);
});

function deleteImage(string){
	var id = $(string).data("id");
	var el = $(string).parent();
	$.ajax({
		url: 'index.php?r=site/remove-image',
		type: 'post',
		data: {id:id},
		beforeSend: function (msg) {
			// alert("Картинка скоро будет удалена");
		},
		success: function(data) {
			if (data == "success"){
				el.remove();
				console.log("Картинка с номером "+ id +" удалена");
				// alert("Картинка удалена");
			}
		},
		error: function(data) {
			console.log(data);
		}
	});
}

$(".myimg #deleteimg").click(function() {
	deleteImage(this);
});

function newFolder() {

	var folderName = prompt('Введите имя папки', '');

	$.ajax({
		url: 'index.php?r=site/create-folder',
		type: 'post',
		data: {folderName:folderName},
		beforeSend: function (msg) {
			// alert("Картинка скоро будет удалена");
		},
		success: function(data) {
			var response = JSON.parse(data);
			if (response.status == "success"){
				console.log("Папка успешно создана");
				$("div .jumbotron").append(
					"<div id=\"folder\">" +
					"<a class=\"link\" href=\"/projects/gallery/web/index.php?r=site/upload&folder=\"\"+folderName+\">"+folderName+"</a>" +
					"</div>"
				);
			}

		},
		error: function(data) {
			console.log(data);
		}
	});
}

function setImageForFolder(id,folderName) {

	imageUrl = '../images/catty.jpg';
	$('#folder').css('background-image','url("' +imageUrl+'")');
}

function setFonImages() {
	$.ajax({
		url: 'index.php?r=site/create-folder',
		type: 'post',
		data: {folderName:folderName},
		beforeSend: function (msg) {
			// alert("Картинка скоро будет удалена");
		},
		success: function(data) {
			var response = JSON.parse(data);
			if (response.status == "success"){
				console.log("Папка успешно создана");
				$("div .jumbotron").append(
					"<div id=\"folder\">" +
					"<a class=\"link\" href=\"/projects/gallery/web/index.php?r=site/upload&folder=\"\"+folderName+\">"+folderName+"</a>" +
					"</div>"
				);
			}

		},
		error: function(data) {
			console.log(data);
		}
	});
}