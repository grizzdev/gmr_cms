$('[data-toggle="tooltip"]').tooltip();

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('.model-form, .login-form').validator({
	disable: true
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	if (typeof data.error === 'undefined') {
		if (typeof data.href !== 'undefined') {
			document.location.href = data.href;
		}
	} else {
		showModal('errorModal', data.error, 'Error!');
	}
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('input[type="file"]').fileupload({
	dataType: 'json',
	done: function (e, data) {
		if (data.result.image.id) {
			$('#file_id').val(data.result.image.id);
			$('#file_name').html(data.result.image.name);
		}
	}
});

var tagnames = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	remote: {
		url: '/tag/json'
	}
});

tagnames.initialize();

$('input[data-role="tagsinput"]').tagsinput({
	typeaheadjs: {
		name: 'tags',
		displayKey: 'name',
		valueKey: 'name',
		source: tagnames
	}
});

$('div.editor').wysiwyg();

function showModal(id, content, title, buttons) {
	content = ((typeof content !== 'undefined') ? content : null);
	title = ((typeof title !== 'undefined') ? title : null);
	buttons = ((typeof buttons !== 'undefined') ? buttons : []);

	if ($('#'+id).length) {
		$('#'+id).find('.modal-title').html(title);
		$('#'+id).find('.modal-body').html(content);
		$('#'+id).find('.modal-footer').html('');

		$(buttons).each(function(i, button) {
			$(button).appendTo('.modal-footer')
		});

		$('#'+id).modal('show');
	}
}

function linkFormatter(value) {
	return (value) ? '<a href="'+value+'"><i class="glyphicon glyphicon-eye-open"></i></a>' : null;
}

function idLinkFormatter(value) {
	return (value) ? '<a href="'+value+'">'+value+'</a>' : null;
}

function dateFormatter(value) {
	return (value) ? new Date(value).format('m/d/yy') : null;
}

function datetimeFormatter(value) {
	return (value) ? new Date(value).format('m/d/yy h:MM TT') : null;
}

function booleanFormatter(value) {
	return (value == true) ? 'Y' : 'N';
}

function currencyFormatter(value) {
	return (value > 0) ? '$'+value : null;
}

function genderFormatter(value) {
	return (value == 'm') ? 'Male' : 'Female';
}

function locationTypeFormatter(value) {
	var type = null;

	if (value == 0) type = 'Country';
	else if (value == 1) type = 'State/Province';
	else if (value == 2) type = 'City';

	return type;
}

function nominationFormatter(value) {
	return (value)
		? '<a href="'+value+'/approve" title="Approve" class="success"><i class="glyphicon glyphicon-ok"></i></a>&nbsp;&nbsp;<a href="'+value+'/deny" title="Deny" class="danger"><i class="glyphicon glyphicon-remove"></i></a>'
		: null;
}
