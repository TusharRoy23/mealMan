var imageArr = []; var successimageArr = [];
var fileArr = []; var successFileArr = [];

$(document).ready(function(){
	// $(".post_submit").on('submit', function(e){
	// 	e.preventDefault();
	// 	var description = $(".description").val();
	// 	var img = $("#files").val();

	// 	if (description) {

	// 		var formData = new FormData();
	// 		//alert($('#files')[0].files.length);
			
	// 		$.each($('#files')[0].files, function(i, file) {
	// 		  formData.append('files[]', file);
	// 		});
	// 		formData.append('description', description);

	// 		// $.ajax({
	// 		// 	url: post_submission,
	// 		// 	type:"POST",
	// 		// 	cache: false,
	// 		//    	contentType: false,
	// 		//    	processData: false,
	// 		// 	//data:{'description':description},
	// 		// 	//data:new FormData(this),
	// 		// 	data:formData,
	// 		// 	success:function(data){
	// 		// 		$(".description").val('');
	// 		// 		$( ".feedDiv" ).prepend(data);
	// 		// 		//alert(data);
	// 		// 	}
	// 		// });
			

	// 		//alert(FormData);
	// 	}
	// 	else{
	// 		alert("No");
	// 	}
	// });

	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: true,
		width		: '80%',
		height		: '80%',
		autoSize	: false,
		closeClick	: true,
		overlayShow : false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});

	$(".fancybox-thumb").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: true,
		transitionIn    : 'fade',
    	transitionOut   : 'fade',
    	speedIn			: 1000,
    	speedOut		: 700,
    	overlayShow     : false,
		helpers		: {
			title	: {
				type: 'inside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});

	$(".image_click").on('click', function(){
		fileDropzone.removeAllFiles();
		$(".file_dropzone").hide('slow');
		$(".image_dropzone").slideToggle('slow');
	});

	$(".file_click").on('click', function(){
		imageDropzone.removeAllFiles();
		$(".image_dropzone").hide('slow');
		$(".file_dropzone").slideToggle('slow');
	});

	$("#profileUpdateSubmit").on('submit', function(e){
		
		e.preventDefault();

		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();

		if (firstname && lastname) {
			$.ajax({
				url:updateProfile,
				type:"POST",
				data:new FormData(this),
				processData:false,
				contentType:false,
				cache:false,
				async:false,
				success: function(data){
					if (data) {
						location.reload();
					}
				}
			});
		} else {alert("NOT OK");}
	});

	$("#submit-all").on('click', function(e){
		e.preventDefault();

		var description = $(".description").val();
		if (description && imageArr.length){
			imageDropzone.processQueue();
		}
		else if(description && fileArr.length){
			fileDropzone.processQueue();
		}
		else{
			if (!description) {
				alert("Please fill up the description.");
			}
			else{
				$.ajax({
					url: post_submission,
					type:"POST",
					data:{'description':description, 'images':0},
					success:function(data){
						imageDropzone.removeAllFiles(true);
						$(".description").val('');
						//$( ".feedDiv" ).prepend(data);

						$(".feedDiv").load(location.href + " .feedDiv");
					}
				});
			}
		}
		
	});
});

Dropzone.autoDiscover = false;

