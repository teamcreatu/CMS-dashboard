function submitPhoto()
{
	var form = $('#imageUploadForm')[0];
	alert(form_data);
	var form_data = new FormData(form);
	$.ajax({
		method:"POST",
		url: '{{Request::root()}}'+'/cd-admin/add-photo-dynamic',
		data: {'form_data':form_data},
		enctype:'multipart/form-data',
		dataType:"html",
		success: function(response)
		{

		}
	})
}