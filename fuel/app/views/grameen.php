<section id="contents" class="course">
<p class="sub-catch">You don't need PC and Internet Access at home.<br>Grameen Communications and OliveCode jointly offer you online programming course in a training center in Mirpur, Dhaka.<br>You can take online lessons in the center at your convenient time.</p>
  <p class="grameen_banner">
  	<img class="sideimg" src="assets/img/front/grameen.jpg" alt="grameen-building" style="width: 270px;box-shadow: 10px 10px 10px; border-radius: 5px; ">
  	<img class="centerimg" src="assets/img/front/grameen_banner2.png" alt="grameen-banner" style="padding: 0 10px; position:relative; top: -60px;">
  	<img class="sideimg" src="assets/img/front/center.JPG" alt="training-center" style="width: 270px;height: 202px;box-shadow: 10px 10px 10px; border-radius: 5px; ">
  </p>
  <div class="sub-catch">
    <ul>
        <li>You will take online lessons at training room of Grameen Communications located at Grameen Bank Bhaban (9th floor), Mirpur-2, Dhaka - 1216. </li> 
        <li>The center has PC and stable Internet access.</li> 
        <li>You can take online private lessons and use the center for your self-study whenever you like from 10:00 to 18:00 Sunday through Thursday.</li> 
        <li>Average length of the course is 4 months.</li> 
        <li>Lesson fee is BDT 16,000. Installment payment is available (BDT 4,000 x 4 times). </li> 
        <li>We guarantee 2-month internship and Job opportunity after the course.</li> 
        <li>Monthly salary during internship is BDT 10,000.</li>
        <li>First monthly salary after employment is BDT 15,000 - 20,000, which depends on your programming skills at the end of internship.</li>
        <? if(!Auth::check()):?>
        <li>If you like to know more about the course, please register your profile by clicking the button below.</li>
        <li>If you already have an account, you can just go to Settings and change your "Place of Learning" to "Grameen course".</li>
    	<? endif; ?>
    </ul>
  </div>
</section>
<section id="signup-button">
	<p class="catch">Grameen Course Information</p>
	<? if(!Auth::check()):?>
		<p>Register your profile if you like to know further information<br>about learning at Grameen Communications. We will send you<br>Course Information package online upon your registration.</p>
		<a class="button" href="/students/signup/?g=1">Register Profile</a>
	<? else: ?>
		<p>Interested in Grameen Course? You can just go to Settings and<br>change your "Place of Learning" to "Grameen course" or click <br>the button below (link to Settings).</p>
		<a class="button" href="/students/setting">Register Profile</a>
	<? endif; ?>
</section>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	$(function(){
		
		$('section:eq(2)').css('display','none');
		$('.button').css('background','#7AAE2A');
		
	});
</script>
