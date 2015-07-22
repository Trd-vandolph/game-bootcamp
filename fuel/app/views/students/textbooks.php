<div id="contents-wrap">
	<div id="main">
		<? if(count($trial) != 0): ?>
			<h3>Trial</h3>
			<?php
				$charge=$user->charge_html;
			?>
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
	<? if($charge!=0){ ?>
		<? if(count($basic_html5) != 0): ?>
		<h3>HTML/CSS</h3>
		<table class="table-base course1" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Lesson</th>
				<th>File name</th>
				<th>Type</th>
				<th class="date">Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($basic_html5 as $content): ?>
				<?
				if($count_html5 < $content->number and $content->text_type_id == 1){
					break;
				}
				if($count_html5 + 1 < $content->number and $content->text_type_id == 0){
					break;
				}
				?>
				<tr id="content_<? echo $content->id; ?>">
					<td class="number"><?= $content->number; ?></td>
					<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
					<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
					<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? endif;?>
		<? if(count($basic_javascript) != 0 and $done_html == count($count_text_html5)):?>
		<h3>JavaScript</h3>
		<table class="table-base course2" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Lesson</th>
				<th>File name</th>
				<th>Type</th>
				<th>Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($basic_javascript as $content): ?>
				<?
				if($count_javascript < $content->number and $content->text_type_id == 1){
					break;
				}
				if($count_javascript + 1 < $content->number and $content->text_type_id == 0){
					break;
				}
				?>
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
		<? if(count($basic_php) != 0 and $done_javascript == count($count_text_javascript)): ?>
		<h3>PHP</h3>
		<table class="table-base course3" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Lesson</th>
				<th>File name</th>
				<th>Type</th>
				<th>Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($basic_php as $content): ?>
				<?
				if($count_php < $content->number and $content->text_type_id == 1){
					break;
				}
				if($count_php + 1 < $content->number and $content->text_type_id == 0){
					echo "here";
					break;
				}
				?>
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
		<? if(count($final_exam) != 0 and $done_html == count($count_text_html5)): ?>
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
			<!-- [done] these static values will be replaced as soon as it will be implemented on the real site -->
			<!-- [done] it is static because I wanted to see the results -->
			<? foreach($final_exam as $content): ?>
			<?	
			if($done_html == count($count_text_html5) or $done_javascript == count($count_text_javascript) or $done_php == count($count_text_php)){
				$cs=$content->exam;
				$count_exam = strlen($cs);
				if($count_exam==1 and $cs == 0 and $done_html == count($count_text_html5)){ ?>
					<tr id="content_<? echo $content->id; ?>">
						<td>HTML/CSS</td>
						<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
						<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
						<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
					</tr>
			<? 	}elseif($count_exam==1 and $cs == 1 and $done_javascript == count($count_text_javascript)){?>
					<tr id="content_<? echo $content->id; ?>">
						<td>
						<? if($count_exam==1){echo "JavaScript"; } ?>
						<? if($count_exam==2){echo "HTML/CSS"."<br>"."JavaScript"; } ?>
						</td>
						<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
						<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
						<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
					</tr>
			<? 	}elseif($count_exam==2 and $cs == 01 and $done_javascript == count($count_text_javascript)){?>
					<tr id="content_<? echo $content->id; ?>">
						<td>
						<? if($count_exam==1){echo "JavaScript"; } ?>
						<? if($count_exam==2){echo "HTML/CSS"."<br>"."JavaScript"; } ?>
						</td>
						<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
						<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
						<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
					</tr>
			<?  }elseif($count_exam==1 and $cs == 2 and $done_php == count($count_text_php)){?>
					<tr id="content_<? echo $content->id; ?>">
					<td>PHP</td>
						<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$content->path}", "$content->path", ["target" => "_blank"]); ?></td>
						<td><?= Config::get("statics.content_text_types")[$content->text_type_id]; ?></td>
						<td><? echo date("M d, Y. H:i:s", $content->created_at); ?></td>
					</tr>
			<?	}
			}
			endforeach; ?>
			</tbody>
		</table>
		<? endif;
		} ?>
		
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>