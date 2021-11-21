function loadData(){
  $.ajax({
    type:"GET",
    url:"dist/api/load_user_account.php",
    success:function(data){
      $('#User_account_table').html(data);
    }
  });

}

function loadDataBillCycle(){
  $.ajax({
    type:"GET",
    url:"dist/api/load_bill_cycle.php",
    success:function(data){
      $('#Bill_cycle_table').html(data);
    }
  });

}


function loadDataBudgetSet(){
  $.ajax({
    type:"GET",
    url:"dist/api/load_budget_set.php",
    success:function(data){
      $('#Budget_set_table').html(data);
    }
  });

}

function loadDataPowerSwitch(){
  $.ajax({
    type:"GET",
    url:"dist/api/load_power_switch.php",
    success:function(data){
      $('#Power_switch_table').html(data);
    }
  });

}

function loadDataPriceRates(){
  $.ajax({
    type:"GET",
    url:"dist/api/load_price_rates.php",
    success:function(data){
      $('#Price_rates_table').html(data);
    }
  });

}
function deleteUserAccountData(strID){
  var acc_id = strID;

  $.ajax({

    type:"GET",
    url:"dist/api/delete_user_account.php",
    data:{"ID":acc_id},
    success:function(data){
      alert('User Account Deleted!');
      loadData();
      //window.location.href="gaming_admin.php";
    }

  });

}

function deleteBillCycleData(strID){
  var bill_cycle_id = strID;

  $.ajax({

    type:"GET",
    url:"dist/api/delete_bill_cycle.php",
    data:{"ID":bill_cycle_id},
    success:function(data){
      alert('Bill Cycle Deleted!');
      loadDataBillCycle();
      //window.location.href="gaming_admin.php";
    }

  });

}

function deleteBudgetSetData(strID){
  var budget_set_id = strID;

  $.ajax({

    type:"GET",
    url:"dist/api/delete_budget_set.php",
    data:{"ID":budget_set_id},
    success:function(data){
      alert('Budget set Deleted!');
      loadDataBudgetSet();
      //window.location.href="gaming_admin.php";
    }

  });

}

function deletePowerSwitchData(strID){
  var account_id = strID;

  $.ajax({

    type:"GET",
    url:"dist/api/delete_power_switch.php",
    data:{"ID":account_id},
    success:function(data){
      alert('Power Switch row Deleted!');
      loadDataPowerSwitch();
      //window.location.href="gaming_admin.php";
    }

  });

}

function deletePriceRatesData(strID){
  var price_rates_id = strID;

  $.ajax({

    type:"GET",
    url:"dist/api/delete_price_rates.php",
    data:{"ID":price_rates_id},
    success:function(data){
      alert('Price rate Deleted!');
      loadDataPriceRates();
      //window.location.href="gaming_admin.php";
    }

  });

}
