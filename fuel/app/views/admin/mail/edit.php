<div id="contents-wrap">
	<div id="main">
		<h3>Send Mail</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/mime">
				<ul class="forms">
					<li><h4>To All</h4>
						<div>
							<input class="off" type="checkbox" name="for_all" value="1" <? if($mail->for_all == 1) echo "checked"; ?>>
							<label for="slideThree"></label>
						</div>
					</li>
					<li><h4>To Teachers</h4>
						<div>
							<input class="off" type="checkbox" name="for_teachers" value="1" <? if($mail->for_teachers == 1) echo "checked"; ?>>
						</div>
					</li>
					<li><h4>To Students</h4>
						<div>
							<input class="off" type="checkbox" name="for_students" value="1" <? if($mail->for_students == 1) echo "checked"; ?>>
						</div>
					</li>
					<li><h4>Mail Title</h4>
						<div>
							<input type="text" name="title" value="<? echo $mail->title; ?>" required>
						</div>
					</li>
					<li><h4>Message</h4>
						<div>
							<textarea name="body" rows="40" cols="100" novalidate><? echo $mail->body; ?></textarea>
						</div>
					</li>
					<li><h4>status</h4>
						<div>
							<input type="checkbox" name="status" <? echo "checked"; ?>>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" name="action" value="draft"> <i class="fa fa-chevron-left"></i> Save as Draft</button>
					<button class="button" name="action" value="confirm">Send <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>
		window.onunload = function(e) {
		  alert('Dialog text here.');
		};
	$(function(){
		var subText = 'display:inline-block; text-indent:10px;';
		var all = $('.forms input:eq(0)');
		var teachers = $('.forms input:eq(1)');
		var students = $('.forms input:eq(2)');
		var title = $('.forms input:eq(3)');
		var message = $('.forms input:eq(4)');
		var status = $('.forms input:eq(4)');
		var titleBox = $('input[type="text"]');
		var checkbox = $('input[type=checkbox]');
		var draft = $('button:eq(0)');
		var send = $('button:eq(1)');
		var recipient = all.add(teachers).add(students);

		//sending to all
		all.on('click', function(){
			if (all.is(':checked')) {
				teachers.add(students).attr('disabled','disabled');
				all.after('<div class="all">Both Teachers and Students will receive the email including disabled News Emails (Critical Message)</div>');
				$('.all').attr('style', subText);
				teachers.attr('checked', false);
				students.attr('checked', false);
				$('.teachers').remove();
				$('.students').remove();
			} else {
				teachers.add(students).removeAttr('disabled');
				$('.all').remove();
			}
		});

		//sending to teachers
		teachers.on('click', function(){
			if (teachers.is(':checked')) {
				teachers.after('<div class="teachers">Teachers will receive the email (excluding disabled News Emails)</div>');
				$('.teachers').attr('style', subText);
			} else {
				teachers.add(students).removeAttr('disabled');
				$('.teachers').remove();
			}
		});

		//sending to Student
		students.on('click', function(){
			if (students.is(':checked')) {
				students.after('<div class="students">Students will receive the email (excluding disabled News Emails)</div>');
				$('.students').attr('style', subText);
			} else {
				students.add(students).removeAttr('disabled');
				$('.students').remove();
			}
		});

		//same width for title box and message box
		titleBox.css({
			'maxWidth' : '100%',
			'width' : '100%',
			'margin' : '0',
			'boxSizing' : 'border-box'
		});

		//autocomplete set to on after pressing send now button
		send.on('click', function(){
			//alert();
			//title.attr('autocomplete', 'on');
			title.removeAttr('autocomplete');
		});

		//setting status value
		$('#main li:nth-child(6)').css('display','none');

		draft.on('click', function(){
			status.val(0);
		});
		send.on('click', function(){
			status.val(1);
		});

		//auto complete
		title.attr('autocomplete','off');
		
		//bigger checkbox
 		checkbox.css({
			'transform' : 'scale(1.5)',
			'-webkit-transform' : 'scale(1.5)',
			'-ms-transform' : 'scale(1.5)'
		});

	});

	//wysiwyg plugin
	tinymce.init({
		selector: "textarea",
		theme: "modern",
		mode : "textareas",
		style_formats: [
						{title: 'Headers', items: [
							{title: 'Header 1', format: 'h1'},
							{title: 'Header 2', format: 'h2'},
							{title: 'Header 3', format: 'h3'},
							{title: 'Header 4', format: 'h4'},
							{title: 'Header 5', format: 'h5'},
							{title: 'Header 6', format: 'h6'}
						]},

						{title: 'Font Sizes', items: [
							{title: 'Tiny text', inline: 'span', styles: {fontSize: '10px'}},
							{title: 'Small text', inline: 'span', styles: {fontSize: '13px'}},
							{title: 'Normal text', inline: 'span', styles: {fontSize: '15px'}},
							{title: 'Big text', inline: 'span', styles: {fontSize: '18px'}},
							{title: 'Huge text', inline: 'span', styles: {fontSize: '22px'}}
						]},

						{title: 'Inline', items: [
							{title: 'Bold', icon: 'bold', format: 'bold'},
							{title: 'Italic', icon: 'italic', format: 'italic'},
							{title: 'Underline', icon: 'underline', format: 'underline'},
							{title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough'},
							{title: 'Superscript', icon: 'superscript', format: 'superscript'},
							{title: 'Subscript', icon: 'subscript', format: 'subscript'},
							{title: 'Code', icon: 'code', format: 'code'}
						]},

						{title: 'Blocks', items: [
							{title: 'Paragraph', format: 'p'},
							{title: 'Blockquote', format: 'blockquote'},
							{title: 'Div', format: 'div'},
							{title: 'Pre', format: 'pre'}
						]},

						{title: 'Alignment', items: [
							{title: 'Left', icon: 'alignleft', format: 'alignleft'},
							{title: 'Center', icon: 'aligncenter', format: 'aligncenter'},
							{title: 'Right', icon: 'alignright', format: 'alignright'},
							{title: 'Justify', icon: 'alignjustify', format: 'alignjustify'}
						]}
		],
		plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table directionality",
			"emoticons  paste textcolor colorpicker textpattern spellchecker"
		],
		theme_advanced_buttons3_add : "spellchecker",
		spellchecker_languages : "+English=en,Swedish=sv",
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		image_advtab: true,
		templates: [
			{title: 'Test template 1', content: 'Test 1'},
	 		{title: 'Test template 2', content: 'Test 2'}
		]
	});
</script>
