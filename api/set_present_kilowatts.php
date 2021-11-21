<?php
$accnum=$_POST['account_id'];
$accstatus=$_POST['status'];
$present_kilowatts = $_POST['kilowatts'];
$previous_kilowatts = 0;
$account_type_id = $_POST['account_type_id'];
//$account_type_id = 1;
$counter = 1;
$day = date("j");
//$day = 1;
$lastday = date('t F, Y');
$month = date("F");
$currentmonth = date("F");
$year = date("Y");
$prevmonth = date('F', strtotime('-1 month'));
$prevyear = date("Y",strtotime("-1 year"));
$budgetstatus = "";
$lastmonthdate =date("t/m/Y", strtotime("last month"));
$cutoffdate =date("10/m/Y");
$duedate =date("3/m/Y");
$currentdate =date("d/m/Y");
include "../connection.php";

$sql = "SELECT * FROM user_account WHERE account_id = $accnum AND status = '$accstatus' ;";
$result = $conn -> query($sql);
while($row =$result -> fetch_assoc()){
  $tblStatus = $row['status'];
  $tblAccountNumber = $row['account_id'];
  if(($tblAccountNumber == $accnum) && ($tblStatus == $accstatus)){
    $query="INSERT INTO present_kilowatts_checker(`present_kilowatts`) VALUES ($present_kilowatts);";
    $result=$conn->query($query);
    $sqls = "SELECT * FROM bill_cycle WHERE account_id = $accnum AND month = '$month' AND year = '$year';";
    $results = $conn -> query($sqls);
    $num_rows = mysqli_num_rows($results);
    if($num_rows == 0){
      if($month == 'January'){
        $sqlprev = "SELECT * FROM bill_cycle WHERE account_id = $accnum AND month = '$prevmonth' AND year = '$prevyear';";
        $resultprev = $conn -> query($sqlprev);
        while($row =$resultprev -> fetch_assoc() ){
          $tblPresentKilowattsPrevMonth = $row['present_meter_reading'];
          $tblPreviousKilowattsPrevMonth = $row['previous_meter_reading'];
          $totalConsumptionPrevMonth = $tblPresentKilowattsPrevMonth -$tblPreviousKilowattsPrevMonth;
        }
      $total_present_kilowatts = $totalConsumptionPrevMonth + $present_kilowatts;
        $query="INSERT INTO `bill_cycle`(`account_id`, `previous_meter_reading`,`present_meter_reading`, `no_of_data`,`month`, `year`) VALUES ($accnum,$totalConsumptionPrevMonth, $total_present_kilowatts,$counter ,'$month', '$year');";
        $result=$conn->query($query);

      }
      else{
        $sqlprev = "SELECT * FROM bill_cycle WHERE account_id = $accnum AND month = '$prevmonth' AND year = '$year';";
        $resultprev = $conn -> query($sqlprev);
        while($row =$resultprev -> fetch_assoc() ){
          $tblPresentKilowattsPrevMonth = $row['present_meter_reading'];
          $tblPreviousKilowattsPrevMonth = $row['previous_meter_reading'];
          $totalConsumptionPrevMonth = $tblPresentKilowattsPrevMonth -$tblPreviousKilowattsPrevMonth;
        }
        $total_present_kilowatts = $totalConsumptionPrevMonth + $present_kilowatts;
        $query="INSERT INTO `bill_cycle`(`account_id`, `previous_meter_reading`,`present_meter_reading`, `no_of_data`,`month`, `year`) VALUES ($accnum,$totalConsumptionPrevMonth, $total_present_kilowatts,$counter ,'$month', '$year');";
        $result=$conn->query($query);
      }
    }elseif($num_rows >= 1){
      while($row =$results -> fetch_assoc() ){
        $tblCounter = $row['no_of_data'];
        $tblPresentKilowatts = $row['present_meter_reading'];
        $tblPreviousKilowatts = $row['previous_meter_reading'];
        $totalCounter = $tblCounter +1;
        $total_present_kilowatts = $tblPresentKilowatts+ $present_kilowatts;
        $totalConsumptionCurrentMonth = $total_present_kilowatts - $tblPreviousKilowatts;
      }
      $sqlpricetotal = "SELECT SUM(rate) AS 'Rate_TOTAL' FROM price_rates WHERE account_type_id = $account_type_id AND rate_status = 'new';";
      $resultpricetotal = $conn ->query($sqlpricetotal);
      while($row = $resultpricetotal->fetch_assoc()){
      $tblPricePerKw = $row['Rate_TOTAL'];
      }
      $totalBalance = $totalConsumptionCurrentMonth * $tblPricePerKw;
      $query="UPDATE bill_cycle SET no_of_data = $totalCounter, total_bill = $totalBalance, present_meter_reading=$total_present_kilowatts WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
      $result=$conn->query($query);

      $sqlbudgetset = "SELECT * FROM budget_set WHERE account_id = $accnum AND month = '$month' AND year = '$year' ;";
      $resultbudgetset = $conn ->query($sqlbudgetset);
      $num_rows_budget = mysqli_num_rows($resultbudgetset);
      if($num_rows_budget == 0){
      }elseif($num_rows_budget >= 1){
        while($row = $resultbudgetset->fetch_assoc()){
          $tblBudgetConsumed = $row['budget_consumed'];
          $tblKillowatsConsumed = $row['kilowatts_consumed'];
          $tblBudgetStatus = $row['budget_set_status'];
        }
        $present_money_consume_per_entry = $present_kilowatts * $tblPricePerKw;
        $present_money_consume = $tblBudgetConsumed - $present_money_consume_per_entry;
        $totalKilowattsConsumed = $tblKillowatsConsumed + $present_kilowatts;
        if ($present_money_consume < -2){}
          elseif($present_money_consume < 0 && $present_money_consume >= -2){
            $query="UPDATE budget_set SET budget_consumed = 0, kilowatts_consumed =$totalKilowattsConsumed WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
            $result=$conn->query($query);
          }
          else {
            $query="UPDATE budget_set SET budget_consumed = $present_money_consume, kilowatts_consumed =$totalKilowattsConsumed WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
            $result=$conn->query($query);
          }
          if($present_money_consume > 300){
            if($tblBudgetStatus == "Active") {}
              else{
                $querycheck="UPDATE budget_set SET budget_set_status = 'Active' WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
                $resultcheck=$conn->query($querycheck);
              }
            }elseif($present_money_consume <= 300 && $present_money_consume >= 1){
              if($tblBudgetStatus == "Warning Budget Low") {}
                else{
                  $querycheck="UPDATE budget_set SET budget_set_status = 'Warning Budget Low' WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
                  $resultcheck=$conn->query($querycheck);
                  $querybudget="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Warning Budget Low', 'Your budget is about to finish! -SCEEMS', 0);";
                  $resultbudget=$conn->query($querybudget);
                  $querybudget2="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum, 'Your budget is about to finish! -SCEEMS', 0);";
                  $resultbudget2=$conn->query($querybudget2);
                }
              }elseif($present_money_consume == 0){
                if($tblBudgetStatus == "Deactivate") {}
                  else{
                    $querycheck="UPDATE budget_set SET budget_set_status = 'Deactivate' WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
                    $resultcheck=$conn->query($querycheck);
                    $querybudget="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Cut!', 'Your budget is has finished! -SCEEMS', 0);";
                    $resultbudget=$conn->query($querybudget);
                    $querybudget2="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum, 'Your budget is has finished! -SCEEMS', 0);";
                    $resultbudget2=$conn->query($querybudget2);
                    $queryswitch="UPDATE power_switch SET status = 'OFF' WHERE account_id=$accnum;";
                    $resultswitch=$conn->query($queryswitch);
                    $queryDelete="DELETE FROM budget_set WHERE account_id=$accnum AND month = '$month' AND year = '$year';";
                    $resultDelete=$conn->query($queryDelete);
                  }
                }
              }
              $sqlswitchstatus = "SELECT * FROM power_switch WHERE account_id = $accnum ;";
              $resultswitchstatus  = $conn ->query($sqlswitchstatus);
              while($row =$resultswitchstatus -> fetch_assoc() ){
                $tblCut = $row['Cut'];
              }
              if($month == "January" ){
                $sqlpayment = "SELECT * FROM bill_cycle WHERE account_id = $accnum AND month = '$prevmonth' AND year = '$prevyear' ;";
                $resultpayment = $conn ->query($sqlpayment);
                while($row =$resultpayment -> fetch_assoc() ){
                  $tblPrevMonth = $row['month'];
                  $tblPaymentStatus = $row['payment_status'];
                  $tblPrevMonthTotal = $row['total_bill'];
                  $tblPrevMonthTotalBill = round($tblPrevMonthTotal,2);

                }
                if($currentmonth == $month && $day == 1 && $tblPaymentStatus == ""){
                  $querypayment="UPDATE bill_cycle SET payment_status = 'Unpaid' WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                  $resultpayment=$conn->query($querypayment);
                  $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                    'Good day! Your SCEEMS bill is on here!
                    User Account No: $accnum
                    Bill as of $lastmonthdate
                    Amount due is PHP $tblPrevMonthTotalBill
                    Due date is on $duedate
                    Cut off date is on $cutoffdate
                    Thank you for keeping your bill up to date.
                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                    $resultpaynoti=$conn->query($querypaynoti);
                    $querypaysms1="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum,
                      'Your Balance is Php $tblPrevMonthTotalBill.', 0);";
                      $resultpaysms1=$conn->query($querypaysms1);


                    }elseif($currentmonth == $month && $day == 3 && $tblPaymentStatus == "Unpaid"){
                      $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                        'Good day! This is your last day to pay your SCEEMS bill! Your payment will be added with 2% interest each day
                        User Account No: $accnum
                        Bill as of $currentdate of your last bill cycle
                        Amount due is PHP $tblPrevMonthTotalBill
                        Due date is on $duedate
                        Cut off date is on $cutoffdate
                        Thank you for keeping your bill up to date.
                        This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                        $resultpaynoti=$conn->query($querypaynoti);

                        }

                        elseif($currentmonth == $month && $day == 4 && $tblPaymentStatus == "Unpaid"){
                          $percent = $tblPrevMonthTotalBill * 0.02;
                          $interest1 = $tblPrevMonthTotalBill +$percent;
                          $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                          $resultpayment=$conn->query($querypayment);
                          $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                            'Good day! This is your SCEEMS bill!\n Your payment has been added with 2% interest each day starting today\nUser Account No: $accnum\nBill as of $currentdate of your last bill cycle\nAmount due is PHP $interest1\nCut off date is on $cutoffdate\nThis is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                            $resultpaynoti=$conn->query($querypaynoti);
                            $querypaysms="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum,
                              'Your Balance is Php $tblPrevMonthTotalBill. with 2% interest', 0);";
                              $resultpaysms=$conn->query($querypaysms);
                            }
                            elseif($currentmonth == $month && $day == 5 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 6 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 7 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 8 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 9 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 10 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$prevyear';";
                              $resultpayment=$conn->query($querypayment);
                              $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                                'Good day! This is your last day to pay your SCEEMS bill! Your payment has been added with 2% interest each day
                                User Account No: $accnum
                                Bill as of $currentdate of your last bill cycle
                                Amount due is PHP $interest1
                                Cut off date is Today!
                                This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                                $resultpaynoti=$conn->query($querypaynoti);
                                $querypaysms="Your Balance is Php $tblPrevMonthTotalBill. last day tomorrow', 0);";
                                  $resultpaysms=$conn->query($querypaysms);
                                }

                                elseif($currentmonth == $month && $day == 11 && $tblPaymentStatus == "Unpaid"){
                                  $queryswitches="UPDATE power_switch SET status = 'OFF', Cut = 'Active' WHERE account_id=$accnum";
                                  $resultswitches=$conn->query($queryswitches);
                                  $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                                    'Good day! Your SCEEMS Power has been cut! Please pay your bill.
                                    User Account No: $accnum
                                    Bill as of $currentdate of your last bill cycle
                                    Amount due is PHP $tblPrevMonthTotalBill
                                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                                    $resultpaynoti=$conn->query($querypaynoti);
                                    $querypaysms="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum,
                                      'SCEEMS Power has been cut! Please pay your bill $tblPrevMonthTotalBill', 0);";
                                      $resultpaysms=$conn->query($querypaysms);
                                    }

                                    elseif($currentmonth == $month  && $tblPaymentStatus == "Paid"){
                                      if($tblCut == "Deactive"){}
                                        else{
                                      $queryswitches="UPDATE power_switch SET status='ON', Cut = 'Deactive' WHERE account_id=$accnum";
                                      $resultswitches=$conn->query($queryswitches);
                                            }
                                        }
              }
                else{
              $sqlpayment = "SELECT * FROM bill_cycle WHERE account_id = $accnum AND month = '$prevmonth' AND year = '$year' ;";
                $resultpayment = $conn ->query($sqlpayment);
                while($row =$resultpayment -> fetch_assoc() ){
                  $tblPrevMonth = $row['month'];
                  $tblPaymentStatus = $row['payment_status'];
                  $tblPrevMonthTotal = $row['total_bill'];
                  $tblPrevMonthTotalBill = round($tblPrevMonthTotal,2);

                }
                if($currentmonth == $month && $day == 1 && $tblPaymentStatus == ""){
                  $querypayment="UPDATE bill_cycle SET payment_status = 'Unpaid' WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                  $resultpayment=$conn->query($querypayment);
                  $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                    'Good day! Your SCEEMS bill is on here!
                    User Account No: $accnum
                    Bill as of $lastmonthdate
                    Amount due is PHP $tblPrevMonthTotalBill
                    Due date is on $duedate
                    Cut off date is on $cutoffdate
                    Thank you for keeping your bill up to date.
                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                    $resultpaynoti=$conn->query($querypaynoti);
                    $querypaysms1="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum,
                      'Your Balance is Php $tblPrevMonthTotalBill.', 0);";
                      $resultpaysms1=$conn->query($querypaysms1);


                    }elseif($currentmonth == $month && $day == 3 && $tblPaymentStatus == "Unpaid"){
                      $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                        'Good day! This is your last day to pay your SCEEMS bill! Your payment will be added with 2% interest each day
                        User Account No: $accnum
                        Bill as of $currentdate of your last bill cycle
                        Amount due is PHP $tblPrevMonthTotalBill
                        Due date is on $duedate
                        Cut off date is on $cutoffdate
                        Thank you for keeping your bill up to date.
                        This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                        $resultpaynoti=$conn->query($querypaynoti);

                        }

                        elseif($currentmonth == $month && $day == 4 && $tblPaymentStatus == "Unpaid"){
                          $percent = $tblPrevMonthTotalBill * 0.02;
                          $interest1 = $tblPrevMonthTotalBill +$percent;
                          $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                          $resultpayment=$conn->query($querypayment);
                          $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                            'Good day! This is your SCEEMS bill!\n Your payment has been added with 2% interest each day starting today\nUser Account No: $accnum\nBill as of $currentdate of your last bill cycle\nAmount due is PHP $interest1\nCut off date is on $cutoffdate\nThis is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                            $resultpaynoti=$conn->query($querypaynoti);
                            $querypaysms="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum,
                              'Your Balance is Php $tblPrevMonthTotalBill. with 2% interest', 0);";
                              $resultpaysms=$conn->query($querypaysms);
                            }
                            elseif($currentmonth == $month && $day == 5 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 6 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 7 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 8 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 9 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                              $resultpayment=$conn->query($querypayment);

                            }
                            elseif($currentmonth == $month && $day == 10 && $tblPaymentStatus == "Unpaid"){
                              $percent = $tblPrevMonthTotalBill * 0.02;
                              $interest1 = $tblPrevMonthTotalBill +$percent;
                              $querypayment="UPDATE bill_cycle SET total_bill = $interest1 WHERE account_id=$accnum AND month = '$prevmonth' AND year = '$year';";
                              $resultpayment=$conn->query($querypayment);
                              $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                                'Good day! This is your last day to pay your SCEEMS bill! Your payment has been added with 2% interest each day
                                User Account No: $accnum
                                Bill as of $currentdate of your last bill cycle
                                Amount due is PHP $interest1
                                Cut off date is Today!
                                This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                                $resultpaynoti=$conn->query($querypaynoti);
                                $querypaysms="Your Balance is Php $tblPrevMonthTotalBill. last day tomorrow', 0);";
                                  $resultpaysms=$conn->query($querypaysms);
                                }

                                elseif($currentmonth == $month && $day == 11 && $tblPaymentStatus == "Unpaid"){
                                  $queryswitches="UPDATE power_switch SET status = 'OFF', Cut = 'Active' WHERE account_id=$accnum";
                                  $resultswitches=$conn->query($queryswitches);
                                  $querypaynoti="INSERT INTO `notifications`(`account_id`, `notification_subject`,`notification_text`, `notification_status`) VALUES ($accnum,'Bill',
                                    'Good day! Your SCEEMS Power has been cut! Please pay your bill.
                                    User Account No: $accnum
                                    Bill as of $currentdate of your last bill cycle
                                    Amount due is PHP $tblPrevMonthTotalBill
                                    This is a system generated message, do not reply. Please disregard this message if you have already settled your bill.', 0);";
                                    $resultpaynoti=$conn->query($querypaynoti);
                                    $querypaysms="INSERT INTO `notifications_sms`(`account_id`, `notification_sms_text`, `notification_sms_status`) VALUES ($accnum,
                                      'SCEEMS Power has been cut! Please pay your bill $tblPrevMonthTotalBill', 0);";
                                      $resultpaysms=$conn->query($querypaysms);
                                    }

                                    elseif($currentmonth == $month  && $tblPaymentStatus == "Paid"){
                                      if($tblCut == "Deactive"){}
                                        else{
                                      $queryswitches="UPDATE power_switch SET status='ON', Cut = 'Deactive' WHERE account_id=$accnum";
                                      $resultswitches=$conn->query($queryswitches);
                                            }
                                        }
                            }
                          }
                          }

}


                          ?>
