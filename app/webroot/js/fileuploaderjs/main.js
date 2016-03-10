/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
	var uploadurl = strGlobalSiteBasePath+'websites/uploadfile/';
	if(uploadcoverfor != "")
	{
		uploadurl = strGlobalSiteBasePath+'websites/uploadfile/?uploadfor='+uploadcoverfor;
	}
	var status = new Array(), // Create a new array
    successAll = true; // Used to check for successful upload
	
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        //url: strGlobalSiteBasePath+'test/uploadfile/'
        url: uploadurl,
		type:'post',
		maxNumberOfFiles:1,
		maxChunkSize: 50000000
    }).bind('fileuploadsubmit', function (e, data) {
    // The example input, doesn't have to be part of the upload form:
    var categoryid = $('#usercategory_list');
	var subcategoryid = $('#subcategory_id');
	var subsubcategoryid = $('#subsubcategory_id');
	var medianame = $('#media_name');
    data.formData = {categoryid: categoryid.val(),subcategoryid:subcategoryid.val(),subsubcategoryid:subsubcategoryid.val(),medianame:medianame.val()};
    
}).bind('fileuploaddone', function (e, data) {
        // Append the file response data to the global array, in my case "status"   
        status.push( jQuery.parseJSON(data.jqXHR.responseText) );
}).bind('fileuploadstop', function (e) {
        for (var i = 0; i < status.length; i++) {
            var error = status[i].files[0].error;
			var fileid = status[i].files[0].id;

            if(error) {
               
                successAll = false; // Change success value to false if error
            }
        }   

        // If successAll is true, meaning it wasn't reset because of an error,
        // display success message.
        if (successAll) {
            //window.location = strGlobalSiteBasePath+"websites"
			//alert($('#add_cover').val());
			if(uploadcoverfor != "")
			{
				window.parent.location.href = strGlobalSiteBasePath;
			}
			else
			{
				if($('#add_cover').val() == "Yes")
				{
					var strPath = strGlobalSiteBasePath+'test/mediaselector/'+fileid;
					var vastrHtml = "<iframe style='width:100%;' src='"+strPath+"'></iframe>";
					
					$('#cover_image_content').html(vastrHtml);
					$('#cover_image').show();
					$('#add_image').removeClass("active");
					$('#cover_image').addClass("active");
					$('#home').removeClass("active fade in");
					$('#menu1').addClass("active fade in");
				}
				else
				{
					window.location = strGlobalSiteBasePath
				}
			}
			
        }   
        status = new Array();       
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
			
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i


        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        /*$('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });*/
    }

});
