$(document).ready(function(){
	var imageEditArr = []; var successimageEditArr = [];
	var fileEditArr = []; var successfileEditArr = [];
	var subCheck = 0;

	$(".image_edit_click").on('click', function(){
		fileEditDropzone.removeAllFiles();
		$(".file_edit_dropzone").hide('slow');
		$(".image_edit_dropzone").slideToggle('slow');
	});

	$(".file_edit_click").on('click', function(){
		imageEditDropzone.removeAllFiles();
		$(".image_edit_dropzone").hide('slow');
		$(".file_edit_dropzone").slideToggle('slow');
	});

	$("#submit-edit-all").on('click', function(e){
		e.preventDefault();

		var description = $(".edit_description").val();
		if (description && imageEditArr.length){
			//imageEditDropzone.processQueue();

			if (imageEditDropzone.getQueuedFiles().length > 0) {
				subCheck = 0;
            } 
            else 
            {
			    imageEditDropzone.uploadFile([]);
			    subCheck = 1;
            }
            imageEditDropzone.processQueue();
		}
		else if(description && fileEditArr.length){
			if (fileEditDropzone.getQueuedFiles().length > 0) {
				subCheck = 0;
            } 
            else 
            {
			    fileEditDropzone.uploadFile([]);
			    subCheck = 1;
            }
            fileEditDropzone.processQueue();
		}
		else{
			if (!description) {
				alert("Please fill up the description.");
			}
			else{
				$.ajax({
					url: post_edit,
					type:"POST",
					data:{'description':description, 'files':0, 'feedID':$(".feedId").val()},
					success:function(data){
						imageEditDropzone.removeAllFiles(true);
						$(".edit_description").val('');
						//$( ".feedDiv" ).prepend(data);

						// $(".feedDiv").load(location.href + " .feedDiv");
					}
				});
			}
		}
		
	});

	Dropzone.autoDiscover = false;

	if ($("#image-edit-dropzone").length) {
		var imageEditDropzone = new Dropzone("#image-edit-dropzone", {
			url: DropZoneImage,
			acceptedFiles: "image/*",
			addRemoveLinks: true,
			dictRemoveFile:'<i class="fa fa-remove"></i>',
			autoProcessQueue:false,
			parallelUploads: 10,
			accept: function(file, callback){
				imageEditArr.push(file.name);
				callback();
			},
			success: function( file, response ){
				successimageEditArr.push(response);

				if (subCheck) {
					var successImgLength = successimageEditArr.length - 1;
				}
				else
					var successImgLength = successimageEditArr.length;

				if (imageEditArr.length == successImgLength) {
					var description = $(".edit_description").val();
					
					if (description) {
						$("#submit-edit-all").hide();
						imageEditDropzone.removeAllFiles();

						$.ajax({
							url: post_edit,
							type:"POST",
							data:{'description':description, 'files':successimageEditArr, 'type':1, 'feedID':$(".feedId").val()},
							dataType: "json",
							success:function(data){
								$("#submit-edit-all").show();
								successimageEditArr.length = 0;
								imageEditArr.length = 0;
								$(".edit_description").val('');
								location.reload();
							},
							error: function (jqXHR, textStatus, errorThrown)
							{
								location.reload();
							}
						});
					}
					else
						alert("NO description");
				}
		    },
			removedfile: function(file) {
				$(".dz-message").hide();
				var name = file.name;
				//alert(name);
				var index1 = imageEditArr.indexOf(name);
			    if (index1 > -1) {
			       imageEditArr.splice(index1, 1);
			    }

			    var index2 = successimageEditArr.indexOf("userDir/postImages/"+name);
			    if (index2 > -1) {
			       successimageEditArr.splice(index2, 1);
			    }

			    // alert(successimageEditArr.length);
				//imageEditArr.pop();
				// $.ajax({
				// 	type: "post",
				// 	url: Remove,
				// 	data: { file: name },
				// 	dataType: 'html',
				// 	success:function(data){
				// 		alert("POP");
				// 	}
				// });

				// // remove the thumbnail
				var previewElement;
				return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			},
			init: function(){
				thisDropzone = this;

				$.ajax({
					url:editImagePost,
					type:"POST",
					data:{"feedID":$(".feedId").val(), 'type':1},
					dataType: "json",
					success:function(data){
						if (data) {
							$(".image_edit_dropzone").slideToggle('slow');
       						$.each(data, function(key,value){
       							if (value.name) {
       								var file = { name: value.name, size: value.size};
									thisDropzone.options.addedfile.call(thisDropzone, file);
									thisDropzone.options.thumbnail.call(thisDropzone, file, baseUrl+"/userDir/postImages/"+value.name);
									imageEditArr.push(value.name);
									successimageEditArr.push("userDir/postImages/"+value.name);
									console.log(value.name);
       							}
							});
						}
					}
				});

				// this.on("success", function(file) {
    //         		$('.dz-image').css({"width":"100%", "height":"auto"});
    //     		})
				// this.on("success", function(file, response) {
				// 	file.serverId = response; 
				// });
			}
		});
	}

	if ($("#file-edit-dropzone").length) {
		var fileEditDropzone = new Dropzone("#file-edit-dropzone", {
			url: DropZoneFile,
			acceptedFiles: "application/*",
			addRemoveLinks: true,
			dictRemoveFile:'<i class="fa fa-remove"></i>',
			autoProcessQueue:false,
			parallelUploads: 10,
			accept: function(file, callback){
				fileEditArr.push(file.name);
				callback();
			},
			success: function( file, response ){
				successfileEditArr.push(response);
				if (subCheck) {
					var successFileLength = successfileEditArr.length - 1;
				}
				else
					var successFileLength = successfileEditArr.length;

				if (fileEditArr.length == successFileLength) {

					var description = $(".edit_description").val();
					if (description) {
						$("#submit-edit-all").hide();
						fileEditDropzone.processQueue();

						$.ajax({
							url: post_edit,
							type:"POST",
							data:{'description':description, 'files':successfileEditArr, 'type': 2, 'feedID':$(".feedId").val()},
							success:function(data){
								$("#submit-edit-all").show();
								fileEditDropzone.removeAllFiles();
								successfileEditArr.length = 0;
								fileEditArr.length = 0;
								$(".edit_description").val('');
								location.reload();
							}
						});
					}
				}
		    },
		    removedfile: function(file) {
				var name = file.name;
				//fileEditArr.pop();
				//alert(name);
				var index1 = fileEditArr.indexOf(name);
			    if (index1 > -1) {
			       fileEditArr.splice(index1, 1);
			    }

			    var index2 = successfileEditArr.indexOf("userDir/postFiles/"+name);
			    if (index2 > -1) {
			       successfileEditArr.splice(index2, 1);
			    }

				// $.ajax({
				// 	type: "post",
				// 	url: removeFiles,
				// 	data: { file: name },
				// 	dataType: 'html',
				// 	success:function(data){
				// 	}
				// });

				// remove the thumbnail
				var previewElement;
				return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			},
			init: function(){
				fileDropzone = this;

				$.ajax({
					url:editImagePost,
					type:"POST",
					data:{"feedID":$(".feedId").val(), 'type': 2},
					dataType: "json",
					success:function(data){
						if (data) {
							$(".file_edit_dropzone").slideToggle('slow');
       						$.each(data, function(key,value){
       							if (value.name) {
       								var file = { name: value.name, size: value.size};
									fileDropzone.options.addedfile.call(fileDropzone, file);
									fileDropzone.options.thumbnail.call(fileDropzone, file, baseUrl+"/userDir/postFiles/"+value.name);
									fileEditArr.push(value.name);
									successfileEditArr.push("userDir/postFiles/"+value.name);
       							}
							});
						}
					}
				});

				// this.on("success", function(file, response) {
				// 	file.serverId = response; 
				// });
			}
		});
	}
});