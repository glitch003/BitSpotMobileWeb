<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php 	include 'includes/head.php'; 
				include 'includes/scripts.php';
		?>

	<script type="text/javascript">
	var currencyObject;
	var viewingUSD = true;


	function curChange(){
				if(viewingUSD){
					$("#curType").html("Tap or Click to change to USD.");
					viewingUSD = false;
				}else{
					$("#curType").html("Tap or Click to change to BTC.");
					viewingUSD = true;
				}
				populateTable();
			}	
	function populateTable(){

		console.log("populating table with:");
		console.log(currencyObject);
		var finalHtml = "<thead><tr><th>Currency</th><th>Value</th></thead>";
		finalHtml = "";
		for(var i = 0; i < currencyObject.length; i++){
			if(viewingUSD){
				finalHtml += "<tr onclick='javascript:curChange();'><td>"+currencyObject[i].name+"</td><td>"+currencyObject[i].price+"</td></tr>";
			}else{
				finalHtml += "<tr onclick='javascript:curChange();'><td>"+currencyObject[i].btcname+"</td><td>"+currencyObject[i].btcprice+"</td></tr>";
			}
		}
		$("#curList").html(finalHtml);
	}

		$(document).ready(function(){
			
			var jso = <?php echo file_get_contents("http://bitspotprice.com/~chris/values.php?formatData=true");?>;
			currencyObject = jso;
			
			populateTable();
			
			setInterval(function(){
				$.ajax({
					url: '/~chris/values.php?formatData=true',
					success: function(res){
						console.log("success");
						console.log(res);
						currencyObject = res;			
						populateTable();
					}, failure: function(res){
						console.log("failure");
						console.log(res);
					}
					
				});

			}, 30000);
		});

	</script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

 
        <?php include 'includes/navbar.php'; ?>

        <div class="container">
		<div style="margin-top: -10px; text-align: center; margin-bottom: 10px;" id="curType">
			Tap or Click to change to BTC.
		</div>
		<table id="curList" class="table table-striped">
		
		
		</table>	
      

     
            <?php include 'includes/footer.php'; ?>
        </div> <!-- /container -->

        
    </body>
</html>