if ($("#image-dropzone").length) {
	var imageDropzone = new Dropzone("#image-dropzone", {
		url: DropZoneImage,
		acceptedFiles: "image/*",
		addRemoveLinks: true,
		dictRemoveFile:'<i class="fa fa-remove"></i>',
		autoProcessQueue:false,
		parallelUploads: 10,
		accept: function(file, callback){
			imageArr.push(file.name);
			callback();
		},
		success: function( file, response ){
			successimageArr.push(response);
			if (imageArr.length == successimageArr.length) {

				var description = $(".description").val();
				if (description) {
					imageDropzone.processQueue();

					$.ajax({
						url: post_submission,
						type:"POST",
						data:{'description':description, 'images':successimageArr, 'type':1},
						dataType: "json",
						success:function(data){
							imageDropzone.removeAllFiles();
							successimageArr.length = 0;
							imageArr.length = 0;
							$(".description").val('');
							//$( ".feedDiv" ).prepend(data);
							//$(".feedDiv").load(location.href + " .feedDiv");

							// var str = ''; var profilePic = ''; var base_url = baseUrl;
							// var profileId = ID; var firstname = data.firstname.charAt(0).toUpperCase();
							// var lastname = data.lastname.charAt(0).toUpperCase();

							// str += '<div style="margin-bottom: 2%" class="animated fadeIn">';
							// 	str += '<div class="card-header card-header-warning card-header-icon">';
							// 		str += '<div class="form-group">';
							// 			if (data.profilePic){
							// 				profilePic = base_url + '/' + data.profilePic;
							// 			}
							// 			else{
							// 				profilePic = base_url + '/assets/img/no-image-face.png';
							// 			}
							// 			str += '<label class="col-lg-6 col-md-6 col-sm-6" style="float: left;">';
							// 				str += '<h4><img src="'+profilePic+'" alt="..." style="border-radius: 50%;" height="40" width="40"> <b>Me</b></h4>';
							// 			str += '</label>'
							// 			str += '<label class="col-lg-6 col-md-6 col-sm-6" style="text-align: right;">';
							// 				str += ' Said at '+data.newsFeedsCreationDate+'</h4>';
							// 			str += '</label>';
							// 		str += '</div>';
							// 		str += '<div class="form-group">';
							// 			str += '<div class="col-lg-12 col-md-12 col-sm-12">';
							// 				str += '<br>';
							// 					str += data.newsFeedsDescription;
							// 				str += '<br>';
							// 			str += '</div>';
							// 			str += '<div class="col-lg-12 col-md-12 col-sm-12">';
							// 				str += '<div class="colll">';
							// 					if (data.newsFeedsFiles){
							// 						var arr = $.parseJSON(data.newsFeedsFiles);
							// 						$.each(arr, function(key, value){
							// 							if(data.fileType == 1){
							// 								str += '<a href="'+base_url+value+'" class="fancybox-thumb" rel="group0">';
							// 								str += '<img height="100" width="100" src="'+base_url+value+'">';
							// 								str += '</a>';
							// 							}
							// 							else{
							// 								str += '<a href="'+base_url+value+'" class="fvarious fancybox.iframe" rel="group0">';
							// 								str += '<i class="fa fa-floppy-o" aria-hidden="true" style="font-size: 50px;"></i>';
							// 								str += '</a>';
							// 							}
							// 						});
							// 					}
							// 				str += '</div>';
							// 			str += '</div>';
							// 		str += '</div>';
							// 	str += '</div>';
							// 	str += '<div class="card-footer">';
							// 		str += '<div class="row">';
							// 			str += '<label class="col-lg-6 col-md-6 col-sm-3">';
							// 				str += '<div class="stats" id="likeBtn-'+data.newsFeedsId+'" style="text-align: center;">';
							// 					str += '<a style="cursor: pointer;" onclick="postLikes('+data.newsFeedsId+')">';
							// 						str += '<span id="likes-'+data.newsFeedsId+'">('+data.likes+')</span>';
							// 						str += ' <i class="fa fa-thumbs-up" id="thumbs-'+data.newsFeedsId+'" style="font-size:30px;"></i>';
							// 					str += '</a>';
							// 				str += '</div>';
							// 			str += '</label>';
							// 			str += '<label class="col-lg-6 col-md-6 col-sm-3">';
							// 				str += '<div class="stats" style="text-align: center;">';
							// 					str += '<a style="cursor: pointer;">';
							// 						str += '<i class="fa fa-comments" style="font-size:30px"></i>';
							// 					str += '</a>';
							// 				str += '</div>';
							// 			str += '</label>';
							// 		str += '</div>';
							// 	str += '</div>';
							// str += '</div>';

							//$( ".feedDiv" ).prepend(str);

							$(".feedDiv").load(location.href +" .feedDiv", function(){
								$(".fancybox-thumb").fancybox({
									prevEffect		: 'none',
									nextEffect		: 'none',
									closeBtn		: true,
									transitionIn    : 'fade',
							    	transitionOut   : 'fade',
							    	overlayShow     : false,
									helpers		: {
										title	: {
											type: 'inside'
										},
										thumbs	: {
											width	: 50,
											height	: 50
										}
									}
								});
								$(".various").fancybox({
									maxWidth	: 800,
									maxHeight	: 600,
									fitToView	: true,
									width		: '80%',
									height		: '80%',
									autoSize	: false,
									closeClick	: true,
									overlayShow : false,
									openEffect	: 'none',
									closeEffect	: 'none'
								});
							});
						}
					});
				}
			}
	    },
		removedfile: function(file) {
			var name = file.name;
			imageArr.pop();
			$.ajax({
				type: "post",
				url: Remove,
				data: { file: name },
				dataType: 'html',
				success:function(data){
				}
			});

			// remove the thumbnail
			var previewElement;
			return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
		}
	});
}

