<div id="contents-wrap">
	<div id="main">
		<? if(count($trial) != 0): ?>
			<h3>Trial</h3>
			<table class="table-base course0" width="100%" border="0" cellpadding="0" cellspacing="0" >
				<thead>
				<tr>
					<th>Lesson</th>
					<th>File name</th>
					<th>Type</th>
					<th class="date">Uploaded at</th>
				</tr>
				</thead>
				<tbody>
				<? foreach($trial as $content): ?>
					<tr id="content_<? echo $content->id; ?>">
						<td class="number"><?= $content->number; ?></td>
						<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
						<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
						<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
					</tr>
				<? endforeach; ?>
				</tbody>
			</table>
		<? endif; ?>
		<? if(count($basic_html5) != 0): ?>
		<h3>HTML5 and CSS3</h3>
		<table class="table-base course1" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Lesson</th>
				<th>File name</th>
				<th>Text Type</th>
				<th class="date">Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($basic_html5 as $content): ?>
				<tr id="content_<? echo $content->id; ?>">
					<td class="number"><?= $content->number; ?></td>
					<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
					<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
					<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? endif; ?>
		<? if(count($basic_javascript) != 0): ?>
		<h3>JavaScript</h3>
		<table class="table-base course2" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Lesson</th>
				<th>File name</th>
				<th>Text Type</th>
				<th>Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($basic_javascript as $content): ?>
				<tr id="content_<? echo $content->id; ?>">
					<td class="number"><?= $content->number; ?></td>
					<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
					<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
					<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? endif; ?>
		<? if(count($basic_php) != 0): ?>
		<h3>PHP</h3>
		<table class="table-base course3" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Lesson</th>
				<th>File name</th>
				<th>Text Type</th>
				<th>Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($basic_php as $content): ?>
				<tr id="content_<? echo $content->id; ?>">
					<td class="number"><?= $content->number; ?></td>
					<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
					<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
					<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? endif; ?>
		<? if(count($final_exam) != 0): ?>
		<h3>Final Exam</h3>
		<table class="table-base course4" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Exam For</th>
				<th>File name</th>
				<th>Text Type</th>
				<th>Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($final_exam as $content): ?>
				<tr id="content_<? echo $content->id; ?>">
					<td>
						<?
							$cs=$content->exam;
							for($i=0;$i<strlen($cs);$i++){
								$char = substr($cs,$i,1);
								if($char==0){
									echo "HTML/CSS";
									echo "<br>";
								}elseif($char==1){
									echo "JavaScript";
									echo "<br>";
								}elseif($char==2){
									echo "PHP";
									echo "<br>";
								}
							}
						?>
					</td>
					<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
					<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
					<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? endif; ?>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>