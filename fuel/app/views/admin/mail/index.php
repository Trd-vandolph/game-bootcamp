<div id="contents-wrap">
	<div id="main">
		<h3>Mail Management</h3>
		<p class="link-more"><? echo Html::anchor("admin/mail/edit/", '<i class="fa fa-plus-circle"></i> Create Mail'); ?></p>
		<section id="draft">
			<table class="list-base" width="100%" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<th>Mail Title</th>
					<th>Date Sent</th>
					<th></th>
				</thead>
				<? foreach($mail as $new): ?>
					<? if ($new->deleted_at == 0): ?>
						<tr id="mail_<?php echo $new->id?>">
							<td>
								<?php if($new->status == 0): ?>
									<a href="/admin/mail/edit/<?= $new->id; ?>" title="View Email Message">
										<strong><?= $new->title; ?></strong>
									</a>
								<?php else: ?>
									<a href="/admin/mail/message/<?= $new->id; ?>" title="View Email Message">
										<strong><?= $new->title; ?></strong>
									</a>
								<?php endif; ?>
							</td>
							<td>
								<?php if($new->updated_at == NULL && $new->status == 0):?>
									<strong><?php echo 'Not yet Sent'; ?></strong>
								<?php elseif($new->updated_at != NULL && $new->status == 0): ?>
									<strong><?php echo 'Not yet Sent'; ?></strong>
								<?php elseif($new->updated_at == NULL && $new->status == 1): ?>
									<strong><?php echo date('H:i:s l d, F Y',$new->created_at); ?></strong>
								<?php elseif($new->updated_at != NULL && $new->status == 1): ?>
									<strong><?php echo date('H:i:s l d, F Y',$new->updated_at); ?></strong>
								<?php endif; ?>
							</td>
							<td>
								<button class="button gray right" onclick="deleteMail(<? echo $new->id; ?>)">
									<i class="fa fa-times"></i> Remove from List
								</button>
								<?php if($new->status == 0): ?>
									<? echo Html::anchor("admin/mail/edit/{$new->id}", '<i class="fa fa-cog"></i> Edit Draft', [  "class" => "button green right draft-button"]); ?>
								<?php endif; ?>
							</td>
						</tr>
					<? endif; ?>
				<? endforeach; ?>
			</table>
			<? echo $pager ?>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>
	//remove from list
	function deleteMail(id){

		if(confirm('Are you sure you want to remove this email from the list?')){
			$.ajax({
				url: '/admin/api/delmail.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#mail_" + id).hide();
				}
			})
		}
	}

 	$(function(){
 	 	var t = $(this);
 		var tableBase = $('table.list-base');
 		var a = $('table.list-base tr a');
 		var th = $('table th');
 		var th1 = $('table.list-base th:nth-child(1)');
 		var th2 = $('table.list-base th:nth-child(2)');
 		var th3 = $('table.list-base th:nth-child(3)');
 		var th4 = $('table.list-base th:nth-child(4)');
 		var editDraft = $('.draft-button');

 		//responsive table
 		tableBase.css('width','100%');
 		a.on('mouseover', function(){
 			t.css('textDecoration','underline');
 	 	});

 		//adding table head titles
 		th.css({
	 		'background' : '#E41D48',
	 		'color' : '#fff',
	 		'border-right' : 'none',
	 		'text-align' : 'left',
	 		'padding' : '15px 20px'
 	 	});
 		th1.css('border-radius' , '3px 0 0 3px');
 		th2.css('padding','15px 0');
 		th3.add(th4).css('border-radius' , '0 3px 3px 0');
 		editDraft.css('padding','10px 30px');
		$('#draft tr td:eq(0)').css('width','34%');
	});
</script>
