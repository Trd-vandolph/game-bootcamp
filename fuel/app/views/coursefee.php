<? 
if(Input::get('e', 0) == 4) {?>
	<input type="text" id="unfill" value="<?=Input::get('e', 0); ?>" hidden/>
<? } ?>
<section id="contents" class="fee">
  <h3>Home Course</h3>
  <ol class="lessonfee clearfix">
    <li>
    <div class="bordered-section home-cash">
      <h4>Cash</h4>
      <aside><img src="/assets/img/front/cash.png"></aside>
      <ul>
        <li>One time payment : BDT16,000 </li>
        <li>Installment payment : BDT4,000 x 4</li>
        <div id="anchor"><a class="how" href="/coursefee/cash/?g=1">How To Pay</a></div>
      </ul>
    </div>
    </li>
    <li>
    <div class="bordered-section home-remit">
      <h4>Remittance</h4>
      <aside><img src="/assets/img/front/remit.png"></aside>
      <ul>
	      <li>One time payment : BDT16,000 or US$200</li>
	      <li>Installment payment : BDT4,000 or US$50 x 4  </li>
	       <div id="anchor"><a class="how" href="/coursefee/remit/?g=2">How To Pay</a></div>
      </ul>
    </div>
    </li>
    <li>
    <div class="bordered-section home-credit">
    <? if(!Auth::check()) {
  			$redirectCredit = "/students/signin/?p=1&g=3";
  		}else {
  			$redirectCredit = "/students/courses/";
  		}
  	?>
      <h4>Credit Card</h4>
      <aside><img src="/assets/img/front/credit.png"></aside>
      <ul>
	      <li>One time payment : US$200</li>
	      <li>You have to sign up for PayPal before payment</li>
	       <div id="anchor"><a class="how" href="<?=$redirectCredit; ?>">Go to Payment</a></div>
      </ul>
    </div>
    </li>
  </ol>
  <h3>Grameen Course</h3>
    <ol class="lessonfee clearfix">
	    <li style="float: none; margin: auto;">
		    <div class="bordered-section grameen-cash">
		      <h4>Cash</h4>
			      <aside><img src="/assets/img/front/cash.png"></aside>
			      <ul>
			        <li>One time payment : BDT16,000 </li>
			        <li>Installment payment : BDT4,000 x 4</li>
			        <div id="anchor"><a class="how" href="/coursefee/cash/?g=4">How To Pay</a><div id="anchor">
			      </ul>
		    </div>
		</li>
	</ol>
  	<? if(!Auth::check()) {
  			$redirect = "/students/signin/?p=1&t=";
  		}else {
  			$redirect = "/students/payment/?type=";
  		}
  	?>
</section>
<script>
	$(function(){
		var border = $('.bordered-section');
		var borderHome = $('.home-cash');
		var borderRemit = $('.home-remit');
		var borderCredit = $('.home-credit');
		var borderCash = $('.grameen-cash');
		var error = $('#unfill').val();

		if(error == 4){
			alert("You need to provide all the required information asked before continuing. Thank You.");
			window.location = "/coursefee"
		}
		
		borderHome.mouseenter(function(){
			borderHome.css({
				'borderColor' : '#7aae2a' ,
				'borderRadius' : '10px',
				})
		});
		borderRemit.mouseenter(function(){
			borderRemit.css({
				'borderColor' : '#7aae2a' ,
				'borderRadius' : '10px',
				})
		});
		borderCredit.mouseenter(function(){
			borderCredit.css({
				'borderColor' : '#7aae2a' ,
				'borderRadius' : '10px',
				})
		});
		borderCash.mouseenter(function(){
			borderCash.css({
				'borderColor' : '#7aae2a' ,
				'borderRadius' : '10px',
				})
		});
		
		border.mouseleave(function(){
			border.css('borderColor','#f7f7f7')
		});
	});
</script>


