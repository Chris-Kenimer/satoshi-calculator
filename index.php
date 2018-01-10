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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


</script>
<style type="text/css">
  textarea,
input[type=text],
input[type=search],
input[type=number],
input[type=email],
input[type=password],
input[type=tel] {
@media (max-width: 799px) {
font-size: 16px !important;
}
}
</style>
<body>
<div class="container">
  
  <form class="">
    <div class="row">
      <input name="basecoin" type="radio" id="baseBTC" value="BTC"/>
      <label for="baseBTC">BTC</label>

      <input name="basecoin" type="radio" id="baseETH" value="ETH" checked />
      <label for="baseETH">ETH</label>
    </div>


    <div class="row">
      <div class="input-field col s12 m12">
        <input type="text" name="start-value" id="start_value">
        <label>Buy Limit (Satoshi)</label>
        <span id="buy-value"></span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 m12">
        <input type="text" name="end-value" id="end_value">
        <label>Sell Limit (Satoshi)</label>
        <span id="sell-value"></span>
      </div>
    </div>
    <div class="row">
      <div class="col s12 ">
        <div id="calculatedPercentageParent" class="card-panel teal">
          <span id="calculatedPercentage" class="white-text">0%</span>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
var coinValue;
var startValue;
var endValue;

  $(document).ready(function(){
    function setBuyLimit(){
      console.log(coinValue[0]);
      startValue = $('#start_value').val()*coinValue[0].price_usd;
      $('#buy-value').html("$"+startValue.format(2));
    }
    function setSellLimit(){
      console.log(coinValue[0]);
      endValue = $('#end_value').val()*coinValue[0].price_usd;
      $('#sell-value').html("$"+endValue.format(2));
    }
    function setCoinValue(data){
      coinValue = data;
      setBuyLimit();
      setSellLimit();
    };

    function getBTCValue(){

        $.get("https://api.coinmarketcap.com/v1/ticker/bitcoin/", function(data){
        $("label[for='baseBTC']").html("BTC - $"+data[0].price_usd);
         setCoinValue(data);

       });

    }
    function getETHValue(){
      $.get("https://api.coinmarketcap.com/v1/ticker/ethereum/", function(data){
        setCoinValue(data);
        $("label[for='baseETH']").html("ETH - $"+data[0].price_usd);

        });
    }
    function calculateDifference(){
      var difference = endValue - startValue;
      var convertedPercentage = difference / startValue * 100;
      var usdDifference = difference;
      console.log(convertedPercentage + coinValue[0].price_usd);
      if(convertedPercentage < 0){
        $("#calculatedPercentageParent").removeClass("teal").addClass("red");
      }else {
        $("#calculatedPercentageParent").toggleClass("teal").removeClass("red");
      }
      $("#calculatedPercentage").html(convertedPercentage.toFixed(2) +"% : USD $" + usdDifference.toFixed(2));

    }
    getBTCValue();
    getETHValue();
    $("input[name='basecoin']").change(function(){
      if($(this).val() == 'BTC'){
        getBTCValue();
        console.log('got value of BTC');
      }
      if($(this).val() == 'ETH'){
        getETHValue();
        console.log('got value of ETH');
      }
    });

    $('#start_value').keyup(function(){
      setBuyLimit();
      calculateDifference();
    });
    $('#end_value').keyup(function(){
      setSellLimit();
      calculateDifference();
    });

    Materialize.updateTextFields();
  });
</script>
</body>
</html>
