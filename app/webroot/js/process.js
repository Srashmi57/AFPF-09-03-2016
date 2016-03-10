/*--------------------------------------------------------------------------------------------
|	@desc:		live image crop with PHP&jquery
|	@author:	Aravind Buddha
|	@url:		  http://www.techumber.com
|	@date:		16 September 2012
|	@email:   aravind@techumber.com
|	@license:	Free! to Share,copy, distribute and transmit , 
|           but i'll be glad if my name listed in the credits'
---------------------------------------------------------------------------------------------*/

$(function () {
  var x1 = 0,
    y1 = 0,
    tw = 0,
    th = 0,
    rw = 300, //preview width;
    rh = 200; //preview height
  //setvalues

  //Calling imgAreaSelect plugin
  $('#imgc').imgAreaSelect({
    handles: false,
    onSelectEnd: setValue,
    onSelectChange: preview,
    aspectRatio: '4:3',
    fadeSpeed: 200,
    minWidth: 100,
    minHeight: 100,
  });

  //setvalue function
  function setValue(img, selection) {
    if (!selection.width || !selection.height)
      return;
    x1 = selection.x1;
    y1 = selection.y1;
    tw = selection.width;
    th = selection.height;
  }
  //ajax request get the 
  function getCImage() {
    $("#cropbtn").addClass("disabled").html("croping...");
    $.ajax({
      type: "GET",
      url: "../assets/process.php?img=" + $("#imgName").val() + "&w=" + tw + "&h=" + th + "&x1=" + x1 + "&y1=" + y1 + "&rw=" + rw + "&rh=" + rh,
      cache: false,
      success: function (response) {
        $("#output").html("");
        $("#cropbtn").removeClass("disabled").html("crop");
        $("#output").html("<h2>Out put</h2><img src='../assets/" + response + "' />");
      },
      error: function () {
        alert("error on ajax");
      },
    });
  }
  //preview function
  function preview(img, selection) {
    if (!selection.width || !selection.height) {
      return;
    }
    var scaleX = rw / selection.width;
    var scaleY = rh / selection.height;
    $('#preview img').css({
      width: Math.round(scaleX * img.width),
      height: Math.round(scaleY * img.height),
      marginLeft: -Math.round(scaleX * selection.x1),
      marginTop: -Math.round(scaleY * selection.y1)
    });
  }

  //will triger on crop button click 
  $("#cropbtn").click(function () {
	 
    getCImage();
  });


});