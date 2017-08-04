<?php
@session_start();
require_once('include/connect.php');
require_once('mpdf/mpdf.php');
ob_start();

$bill_ID = $_GET['id'];
$query = "SELECT * FROM bills JOIN room ON bills.room_id =  room.room_id
          WHERE bills.bill_id ='$bill_ID'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$accs = explode(",",$row['room_accessories']);

$queryDorm = "SELECT * FROM dormitory WHERE dorm_id = '$row[dorm_id]'";
$resultDorm = mysqli_query($conn,$queryDorm);
$rowDorm = mysqli_fetch_array($resultDorm);

function DateThai($strDate,$mode)
	{
    $strDay= date("j",strtotime($strDate));
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
    if($mode==1){
		return "$strMonthThai $strYear";
    }else{
    return "$strDay $strMonthThai $strYear";
    }
	}
function convert($number){
  $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
  $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
  $number = str_replace(",","",$number);
  $number = str_replace(" ","",$number);
  $number = str_replace("บาท","",$number);
  $number = explode(".",$number);
  if(sizeof($number)>2){
  return 'ทศนิยมหลายตัวนะจ๊ะ';
  exit;
  }
  $strlen = strlen($number[0]);
  $convert = '';
  for($i=0;$i<$strlen;$i++){
  	$n = substr($number[0], $i,1);
  	if($n!=0){
  		if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
  		elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
  		elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
  		else{ $convert .= $txtnum1[$n]; }
  		$convert .= $txtnum2[$strlen-$i-1];
  	}
  }

  $convert .= 'บาท';
  if($number[1]=='0' OR $number[1]=='00' OR
  $number[1]==''){
  $convert .= 'ถ้วน';
  }else{
  $strlen = strlen($number[1]);
  for($i=0;$i<$strlen;$i++){
  $n = substr($number[1], $i,1);
  	if($n!=0){
  	if($i==($strlen-1) AND $n==1){$convert
  	.= 'เอ็ด';}
  	elseif($i==($strlen-2) AND
  	$n==2){$convert .= 'ยี่';}
  	elseif($i==($strlen-2) AND
  	$n==1){$convert .= '';}
  	else{ $convert .= $txtnum1[$n];}
  	$convert .= $txtnum2[$strlen-$i-1];
  	}
  }
  $convert .= 'สตางค์';
  }
  return $convert;
  }
//ค้นหามิเตอร์เดือนที่แล้ว
$m = date("Y-m", strtotime($row['bill_month'] . " last month"));
$queryMeter = "SELECT * FROM bills WHERE bill_month = '$m' AND room_id = '$row[room_id]'";
$resultMeter = mysqli_query($conn,$queryMeter);
$rowMeter = mysqli_fetch_array($resultMeter);

if($row['mem_id'] != 0){
  //ค้นหารายละเอียดผู้เช่า
  $queryMember = "SELECT * FROM member JOIN room ON member.mem_id = room.mem_id WHERE room.room_id = '$row[room_id]'";
  $resultMember = mysqli_query($conn,$queryMember);
  $rowMember = mysqli_fetch_array($resultMember);
}else if($row['rent_id'] != 0){
  //ค้นหารายละเอียดผู้เช่า
  $queryRent = "SELECT * FROM renter JOIN room ON renter.rent_id = room.rent_id WHERE room.room_id = '$row[room_id]'";
  $resultRent = mysqli_query($conn,$queryRent);
  $rowRent = mysqli_fetch_array($resultRent);
}

//โหมดมิเตอร์น้ำ
$queryWaterTariff = "SELECT * FROM water_tariffs WHERE dorm_id = '$_SESSION[dormitory]'";
$resultWaterTariff = mysqli_query($conn,$queryWaterTariff);
$rowWaterTariff = mysqli_fetch_array($resultWaterTariff);

//โหมดมิเตอร์ไฟฟ้า
$queryElectricTariff = "SELECT * FROM electric_tariffs WHERE dorm_id = '$_SESSION[dormitory]'";
$resultElectricTariff = mysqli_query($conn,$queryElectricTariff);
$rowElectricTariff = mysqli_fetch_array($resultElectricTariff);

//ธนาคาร
$queryBank = "SELECT * from bank where dorm_id = $_SESSION[dormitory]";
$resultBank = mysqli_query($conn,$queryBank);

