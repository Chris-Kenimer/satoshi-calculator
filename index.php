<?php   ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
          
</head>


</script>
<body>
<div class="row">
  <div id="response"></div>
  <form class="col s12">
    <p>
        <input name="basecoin" type="radio" id="baseBTC" />
        <label for="baseBTC">BTC</label>
      </p>
      <p>
        <input name="basecoin" type="radio" id="baseETH" />
        <label for="baseETH">ETH</label>
      </p>

    <div class="row">
      <div class="input-field col s6">
        <input type="text" name="start-value" id="start_value">
        <label>Buy Limit (Satoshi)</label>
        <span id="buy-value">USD $7.74</span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <input type="text" name="end-value" id="end-value">
        <label>Sell Limit (Satoshi)</label>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  var btcValue = '';
  $(document).ready(function(){
  
    function setBTCValue(BTCdata){
      btcValue = BTCdata[0];
      // btcValue = BTCdata;
      console.log('setting value');
    };
    
    function getBTCValue(){
      // $.get("https://api.coinmarketcap.com/v1/ticker/bitcoin/");
      $.get("https://api.coinmarketcap.com/v1/ticker/bitcoin/", function(data){
        setBTCValue(data[0]);
        // console.log(data[0]);
    
        
      });
      
    }
    getBTCValue();
    
    // console.log("btc Value"+ btcValue);
    // var ethPrice = '';
    // function getCurrentPrices(){
    //  var btcvalue =
    //    $.get("https://api.coinmarketcap.com/v1/ticker/bitcoin/", function(data){
    //      $("label[for='baseBTC']").html("BTC - $"+data[0].price_usd);
    //      //console.log(data[0]);
    //      return data[0].price_usd;

    //    });
    //    console.log("Looking for btc value" + btcvalue);
    //  return btcvalue;
    // }
    // function getEthereiumValue(){
    //  $.get("https://api.coinmarketcap.com/v1/ticker/ethereum/", function(data){
    //    ethPrice = data[0].price_usd;
    //    console.log("nested ethPrice value " + ethPrice);
    //  });
    //  console.log("Inside parent function" + ethPrice);
      
    // }
    // getCurrentPrices();
    // getEthereiumValue();
    // // var ethPrice = getEthereiumValue();
    // console.log("outside function" + ethPrice);
    
    // console.log(getCurrentPrices);
    $('#start_value').keydown(function(){
      console.log(btcValue);
      $('#buy-value').html($(this).val());
    });
    Materialize.updateTextFields();
  });
</script>
</body>
</html>