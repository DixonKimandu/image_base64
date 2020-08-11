$(document).ready(function()
{
 $('form').ajaxForm(function()
 {
  alert("Uploaded SuccessFully");
 });
});

function preview_image()
{
 var total_file=document.getElementById("upload_file").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='column'><img src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}
