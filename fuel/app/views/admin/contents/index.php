<div id="contents-wrap">
	<div id="main">
		<h3>Contents</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>Lesson</h4>
						<div>
							<select name="type" id="type">
								<option value="-1">Trial</option>
								<?
								$content_types = Config::get("statics.content_types", []);
								$i = 0;

								foreach($content_types as $content_type):?>
									<option value="<? echo $i++; ?>"><? echo $content_type; ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</li>
					<li>
						<h4>Text Type</h4>
						<div>
							</select>
							<select id="text_type" name="text_type">
								<?
								$content_text_types = Config::get("statics.content_text_types", []);
								$i = 0;

								foreach($content_text_types as $content_text_type):
									?>
									<option id="text_type_<? echo $i; ?>" value="<? echo $i++; ?>"><? echo $content_text_type; ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</li>
					<li id="lesson">
						<h4>Lesson number</h4>
						<div>
							<select name="number">
								<?

								for($i = 1; $i < 13; $i++):
									?>
									<option value="<?= $i; ?>"><?= $i; ?></option>
								<? endfor; ?>
							</select>
						</div>
					</li>
					<li id="exam">
						<h4>Exam For</h4>
						<div>
							<label><input type="checkbox" name="course[]" value="0"> enchant.js</label>
						</div>
					</li>
					<li>
						<h4>File (PDF only)</h4>
						<div>
							<? if(Input::get("e", 0) == 1): ?>
							<p class="error">Upload failed. Please check file extension.</p>
							<? elseif(Input::get("e", 0) == 2): ?>
							<p class="error">Upload failed. File already exists.</p>
							<? endif; ?>
							<input name="file" type="file" required>
							<input type="text" name="category" value="1" hidden>
						</div>
					</li>
				</ul>
			<p class="button-area">
				<button class="button" href="">Upload <i class="fa fa-upload"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
		<div>
			<div style="float: right; margin: 10px;">
				<form action="" method="get" id="search_form">
					<select name="search_type" onchange="$('#search_form').submit();">
						<option value="0">All</option>
						<? $i = 1; foreach($content_types as $content_type): ?>
							<option <? if(Input::get("search_type", 0) == $i) echo "selected" ?> value="<? echo $i++;
							?>"><?
							echo $content_type;
							?></option>
						<? endforeach; ?>
						?>
					</select>
				</form>
			</div>
		</div>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>Uploaded at</th>
				<th>File name</th>
				<th>Content</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? if($contents != null): ?>
				<? foreach($contents as $content): ?>
				<tr id="content_<? echo $content->id; ?>">
					<th class="number"><? echo $content->id; ?></th>
					<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
					<td><? echo $content->path; ?></td>
					<td>
					<script>
					$(function(){
						var ttype = $('#type_<? echo $content->id ?>');
						var ttextType = $('#text_type_<? echo $content->id ?>');
						var caption = $('#caption_<? echo $content->id ?>');
						var exam = $('#exam_<? echo $content->id ?>');
						var c_exam = $('#exam_caption_<? echo $content->id ?>');
						var lesNo = $('#lesNo_<? echo $content->id ?>');
						var examOpt = $('#exam_option_<? echo $content->id ?>');
						var idOpt = $('#id_option_<? echo $content->id ?>');

						$('#type_<? echo $content->id ?> > option:nth-child(4)').css('display','none');
						if (ttype.val() == 3) {
							ttextType.css('display','none');
							caption.css('display','flex');
							lesNo.css('display','none');
							exam.css('display','flex');
							c_exam.css('display','flex');
							examOpt.css('display','flex');
						}else{
							ttextType.css('display','flex');
							caption.css('display','none');
							lesNo.css('display','block');
							exam.css('display','none');
							c_exam.css('display','none');
							examOpt.css('display','none');
						}

						ttype.on("change", function(){
							if (ttype.val() == 3) {
								exam.css('display','flex');
								c_exam.css('display','flex');
								lesNo.css('display','none');
								examOpt.css('display','flex');
							}else{
								exam.css('display','none');
								c_exam.css('display','none');
								lesNo.css('display','flex');
								examOpt.css('display','none');
								idOpt.attr('selected','selected');
							}
						});
					});
					</script>
					<? if(strlen($content->exam)>0){$f_exam="disabled"; }else{$f_exam="";} ?>
					<select id="type_<? echo $content->id;?>" onchange="changeContentType(<? echo $content->id;
					?>)">
							<option value="-1">Trial</option>
							<? $i = 0; foreach($content_types as $content_type): ?>
							<? if($content->type_id != 3){ ?>
							<option <? if($content->type_id == $i){ echo "selected";}if($i == 3){echo ""; } ?>  value="<? echo $i++; ?>"><? echo $content_type; ?></option>
							<? }else{ ?>
							<option <? if($content->type_id == $i){ echo "selected";} ?>  value="<? echo $i++;?>"><? echo $content_type; ?></option>
							 <? }endforeach; ?>

					</select>
					<br>
					<form action="" method="post" id="text_type_<? echo $content->id; ?>">
						<input type="hidden" name="t_id" value="<? echo $content->id; ?>">
						<select
						name="text_type_id" id="text_type_<? echo $content->id; ?>" onchange="$('#text_type_<? echo $content->id; ?>').submit();">
							<? $i = 0; foreach($content_text_types as $content_text_type): ?>
								<? if($content_text_type=="Exam"){ ?>
									<option id="exam_option_<? echo $content->id; ?>" <? if($content->text_type_id == $i) echo "selected" ?>  value="<? echo $i++;
									?>"><? echo $content_text_type; ?></option>
								<? }elseif($content_text_type=="Text"){?>
									<option id="id_option_<? echo $content->id; ?>" <? if($content->text_type_id == $i) echo "selected" ?>  value="<? echo $i++;
									?>"><? echo $content_text_type; ?></option>
								<?php }else{?>
								 	<option <? if($content->text_type_id == $i) echo "selected" ?>  value="<? echo $i++;
									?>"><? echo $content_text_type; ?></option>
								<?php }endforeach; ?>
						</select>
					</form>
					<input id="caption_<? echo $content->id ?>" value=" Exam" readonly style="width: 91px;">
						<li>
							<b id="exam_caption_<? echo $content->id; ?>">Exam For:</b>
							<form action="" method="post" id="exam_<? echo $content->id; ?>">
								<input type="hidden" name="e_id" value="<? echo $content->id; ?>">
								<? 	$cs = $content->exam;
									$strlen = strlen($cs);
									$chars = str_split($cs);
									?>
										<label><input id="html_<? echo $content->id; ?>" type="checkbox" name="course[]" value="0"
											<? foreach($chars as $char){
													if($strlen>0){
														if($char==0){
															echo "checked";
														} }}?>> HTML/CSS</label>
										<label><input id="js_<? echo $content->id; ?>" type="checkbox" name="course[]" value="1"
											<? foreach($chars as $char){
												if($strlen>0){
														if($char==1){
															echo "checked";
														} }}?>> JavaScript</label>
										<!-- <label><input id="php_<? //echo $content->id; ?>" type="checkbox" name="course[]" value="2"
											<?// foreach($chars as $char){
