var elixir = require('laravel-elixir');

elixir(function(mix) {
	//mix.sass('app.scss');
	mix.sass('cms.scss');

	mix.scripts([
		'jquery/jquery.js',
		'jquery/ui.js',
		'jquery/ujs.js',
		'jquery/date.js',
		'jquery/upload.js',
		'../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
		'typeahead.js',
		'bootstrap/validator.js',
		'bootstrap/tables.js',
		'bootstrap/tagsinput.js',
		'bootstrap/extensions/tables-export.js',
		'bootstrap/extensions/tables-mobile.js',
		'bootstrap/extensions/tables-reorder.js',
		//'bootstrap/extensions/tables-toolbar.js',
		'bootstrap/wysiwyg.js',
		'jspdf.js',
		'cms.js'
	], 'public/js/cms.js');

	/*mix.scripts([
		'jquery-2.1.4.min.js',
		'jquery-ui.js',
		'../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
		'lightbox.js',
		'validator.js',
		'upload.js',
		'wow.js',
		'purl.js',
		'ujs.js',
		'video.js',
		'slick.js',
		'app.js'
	], 'public/js/all.js');*/

	mix.version([
		//'public/css/app.css',
		//'public/js/all.js',
		'public/css/cms.css',
		'public/js/cms.js'
	]);
});
