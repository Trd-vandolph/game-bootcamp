<div id="contents-wrap">
	<div id="main">
		<? if(count($documents) != 0): ?>
		<table class="table-base course2" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>File name</th>
				<th>Uploaded at</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($documents as $document): ?>
				<tr>
					<td><i class="fa fa-file-pdf-o"></i> <? echo Html::anchor("contents/{$document->path}", "$document->path", ["target" => "_blank"]); ?></td>
					<td><? echo date("M d, Y. H:i:s", $document->created_at); ?></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? endif; ?>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>