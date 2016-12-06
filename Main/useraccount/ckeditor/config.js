/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

   config.filebrowserBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=flash';
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Print,Source,Save,NewPage,Preview,Templates,Cut,Undo,Find,SelectAll,Scayt,Form,HiddenField,Bold,RemoveFormat,NumberedList,About,TextColor,Maximize,Styles,Link,BidiLtr,JustifyLeft,Blockquote,Outdent,BulletedList,Indent,CreateDiv,JustifyCenter,JustifyRight,JustifyBlock,Language,BidiRtl,Flash,Unlink,Anchor,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,FontSize,Font,Format,BGColor,ShowBlocks,Redo,Replace,Copy,Paste,PasteText,PasteFromWord,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,Superscript,Subscript,Strike,Underline,Italic';
};
