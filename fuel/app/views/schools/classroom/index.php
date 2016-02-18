<div id="contents-wrap">
	<div id="main">
	<h3>Classroom</h3>
		<table class="table-base course2" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Classroom Name</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($documents as $document): ?>
				<tr>
					<td></td>
					<td></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
	</div>
	<? echo View::forge("schools/_menu")->set($this->get()); ?>
</div>