// 												if($strlen>0){
// 														if($char==2){
// 															echo "checked";
//														}} }?>> PHP</label> -->
								<input hidden="hidden" type="text" id="course_val_<? echo $content->id; ?>" name="course_val">
								<script>
									if($('#html_<? echo $content->id; ?>').is(':checked')){
										var html="0";
									}else{
										var html="";
									}
									if($('#js_<? echo $content->id; ?>').is(':checked')){
										var js="1";
									}else{
										var js="";
									}
									if($('#php_<? echo $content->id; ?>').is(':checked')){
										var php="2";
									}else{
										var php="";
									}

									var course_val=html+js+php;
									$("#course_val_<? echo $content->id; ?>").attr("value",course_val);

									$(document).ready(function(){
									    $("#html_<? echo $content->id; ?>").on("click", function(){
									        if($('#html_<? echo $content->id; ?>').is(':checked')){
												var html="0";
											}else{
												var html="";
											}
											if($('#js_<? echo $content->id; ?>').is(':checked')){
												var js="1";
											}else{
												var js="";
											}
											if($('#php_<? echo $content->id; ?>').is(':checked')){
												var php="2";
											}else{
												var php="";
											}

											var course_val=html+js+php;
											$("#course_val_<? echo $content->id; ?>").attr("value",course_val);
											$('#exam_<? echo $content->id; ?>').submit();
									    });
									    $("#js_<? echo $content->id; ?>").on("click", function(){
									        if($('#html_<? echo $content->id; ?>').is(':checked')){
												var html="0";
											}else{
												var html="";
											}
											if($('#js_<? echo $content->id; ?>').is(':checked')){
												var js="1";
											}else{
												var js="";
											}
											if($('#php_<? echo $content->id; ?>').is(':checked')){
												var php="2";
											}else{
												var php="";
											}

											var course_val=html+js+php;
											$("#course_val_<? echo $content->id; ?>").attr("value",course_val);
											$('#exam_<? echo $content->id; ?>').submit();
									    });
									    $("#php_<? echo $content->id; ?>").on("click", function(){
									        if($('#html_<? echo $content->id; ?>').is(':checked')){
												var html="0";
											}else{
												var html="";
											}
											if($('#js_<? echo $content->id; ?>').is(':checked')){
												var js="1";
											}else{
												var js="";
											}
											if($('#php_<? echo $content->id; ?>').is(':checked')){
												var php="2";

											}else{
												var php="";
											}

											var course_val=html+js+php;
											$("#course_val_<? echo $content->id; ?>").attr("value",course_val);
											$('#exam_<? echo $content->id; ?>').submit();
									    });
									});
								</script>
								</form>
								<div id="lesNo_<? echo $content->id; ?>">
								<form action="" method="post" id="number_<? echo $content->id; ?>">
									<input type="hidden" name="n_id" value="<? echo $content->id; ?>">
										<select name="number"  onchange="$('#number_<? echo $content->id; ?>').submit();">
										<? for($i = 1; $i < 13; $i++): ?>
											<option <? if($content->number == $i) echo "selected" ?> value="<?= $i; ?>"><?= $i; ?></option>
										<? endfor; ?>
										</select>
								</form>
								</div>
					</td>
					<td><button class="button gray right" onclick="deleteContent(<? echo $content->id; ?>)"><i
								class="fa fa-times"></i>
							Delete</button></td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<? echo $pager ?>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>
	$(function() {
		//out side
		var type = $('#type');
		var textType = $('#text_type');
		var textTypeSelect = $('#text_type_2');
		var lesson = $('#lesson');
		var exam = $('#exam');

		$('#type > option:nth-child(4)').css('display','none');

		type.val(0);

		if (type.val() == 3) {
			lesson.css('display','none');
			exam.css('display','flex');
		}else{
			lesson.css('display','flex');
			exam.css('display','none');
			textTypeSelect.css('display','none');
		}

		type.on('change', function(){
			if (type.val() == 3) {
				textType.attr('disabled','disabled');
				textTypeSelect.attr('selected','selected');
				lesson.css('display','none');
				exam.css('display','flex');
			}else{
				lesson.css('display','flex');
				exam.css('display','none');
				textType.removeAttr('disabled');
				textTypeSelect.removeAttr('selected');
				textTypeSelect.css('display','none');
			}
		});
	});
	function deleteContent(id){

		if(confirm('Do you want to delete the data?')){
			$.ajax({
				url: '/admin/api/delcontent.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#content_" + id).hide();
				}
			})
		}
	}
	function changeContentType(id){

		$.ajax({
			url: '/admin/api/changecontenttype.json',
			type: 'POST',
			data: {
				"id": id,
				"type_id": $("#type_" + id).val()
			},

			complete: function(){

			},
			success: function(res) {
			}
		});

		if($("#type_" + id).val()==3){
			$("#text_type_" + id).css('display','none')
			$("#caption_" + id).css('display','flex')

		}else{
			$("#text_type_" + id).css('display','flex')
			$("#caption_" + id).css('display','none')
		}
	}

</script>
