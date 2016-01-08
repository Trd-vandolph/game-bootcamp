	$("#main table tr:nth-child(2) td p").each(function(){
		<? foreach ($rss_1->entry as $item) {
				$t1 = (string) $item->title;
				$t2 = str_replace(array('&#39;',';',':'), array('_'), $t1);
				$title = str_replace(array(' '), array('-'), $t2);
				$summary = (string) $item->summary;
				$summary2 = explode("\n", $summary);
				$summary = $summary2[0];
				$calendar['event'] = array('title'=>$title,'summary'=>$summary);
				$old = array('Ene','Jan','Peb','Feb','Mar','Mar','Abr','Apr','May','May','Hun','Jun','Hul','Jul','Ago','Aug','Set','Sep','Okt','Oct','Nob','Nov','Dis','Dec');
				$new = array('01','01','02','02','03','03','04','04','05','05','06','06','07','07','08','08','09','09','10','10','11','11','12','12');
				$text = $calendar['event']['summary'];
				$newtext = str_replace($old, $new, $text);
				list($when, $dayWord, $dayNum, $month, $year) = explode(" ", $newtext);
				/*$remove_br = $dayNum . '-' . $month;*/ //online
				 $remove_br = $month . '-' . $dayNum ;  //local
				$ono_br = str_replace('<br>', '', $remove_br);
				$no_br = str_replace(',', '', $ono_br); ?>

				if($(this).text() == '<?= $no_br; ?>'){
					$("#main table tr:nth-child(2) td:contains('<?= $no_br; ?>')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='<?= $title; ?>'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: <?= str_replace(array('-','_'), array(' '), $title); ?></strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('<?= $no_br; ?>')").find('li a').attr('href','#<?= $title; ?>');
				}
		<? } ?>

		<? foreach ($rss_2->entry as $item) {
				$t1 = (string) $item->title;
				$t2 = str_replace(array('&#39;',';',':'), array('_'), $t1);
				$title = str_replace(array(' '), array('-'), $t2);
				$summary = (string) $item->summary;
				$summary2 = explode("\n", $summary);
				$summary = $summary2[0];
				$calendar['event'] = array('title'=>$title,'summary'=>$summary);
				$old = array('Ene','Jan','Peb','Feb','Mar','Mar','Abr','Apr','May','May','Hun','Jun','Hul','Jul','Ago','Aug','Set','Sep','Okt','Oct','Nob','Nov','Dis','Dec');
				$new = array('01','01','02','02','03','03','04','04','05','05','06','06','07','07','08','08','09','09','10','10','11','11','12','12');
				$text = $calendar['event']['summary'];
				$newtext = str_replace($old, $new, $text);
				list($when, $dayWord, $dayNum, $month, $year) = explode(" ", $newtext);
				/* $remove_br = $dayNum . '-' . $month; */ //dev site
				$remove_br = $month . '-' . $dayNum ; //local / real site
				$ono_br = str_replace('<br>', '', $remove_br);
				$no_br = str_replace(',', '', $ono_br);

				//changing Shab e-Barat 06-2 to 06-3 and removing USELESS Google Generated Holidays -.-
				$search = array('06-2','07-26','07-28','07-29','07-30','10-31','05-10');
				$replace = array('06-3','','','','','','');
				$result = str_replace($search, $replace, $no_br); ?>

				if($(this).text() == '<?= $result; ?>'){
					$("#main table tr:nth-child(2) td:contains('<?= $result; ?>')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='<?= $title; ?>'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: <?= str_replace(array('-','_'), array(' '), $title); ?></strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('<?= $result; ?>')").find('li a').attr('href','#<?= $title; ?>');
				}

				//adding Bank Holiday 07-1
				if($(this).text() == '07-1'){
					$("#main table tr:nth-child(2) td:contains('07-1')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Bank_Holiday'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Bank Holiday </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('07-1')").find('li a').attr('href','#Bank_Holiday');
				}

				//adding Eid ul-Adha Day 1 09-24
				if($(this).text() == '09-24'){
					$("#main table tr:nth-child(2) td:contains('09-24')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Eid_ul_Adha_Day_1'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Eid ul-Adha Day 1 </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('09-24')").find('li a').attr('href','#Eid_ul_Adha_Day_1');
				}

				//adding Eid ul-Adha Day 2 09-25
				if($(this).text() == '09-25'){
					$("#main table tr:nth-child(2) td:contains('09-25')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Eid_ul_Adha_Day_2'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Eid ul-Adha Day 2 </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('09-25')").find('li a').attr('href','#Eid_ul_Adha_Day_2');
				}

				//adding Durga Puja (Vijaya Dasami) 10-23
				if($(this).text() == '10-23'){
					$("#main table tr:nth-child(2) td:contains('10-23')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Durga'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Durga Puja (Vijaya Dasami) </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('10-23')").find('li a').attr('href','#Durga');
				}

				//adding Muharram (Ashura) 10-24
				if($(this).text() == '10-24'){
					$("#main table tr:nth-child(2) td:contains('10-24')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Muharram'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Muharram (Ashura) </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('10-24')").find('li a').attr('href','#Muharram');
				}

				//adding Christmas 12-25
				if($(this).text() == '12-25'){
					$("#main table tr:nth-child(2) td:contains('12-25')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Christmas'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Christmas </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('12-25')").find('li a').attr('href','#Christmas');
				}

				//adding Bank Holiday 12-31
				if($(this).text() == '12-31'){
					$("#main table tr:nth-child(2) td:contains('12-31')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Bank'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Bank Holiday </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('12-31')").find('li a').attr('href','#Bank');
				}

				//adding Bangla New Year's Day 04-14
				if($(this).text() == '07-4'){
					$("#main table tr:nth-child(2) td:contains('07-4')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='New_year'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Bangla New Year's Day </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('07-4')").find('li a').attr('href','#New_year');
				}
		<? } ?>