//ราคาอุปกรณ์ตกแต่ง
$arr = array();
$arrPrice = array();
$queryAccs = "SELECT * FROM accessories WHERE dorm_id ='$_SESSION[dormitory]'";
$resultAccs = mysqli_query($conn,$queryAccs);
while($rowAccs = mysqli_fetch_row($resultAccs)){
  array_push($arr,$rowAccs[1]);
  array_push($arrPrice,$rowAccs[2]);
}

$water = 0;
$unitWater = 0;
$sumWater = 0;
$electric = 0;
$unitElectric = 0;
$sumElectric = 0;
$sumAccs = 0;
$accsPrice = "";
$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td colspan="6" align="right">บิลประจำเดือน <?php echo DateThai($row['bill_month'],1) ?></td>
    </tr>
  <tr>
    <td colspan="6" align="center"><strong>ใบเสร็จ / ใบแจ้งค่าห้อง </strong></td>
  </tr>
  <tr>
    <td><strong><?php echo $rowDorm['dorm_name'] ?></strong></td>
    <td colspan="5" align="right"></td>
  </tr>
    <tr>
    <td>
      <?php echo $rowDorm['dorm_address'] ?><br />
      โทร <?php echo $rowDorm['dorm_tel'] ?>
    </td>
    <td colspan="5" align="right" style="vertical-align:top";>วันที่ออกบิล <?php echo DateThai(date("Y-m-d"),2) ?></td>
  </tr>
  <tr>
    <td>ชั้น <?php echo $row['room_class']; ?> ห้อง <?php echo $row['room_name'].'<br />'; ?>จำนวนผู้เข้าพัก <?php echo $row['room_guest'] ?> คน</td>
    <td colspan="5" align="right">ลูกค้า คุณ
      <?php
      if($row['mem_id'] != 0){
        echo $rowMember['mem_firstname'].' '.$rowMember['mem_lastname'].'<br />โทร : '.$rowMember['mem_tel'];
      }else{
        echo $rowRent['rent_firstname'].' '.$rowRent['rent_lastname'].'<br />โทร : '.$rowRent['rent_tel'];
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td><strong>รายการชำระเงิน (Description)</strong></td>
    <td colspan="5" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td align="center" width="50%">&nbsp;</td>
    <td align="center" width="10%">เลขก่อนหน้า</td>
    <td align="center" width="10%">เลขล่าสุด</td>
    <td align="center" width="10%">หน่วยละ</td>
    <td align="center" width="10%">หน่วยที่ใช้</td>
    <td align="right" width="10%">จำนวนเงิน</td>
  </tr>
  <!--ค่าเช่าห้อง-->
  <tr>
    <td>ค่าเช่าห้อง (Room rate)</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo number_format($row['room_price'],2); ?></td>
  </tr>
  <!--ค่าน้ำประปา-->
  <tr>
    <td>ค่าน้ำประปา (Water rate)
      </td>
    <td align="center">
      <?php
    if($row['bill_month'] == substr($row['room_lease'], 0, 7)){
      echo $water=$row['room_water'];
    }else{
      echo $water=$rowMeter['bill_water'];
    }
    ?>
    </td>
    <td align="center" ><?php echo $row['bill_water'];?></td>
    <td align="center"><?php if($rowWaterTariff['water_type']==3) echo $rowWaterTariff['water_price'] ?></td>
    <td align="center"><?php echo $unitWater=$row['bill_water']-$water ?></td>
    <td align="right"><?php
      if($rowWaterTariff['water_type']==1){
        echo number_format($sumWater = $rowWaterTariff['water_price'],2);
      }else if($rowWaterTariff['water_type']==2){
        echo number_format($sumWater = $rowWaterTariff['water_price'] * $row['room_guest'],2);
      }else {
        echo number_format($sumWater = $rowWaterTariff['water_price'] * $unitWater,2);
      }
      ?> </td>
  </tr>
  <!--ค่าไฟฟ้า-->
  <tr>
    <td>ค่าไฟฟ้า (Electrical rate)
      </td>
    <td align="center">
      <?php
    if($row['bill_month'] == substr($row['room_lease'], 0, 7)){
      echo $electric=$row['room_electric'];
    }else{
      echo $electric=$rowMeter['bill_electric'];
    }
    ?>
    </td>
    <td align="center" ><?php echo $row['bill_electric'];?></td>
    <td align="center"><?php if($rowElectricTariff['electric_type']==2) echo $rowElectricTariff['electric_price'] ?></td>
    <td align="center"><?php echo $unitElectric=$row['bill_electric']-$electric ?></td>
    <td align="right"><?php
      if($rowElectricTariff['electric_type']==1){
        echo number_format($sumElectric = $rowElectricTariff['electric_price'],2);
      }else {
        echo number_format($sumElectric = $rowElectricTariff['electric_price'] * $unitElectric,2);
      }
      ?></td>
  </tr>
  <tr>
    <td colspan="5">ค่าเช่าเฟอร์นิเจอร์ (<?php echo $row['room_accessories']; ?>) (
      <?php
      foreach (array_combine($arr, $arrPrice) as $value => $valuePrice) {
        if(in_array($value,$accs)){
          $accsPrice.=$valuePrice.' + ';
          $sumAccs+=$valuePrice;
        }
      }
      echo substr($accsPrice,0,strlen($accsPrice)-3);
      ?>
      )</td>
    <td align="right"><?php echo number_format($sumAccs,2); ?></td>
  </tr>
  <tr>
    <td colspan="5">ค่าอินเทอร์เน็ต (Internet rate)</td>
    <td align="right"><?php echo number_format($row['room_internet'],2)?></td>
  </tr>
  <tr>
    <td colspan="5">ค่าที่จอดรถ (Parking rate)</td>
    <td align="right"><?php echo number_format($row['room_parking'],2)?></td>
  </tr>
  <tr>
    <td colspan="3">ส่วนลด (Discount)</td>
    <td colspan="3" align="right"><?php echo number_format($row['room_discount'],2);?></td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td colspan="3"><strong>รวม (Total price)</strong></td>
    <td colspan="3" align="right"><?php $total = ($row['room_price'] + $sumWater + $sumElectric + $sumAccs + $row['room_internet']+ $row['room_parking']) - $row['room_discount']; echo number_format($total,2);?> บาท</td>
  </tr>
  <tr>
    <td align="right" colspan="6">(<?php echo convert($total); ?>)</td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td colspan="6">หมายเหตุ : กรุณาชำระค่าเช่าพร้อมค่าสาธารณูปโภคภายในวันที่ 1-5 ของทุกเดือน</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="6" align="center">
    <table width="100%"  cellspacing="0" cellpadding="5" style="border:solid 1px #aeaeae;">
      <tr>
        <td colspan="2" align="center" style="border:solid 1px #aeaeae;"><strong>ชำระเงินผ่านธนาคาร</strong></td>
      </tr>
    <?php while($rowBank = mysqli_fetch_array($resultBank)){?>
    <tr>
      <td align="left" style="border:solid 1px #aeaeae;" ><img src="images/img-bank/<?php echo $rowBank[5]; ?>" alt="profile" width="35px" height="35px"></td>
      <td style="vertical-align:middle;" style="border:solid 1px #aeaeae;"><?php echo $rowBank['bank_bank'].' สาขา '.$rowBank['bank_branch'].' ชื่อบัญชี '.$rowBank['bank_name'].' เลขที่บัญชี '.$rowBank['bank_number']; ?></td>
    </tr>
    <?php } ?>
  </table>
</td>
</tr>
  <tr>
    <td colspan="6" align="center">
      <table width="100%" border="0" cellpadding="0" cellspacing="20">
        <tr>
          <td align="center">
            ลงชื่อ ................................................ ผู้ชำระเงิน<br />
            ( ................................................ )
          </td>
          <td align="center">ลงชื่อ ................................................ ผู้รับเงิน<br />
            ( ................................................. )
          </td>
        </tr>
      </table>
  </td>
    </tr>
  <tr>
    <td colspan="6" align="center"><hr /></td>
  </tr>
</table>
    </body>
    </html>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    $pdf = new mPDF('th', 'A4', '0', 'THSaraban');
    $pdf->SetAutoFont();
    $pdf->SetDisplayMode('fullpage');
    $pdf->WriteHTML($html, 2);
    $pdf->Output();
    ?>
