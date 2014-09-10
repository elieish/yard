<?php

	# Include Required Scripts
	include_once(dirname(__FILE__). "/backend/framework/include.php");
	Application::include_models();
	Application::include_helpers();
	Application::db_connect();

	function landscape_report_header($pdf, $heading)
	{
		$pdf->setColor(0,0,0);
		$pdf->ezsetdy(-10);
		
		$pdf->ezsetdy(1);
		
		//$company						= $this->sys_model->row_array("company");
		
		$pdf->addText(50,560,15,"YARD");
		//$pdf->addJpegFromFile('./assets/admin/images/as-logo.jpg',$pdf->ez['leftMargin'] + 20 + 0, $pdf->y + $pdf->getFontHeight($pdf->ez['fontSize']) - 5 - 65,400);
		/*$pdf->addText(50,545,10,"Reg: ".$company['reg_no']);
		$pdf->addText(50,530,10,"Vat: ".$company['vat_no']);*/
		
		$pdf->addText(550,560,15,$heading);
		/*$pdf->addText(550,545,9,"Tel: ".$company['contact_no']." , Fax: ".$company['fax']);
		$pdf->addText(550,530,9,"Email: ".$company['email']);
		$pdf->addText(550,515,9,"Website: ".$company['website']);*/
		
		$pdf->setColor(0,0,0);
		$pdf->setLineStyle(1.5);
		$pdf->line(50,723,550,723);
	}
	
	function view_report()
	{
		
				
		#Global Variables
		global $_db;
		
		# Get Data
		//var_dump($query); die();
		$result['heading'] = "Members";
		
		$pdf = new Cezpdf('a4','landscape');
		landscape_report_header($pdf, $result['heading']);
		$pdf->rectangle(30,480,770,100);
		$pdf->ezsetdy(-100);
		/*if($invoice_no)
			$pdf->ezText("<b>REPORT FOR INVOICE No. ".strtoupper($invoice_no)."</b>",20,array('justification'=>'center'));
		elseif($month)
			$pdf->ezText("<b>MONTH REPORT - ".strtoupper($month)." ".strtoupper($year)."</b>",20,array('justification'=>'center'));
		else
			$pdf->ezText("<b>YEAR REPORT - ".strtoupper($year)."</b>",20,array('justification'=>'center'));
		*/
		$pdf->ezsetdy(-10);
	
		$pdf->ezsetdy(-5);
		$pdf->selectFont('./pdffonts/Helvetica.afm');
		
		/*$monthname             					= ($month == "0")? "0" : date("Y-m-d",strtotime("15 $month 1986"));
		$overall_total							= $this->report_model->total($year,$monthname,$invoice_no);
		$overall_sub_total						= $overall_total - ($overall_total*0.14);
		$overall_vat_amount						= ($overall_sub_total*0.14);*/
		//$total_desc_perc						= $this->report_model->total_discount_perc($year,$month,$invoice_no);
		
		//"<b>Total Price</b> : R".number_format($total_value,2). " || <b>Overall VAT</b> : R".number_format($overall_vat,2);
		
		
		
		/*foreach ($data as $index => $arr_value) {
			foreach ($result['columns'] as $key => $col) {
				$value = $arr_value[$col['field']];
				//if(in_array($key, $result['columns'][0]['field'])){
					$col = ucwords(str_replace("_", " ", $col['field']));
					$rdata[$index][$col] = $value;
				//}
			}
		}*/
		
		/*$header = "";
			foreach ($result['totals'] as $key => $total) {
				if(empty($header))
					$header .= "TOTALS: ";
				$header .= ucwords(str_replace("_", " ", $key)).": R".number_format($total,2)." | ";
			}*/
		
		$query		="	SELECT
							`created_at` as 'Registration Date',
							`membership_no` as 'Membership No.',
							(SELECT `title` FROM `titles` WHERE `uid` = `members`.`title_id`) as 'Title',
							`name` as 'Name',
							`surname` as 'Surname',	
							`cell` as 'Cell', 
							`provinces`.`province` as 'Province'
						FROM
								`members` JOIN `provinces` ON `provinces`.`uid` = `members`.`province_id` 
						WHERE
								`members`.`active` = 1
								AND `members`.`paid` = 1";
											
											
		$data		= $_db->fetch_array($query);
		//$data		= array(array('key'=>'value'));
		//var_dump(array($data));die();
		
		$pdf->ezTable($data,"","",array('width'=>770));
		
		//$pdf->ezTable($data,"","<b>Sub Total</b> : R".number_format(100,2). " || <b>14% VAT Amount</b> : R".number_format(80,2). " || <b>Total</b> : R".number_format(180,2),array('fontSize'=>12,'titleFontSize'=>15,'width'=>800,'shaded'=>1,'textCol'=>1,1,1));
	
		$dat="Report Generated: ".date("d-M-Y h:i a");
		$pdf->addText(660,30,8,$dat);
		$pdf->ezStream();
	}

	function view_member_report($member_id)
	{
		
				
		#Global Variables
		global $_db;
		
		# Get Data
		//var_dump($query); die();
		$result['heading'] = "Members";
		
		$pdf = new Cezpdf('a4','landscape');
		landscape_report_header($pdf, $result['heading']);
		$pdf->rectangle(30,480,770,100);
		$pdf->ezsetdy(-100);
		
		$pdf->ezsetdy(-10);
	
		$pdf->ezsetdy(-5);
		$pdf->selectFont('./pdffonts/Helvetica.afm');
		
		$query		="	SELECT
							`created_at` as 'Registration Date',
							`membership_no` as 'Membership No.',
							(SELECT `title` FROM `titles` WHERE `uid` = `members`.`title_id`) as 'Title',
							`name` as 'Name',
							`surname` as 'Surname',	
							`cell` as 'Cell', 
							`provinces`.`province` as 'Province'
						FROM
								`members` JOIN `provinces` ON `provinces`.`uid` = `members`.`province_id` 
						WHERE
								`members`.`active` = 1
								AND `members`.`uid` = {$member_id}";
											
											
		$data		= $_db->fetch_array($query);
		
		foreach ($data[0] as $key => $value) {
			$pdf->ezText("<b>".$key."</b> : ".$value,20,array('justification'=>'left'));
		}
		
		//$pdf->ezTable($data,"","",array('width'=>770));
		
		
		$dat="Report Generated: ".date("d-M-Y h:i a");
		$pdf->addText(660,30,8,$dat);
		$pdf->ezStream();
	}

	if(isset($_GET['member_id'])){
		view_member_report($_GET['member_id']);
	}
	else{
		view_report();
	}

?>