if ($("#file-dropzone").length) {
	var fileDropzone = new Dropzone("#file-dropzone", {
		url: DropZoneFile,
		acceptedFiles: "application/*",
		addRemoveLinks: true,
		dictRemoveFile:'<i class="fa fa-remove"></i>',
		autoProcessQueue:false,
		parallelUploads: 10,
		accept: function(file, callback){
			fileArr.push(file.name);
			callback();
		},
		success: function( file, response ){
			successFileArr.push(response);
			if (fileArr.length == successFileArr.length) {

				var description = $(".description").val();
				if (description) {
					fileDropzone.processQueue();

					$.ajax({
						url: post_submission,
						type:"POST",
						data:{'description':description, 'files':successFileArr, 'type':2},
						success:function(data){
							fileDropzone.removeAllFiles();
							successFileArr.length = 0;
							fileArr.length = 0;
							$(".description").val('');
							//$( ".feedDiv" ).prepend(data);
							$( ".feedDiv" ).load(location.href +" .feedDiv", function(){
								$(".various").fancybox({
									maxWidth	: 800,
									maxHeight	: 600,
									fitToView	: true,
									width		: '80%',
									height		: '80%',
									autoSize	: false,
									closeClick	: true,
									overlayShow : false,
									openEffect	: 'none',
									closeEffect	: 'none'
								});
								$(".fancybox-thumb").fancybox({
									prevEffect		: 'none',
									nextEffect		: 'none',
									closeBtn		: true,
									transitionIn    : 'fade',
							    	transitionOut   : 'fade',
							    	overlayShow     : false,
									helpers		: {
										title	: {
											type: 'inside'
										},
										thumbs	: {
											width	: 50,
											height	: 50
										}
									}
								});
							});
						}
					});
				}
			}
	    },
	    removedfile: function(file) {
			var name = file.name;
			fileArr.pop();
			$.ajax({
				type: "post",
				url: removeFiles,
				data: { file: name },
				dataType: 'html',
				success:function(data){
				}
			});

			// remove the thumbnail
			var previewElement;
			return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
		}
	});
}


function postLikes(feedID) {
	if (feedID) {
		$.ajax({
			url:postlikes,
			type:"POST",
			data:{'feedID':feedID},
			dataType: 'json',
			success:function(data){
				//const element =  document.querySelector('#likeBtn-'+feedID);

				$("#likes-"+feedID).html("("+data.likes+")");
				//var con = $("#likeBtn-"+feedID).val();

				//element.classList.add('animated', 'jello');
				$( '#likeBtn-'+feedID ).addClass( "animated jello" );
				

				if (data.sts == 'true') {
					$("#thumbs-"+feedID).css("color", "#e056fd");
				} else {
					$("#thumbs-"+feedID).css("color", "");
				}

				setTimeout(function(){ $( '#likeBtn-'+feedID ).removeClass( "animated jello" ); }, 500);
			}
		});
	}
}

function unfollowUser(profileID) {
	if (profileID) {
		$.ajax({
			url:unfollowUsers,
			type:"POST",
			data:{'profileID':profileID},
			success:function(data){
				if (data == 'true') {
					$("#followUnfollow-"+profileID).html('<b>Follow</b>');
				}

				if (data == profileID) {
					$("#followUnfollow-"+profileID).html('<b>UnFollow</b>');
				}
			}
		});
	}
}

function followUser(profileID) {
	if (profileID) {
		$.ajax({
			url:unfollowUsers,
			type:"POST",
			data:{'profileID':profileID},
			success:function(data){
				if (data == 'true') {
					$("#followUser-"+profileID).html('<b>Follow</b>');
				}

				if (data == profileID) {
					$("#followUser-"+profileID).html('<b>UnFollow</b>');
				}
			}
		});
	}
}

function deleteFeed(feedID) {
	if (feedID) {

		$( "#dialog-confirm" ).dialog({
	    	resizable: false,
	    	height: "auto",
	    	width: 400,
	    	modal: true,
	    	show: {
		    	effect: "blind",
		    	duration: 300
		    },
		    hide: {
		    	effect: "explode",
		    	duration: 300
		    },
	    	buttons: {
		        "Delete": function() {
		        	$.ajax({
						url:deletedFeed,
						type:"POST",
						data:{'feedID':feedID},
						success:function(data){
							if (data) {
								$( "#dialog-confirm" ).dialog( "close" );
								$(".feedDiv").load(location.href + " .feedDiv");
							}
							else{
								alert('false');
							}
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							alert('Error get data from ajax ' + feedID);
						}
					});
		        },
		        Cancel: function() {
		          $( this ).dialog( "close" );
		        }
	      	}
    	});
	}
}

// function preview_image() {
// 	var total_file=document.getElementById("files").files.length;
// 	$('#image_preview').html("");
// 	for(var i=0;i<total_file;i++)
// 	{
// 		$('#image_preview').append("<img width='50px' height='50px' src='"+URL.createObjectURL(event.target.files[i])+"'>  ");
// 	}

// 	if (total_file) {
// 		$(".add_more").show();
// 	}
// }
