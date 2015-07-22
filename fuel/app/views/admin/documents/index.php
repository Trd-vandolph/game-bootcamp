<div id="contents-wrap">
	<div id="main">
		<h3>Contents</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>File (PDF only)</h4>
						<div>
							<? if(Input::get("e", 0) == 1){ ?>
								<p class="error">Upload failed. Please check file extension.</p>
							<? }elseif(Input::get("e", 0) == 2){?>
								<p class="error">Upload failed. Please assign document's usage.</p>	
							<?} ?>
							<input name="file" type="file" required>
						</div>
					</li>
					<li>
						<h4>Document For</h4>
						<div>
							<select name="doc_type">
								<option value="0">Ordinary Use</option>
								<option value="2">Online Course Information</option>
								<option value="1">Grameen Course Information</option>
							</select>
						</div>
					</li>
				</ul>
			<p class="button-area">
				<button class="button" href="">Upload  <i class="fa fa-upload"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
		<h3>Ordinary Use</h3>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>Uploaded at</th>
				<th>File name</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? if($documents != null): ?>
				<? foreach($documents as $document): ?>
				<tr id="document_<? echo $document->id; ?>">
					<th class="number"><? echo $document->id; ?></th>
					<td class="date-width"><? echo date("M d, Y. H:i:s", $document->created_at); ?></td>
					<td>
						<?php if(Uri::base() == "http://olivecode.com/" OR Uri::base() == "http://www.olivecode.com/"): ?>
							<? echo Html::anchor("http://www.olivecode.com/contents/{$document->path}", "$document->path", ["target" => "_blank"]); ?>
						<?php elseif(Uri::base() == "http://olivecode-devsite.zz.mu/" OR Uri::base() == "http://www.olivecode-devsite.zz.mu/"): ?>
							<? echo Html::anchor("http://www.olivecode-devsite.zz.mu/contents/{$document->path}", "$document->path", ["target" => "_blank"]); ?>
						<?php else: ?>
							<? echo Html::anchor("contents/{$document->path}", "$document->path", ["target" => "_blank"]); ?>
						<?php endif; ?>
					</td>
					<td class="del-width"><button class="button gray right" onclick="deleteDocument(<? echo $document->id; ?>)"><i class="fa fa-times"></i> Delete</button></td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<h3>Home Course Information</h3>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>Uploaded at</th>
				<th>File name</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? if($online != null): ?>
				<? foreach($online as $onlines): ?>
				<tr id="document_<? echo $onlines->id; ?>">
					<th class="number"><? echo $onlines->id; ?></th>
					<td class="date-width"><? echo date("M d, Y. H:i:s", $onlines->created_at); ?></td>
					<td>
						<?php if(Uri::base() == "http://olivecode.com/" OR Uri::base() == "http://www.olivecode.com/"): ?>
							<? echo Html::anchor("http://www.olivecode.com/contents/{$onlines->path}", "$onlines->path", ["target" => "_blank"]); ?>
						<?php elseif(Uri::base() == "http://olivecode-devsite.zz.mu/" OR Uri::base() == "http://www.olivecode-devsite.zz.mu/"): ?>
							<? echo Html::anchor("http://www.olivecode-devsite.zz.mu/contents/{$onlines->path}", "$onlines->path", ["target" => "_blank"]); ?>
						<?php else: ?>
							<? echo Html::anchor("contents/{$onlines->path}", "$onlines->path", ["target" => "_blank"]); ?>
						<?php endif; ?>
					</td>
					<td class="del-width"><button class="button gray right" onclick="deleteDocument(<? echo $onlines->id; ?>)"><i
								class="fa fa-times"></i>
							Delete</button></td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<h3>Grameen Course Information</h3>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>Uploaded at</th>
				<th>File name</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? if($grameen != null): ?>
				<? foreach($grameen as $grameens): ?>
				<tr id="document_<? echo $grameens->id; ?>">
					<th class="number"><? echo $grameens->id; ?></th>
					<td class="date-width"><? echo date("M d, Y. H:i:s", $grameens->created_at); ?></td>
					<td>
						<?php if(Uri::base() == "http://olivecode.com/" OR Uri::base() == "http://www.olivecode.com/"): ?>
							<? echo Html::anchor("http://www.olivecode.com/contents/{$grameens->path}", "$grameens->path", ["target" => "_blank"]); ?>
						<?php elseif(Uri::base() == "http://olivecode-devsite.zz.mu/" OR Uri::base() == "http://www.olivecode-devsite.zz.mu/"): ?>
							<? echo Html::anchor("http://www.olivecode-devsite.zz.mu/contents/{$grameens->path}", "$grameens->path", ["target" => "_blank"]); ?>
						<?php else: ?>
							<? echo Html::anchor("contents/{$grameens->path}", "$grameens->path", ["target" => "_blank"]); ?>
						<?php endif; ?>
					</td>
					<td class="del-width"><button class="button gray right" onclick="deleteDocument(<? echo $grameens->id; ?>)"><i
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
	function deleteDocument(id){

		if(confirm('Do you want to delete the data?')){
			$.ajax({
				url: '/admin/api/deldocument.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#document_" + id).hide();
				}
			})
		}
	}
</script>
