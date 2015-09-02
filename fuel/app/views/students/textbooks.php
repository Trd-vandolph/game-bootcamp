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
	<? if($charge!=0):?>
		<? if(count($enchantJS) != 0): ?>
		<h3>enchant.js</h3>
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
			<? foreach($enchantJS as $content): ?>
				<?
				if($count_enchant < $content->number and $content->text_type_id == 1){
					break;
				}
				if($count_enchant + 1 < $content->number and $content->text_type_id == 0){
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
	<? endif;?>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>