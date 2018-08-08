<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Dashboard</title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url("/admin-assets"); ?>/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url("/admin-assets"); ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url("/admin-assets"); ?>/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/icheck/flat/green.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url("/admin-assets"); ?>/js/gridstack/gridstack.css"/>
  <link rel="stylesheet" href="<?php echo base_url("/admin-assets"); ?>/js/gridstack/gridstack-extra.css"/>

  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/validator/validator.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery-ui-1.11.0/jquery-ui.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/lodash.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/gridstack/gridstack.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/gridstack/gridstack.jQueryUI.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/chartjs/chart.min.js"></script>


  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/date.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/flot/jquery.flot.resize.js"></script>


  <!--                 css for agent status                   -->



  <style type="text/css">
#flotcontainer {
    width: 600px;
    height: 400px;
    text-align: left;
}
</style>



  <!--                 css for agent status                   -->






 <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	<style type="text/css">
		.alert-box { color:#555; border-radius:10px; font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px; padding:10px 10px 10px 36px; margin:10px; }
		.alert-box span { font-weight:bold; text-transform:uppercase; }
		.error { background:#ffecec; border:1px solid #f5aca6; }
		.success { background:#e9ffd9; border:1px solid #a6ca8a; }
		#msgbx_err{ display: none; }
		#msgbx_success{ display: none; }
    </style>

       <script language="javascript">
	   $(document).ready(function(){
	   		//alert("")
	   		//window.dispatchEvent(new Event('resize'));
			//$(".x_panel").css("height",$(window).height());
	   });

		
$(function() {

		  $('input[name="single_cal1"]').daterangepicker({
			  singleDatePicker: true,
			  defaultDate: new Date(),
			  showDropdowns: true

		  });

		  $('input[name="single_cal1"]').on('apply.daterangepicker', function(ev, picker) {
			  $(this).val(picker.startDate.format('YYYY-MM-DD'));
		  });


		});
		</script>


<script>
     $('document').ready(function(){
        setTimeout(function(){
           window.location.reload(1);
        }, 120000);
     });
</script>


<script type="text/javascript">

function labelFormatter(label, series) {
return "<div style='font-size:8pt;text-shadow: 2px 2px #FFFFFF; text-align:center; padding:2px; color:black;'>"    + label + "<br/>" + series.data[0][1] + "%</div>";
}
<?php
	if(count($calldispo)>0){
	?>
$(function () {
	
	$("#flotcontainer").html("");
	 var data = [

		<?php
      $color=Array("AGENT BUSY"=>"rgba(139, 4, 20, 0.53)","ANSWERED"=>"rgba(18, 117, 16, 0.5)","BUSY"=>"rgba(243, 18, 44, 0.5)","DISCONNECTED"=>"rgba(194, 5, 5, 0.63)","NO AGENTS"=>"rgba(198, 173, 12, 0.5)","TRANSFER"=>"rgba(1, 193, 129, 0.51)","AGENT TRANSFER"=>"rgba(44, 152, 1, 0.53)","FAILED"=>"rgba(129, 33, 4, 0.56)","NO ANSWER"=>"rgba(255, 55, 15, 0.64)","LIVE CALL"=>"rgba(1, 107, 2, 0.50)");
			for($i=0;$i<count($calldispo);$i++){
        if(empty($calldispo[$i]->disposition)){
          $calldispo[$i]->disposition="LIVE CALL";
        }

		?>
        {label: "<?php echo $calldispo[$i]->disposition ?>", data:<?php echo $calldispo[$i]->count ?>,color:"<?php echo $color[$calldispo[$i]->disposition] ?>"},
       <?php
			}
	   ?>
		];



    var options = {
            series: {
                pie: {
                    show: true,
                    radius: .9,
					innerRadius: 0.0,
                    tilt: 1,
                    label:{
                      show: true,
                      formatter: labelFormatter,
                    }
                }
            },
            legend: {
                show: true


            },
            grid: {

                hoverable: true,
                clickable: true

            }
         };






    $.plot($("#flotcontainer"), data, options);


    $("#flotcontainer").bind("plothover", function(event, pos, obj){
        if (!obj){return;}
        percent = parseFloat(obj.series.percent).toFixed(2);

        var html = [];
        html.push("<div style=\"flot:left;width:100%;height:20px;text-align:center;border:1px solid black;background-color:", obj.series.color, "\">",
                  "<span style=\"font-weight:bold;color:white\">", obj.series.label, " (", percent, "%)</span>",
                  "</div>");

        $("#showInteractive").html(html.join(''));
    });

   $("#flotcontainer").bind("plotclick", function(event, pos, obj){
        if (!obj){return;}
        percent = parseFloat(obj.series.percent).toFixed(2);

        alert(obj.series.label + " ("+ percent+ "%)");

    });


});

<?php
} // if end  for chart inbound
?>

<?php
	if(count($outboundcalldispo)>0){
	?>
$(function () {
	
	$("#flotcontainer1").html("");
	 var data = [

		<?php
			for($i=0;$i<count($outboundcalldispo);$i++){
		?>
        {label: "<?php echo $outboundcalldispo[$i]->disposition ?>", data:<?php echo $outboundcalldispo[$i]->count ?>,color:"<?php echo $color[$outboundcalldispo[$i]->disposition] ?>"},
       <?php
			}
	   ?>
		];



    var options = {
            series: {
                pie: {
                    show: true,
                    radius: .9,
					          innerRadius: 0.0,
                    tilt: 1,
                    label:{
						                show: true,
                            formatter: labelFormatter,

                    }
                }
            },
            legend: {
                show: true


            },
            grid: {

                hoverable: true,
                clickable: true

            }
         };






    $.plot($("#flotcontainer1"), data, options);


    $("#flotcontainer1").bind("plothover", function(event, pos, obj){
        if (!obj){return;}
        percent = parseFloat(obj.series.percent).toFixed(2);

        var html = [];
        html.push("<div style=\"flot:left;width:100%;height:20px;text-align:center;border:1px solid black;background-color:", obj.series.color, "\">",
                  "<span style=\"font-weight:bold;color:white\">", obj.series.label, " (", percent, "%)</span>",
                  "</div>");

        $("#showInteractive1").html(html.join(''));
    });

   $("#flotcontainer1").bind("plotclick", function(event, pos, obj){
        if (!obj){return;}
        percent = parseFloat(obj.series.percent).toFixed(2);

        alert(obj.series.label + " ("+ percent+ "%)");

    });


});

<?php
} // if end  for chart inbound
?>
</script>




		<!-- Javascript for outboundcall status -->





<script>
    $(document).ready(function() {
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
	  /*
      var data1 = [
        [gd(2012, 1, 2,8), 17],
        [gd(2012, 1, 2,9), 74],
        [gd(2012, 1, 2,10), 6],
        [gd(2012, 1, 2,11), 39],
        [gd(2012, 1, 2,12), 20],
        [gd(2012, 1, 2,13), 85],
        [gd(2012, 1, 2,14), 7]
      ];

      var data2 = [
        [gd(2012, 1, 2,8), 82],
        [gd(2012, 1, 2,9), 23],
        [gd(2012, 1, 2,10), 66],
        [gd(2012, 1, 2,11), 9],
        [gd(2012, 1, 2,12), 119],
        [gd(2012, 1, 2,13), 6],
        [gd(2012, 1, 2,14), 9]
      ];
	  */

	  <?php

		$year=date("Y");
		$month=date("n");
		$day=date("j");
		$in=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$out=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		for($i=0;$i<count($chartin);$i++){

			$in[$chartin[$i]->hours]=$chartin[$i]->count;
		}
		for($i=0;$i<count($chartout);$i++){

			$out[$chartout[$i]->hours]=$chartout[$i]->count;
		}
		echo ' var data1 = [';

			for($i=0;$i<24;$i++){

				if($i !=23){
				echo " [gd($year, $month, $day,$i),$in[$i]],";
				}else{
				echo " [gd($year, $month, $day,$i), $in[$i]]";
				}

			}

		echo ' ];';


		echo ' var data2 = [';

			for($i=0;$i<24;$i++){

				if($i !=23){
				echo " [gd($year, $month, $day,$i), $out[$i]],";
				}else{
				echo " [gd($year, $month, $day,$i), $out[$i]]";
				}

			}

		echo ' ];';

	  ?>


      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(184, 10, 10,1)", "rgba(10, 126, 184, 1)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "hour"],
		  timezone: "browser",
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,

          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 10,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day,h) {
		$b=new Date(year, month - 1, day,h).getTime();
		console.dir($b);
        return $b;

      }
    });


  function amBarge($uname){

    $("#bargeagent").val($uname);
    $("#bargemodel-title").html("Barge "+$uname);
    $("#bargemodel").modal("toggle");

  }

  function startamBarge(){

    $u=$("#bargeagent").val();
    if($u==""){
      alert("Cannot start ")
      return;
    }
      $a=$("#adminphone").val();
    if($a==""){
      alert("Cannot start please input a admin phone")
      return;
    }
    $m=$("#bmode").val();
    if($m==""){
      alert("Cannot start ..");
      return;
    }

    $.ajax({ url: "<?php echo base_url("/admin/dashboard/amBarge"); ?>",data:{"u":$u,"a":$a,"m":$m} ,success: function(data) {


    },dataType: "json" });

  }


	(function getdata() {
		   setTimeout(function() {
			$cdate=$("#cdate").val();   
			//alert($cdate);
			   $.ajax({ url: "<?php echo base_url("/admin/dashboard/poll_custom"); ?>",data:{"cdate":$cdate} ,success: function(data) {
//alert(data);
					 $aout='<table class="table">';
					$agstat=data.agentsstatus;
					for($i=0;$i<$agstat.length;$i++){
						$aout +="<tr>";
						$aout +="<td>"+$agstat[$i].uname+"</td>";
						$aout +="<td>"+$agstat[$i].agent_status+"</td>";
						//$aout +="<td>"+moment.unix($agstat[$i].last_login).format('DD/MM/YY HH:mm:ss')+"</td>";
						$aout +="<td>"+moment.unix($agstat[$i].lastupdate).format('DD/MM/YY HH:mm:ss')+"</td>";
            $aout +="<td>"+$agstat[$i].clm+"</td>";
            if($agstat[$i].agent_status!="UNAVAILABLE"){
            $aout +="<td><a href=\"javascript:logoutAgent('"+$agstat[$i].uname +"')\"><i class=\"fa fa-close\"></i></td>";
            $aout +="<td><a href=\"javascript:amBarge('"+$agstat[$i].uname +"')\"><i class=\"fa fa-headphones\"></i></td>";
            }else{
              $aout +="<td></td>";
            }
						$aout +="</tr>";

					}
					$aout +="</table>";
					$("#agentstatus").html($aout);



			   },dataType: "json", complete: getdata });
			}, 4000);
	})();

  function logoutAgent($ag){
      $.ajax({ url: "<?php echo base_url("/admin/dashboard/logoutagent"); ?>",data:{"agent":$ag} ,success: function(data) {

      },dataType: "json" });

  }

//////////////////// DRAGABLE FUNCTION ///////////////////
  $(function () {
    var options = {
        cell_height: 80,
        vertical_margin: 5,
        handle:".x_title"
      }
    $('.grid-stack').gridstack(options);

      var serializeWidgetMap = function(items) {
          //console.dir(items);
          this.grid = $('.grid-stack').data('gridstack');
          //console.dir(this.grid.grid.nodes );
          $vv=this.grid.grid.nodes;
          $newx=[];

          for($i=0;$i<$vv.length;$i++){
              //console.dir($vv.length);
              $newx[$i]={"x":$vv[$i].x,"y":$vv[$i].y,"_id":$vv[$i]._id};

          }

          //console.dir(JSON.stringify($newx));

      };

      $('.grid-stack').on('change', function(event, items) {
          serializeWidgetMap(items);
      });

      $('.grid-stack').on('added', function(event, items) {
        for (var i = 0; i < items.length; i++) {
          //console.log('item added');
          //console.log(items[i]);
        }
    });

    $str=jQuery.parseJSON('[{"x":0,"y":0,"_id":1},{"x":0,"y":4,"_id":3},{"x":6,"y":4,"_id":5},{"x":6,"y":8,"_id":2},{"x":0,"y":8,"_id":4}]');
    this.grid = $('.grid-stack').data('gridstack');
    console.dir($str);
    $vv=this.grid.grid.nodes;
    for($i=0;$i<$vv.length;$i++){
        console.dir($vv.length);
        //$newx[$i]={"x":$vv[$i].x,"y":$vv[$i].y,"_id":$vv[$i]._id};
        for($j=0;$j<$str.length;$j++){
            console.warn($vv[$i]._id+":"+$str[$j]._id);
            if($vv[$i]._id==$str[$j]._id){
              console.dir($vv[$i].el[0]);
              //console.dir(this.grid);
              //this.grid.move($vv[$i].el[0],$str[$j].x, $str[$j].y);
              $($vv[$i].el[0]).attr('data-gs-x',$str[$j].x);
              $($vv[$i].el[0]).attr('data-gs-y',$str[$j].y);
            }

        }


    }

});
///////////////////
  </script>




  <!-- /datepicker -->

</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

     <?php
		$this->load->view("admin/menu");
	 ?>
      <!-- /top navigation -->

      <!-- page content -->

      <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
            <h3>
              Custom Dashboard 
             </h3>
            </div>
<?php 			$groups = $this->session->userdata('groups');
			$myString = $groups;
			$myArray = explode(',', $myString);
			?>
            <div class="title_right">
             <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

				  <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dashboard
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
<?php 
if($groups!='0'){
 for($i=0;$i<count($myArray);$i++){
		$sql ="SELECT * FROM `call_groups` where `gid`='".$myArray[$i]."'";
		$query=$this->db->query($sql);
		foreach ($query->result() as $row) {
		$name = $row->name; ?>
	      <li><a href="<?php echo base_url('/admin/dashboardgroup')."?keyword=".$row->gid;?>"><?php echo strtoupper($name);?> DASHBOARD</a></li>
<?php } } }else{ 
		$sql ="SELECT * FROM `call_groups` ";
		$query=$this->db->query($sql);
		foreach ($query->result() as $row) {
		$name = $row->name; ?>
			      <li><a href="<?php echo base_url('/admin/dashboardgroup')."?keyword=".$row->gid;?>"><?php echo strtoupper($name);?> DASHBOARD</a></li>
<?php } } ?>
<li><a href="#" data-toggle="modal" data-target="#myModal">CUSTOM DASHBOARD</a></li>

    </ul>
  </div>

                </div>
              </div>
            </div>
          </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Custom Dashboard</h4>
      </div>
      <div class="modal-body">
<div class="row">
					<form id="ShowForm" name="RptForm" class="form-horizontal"  role="form" action="<?php echo base_url("/admin/dashboard/custom_dashboard"); ?>?<?php echo http_build_query($_GET, '', "&");?>">

						<div class="col-md-8 " >
		<input type="text" placeholder="Select Date" id="single_cal1" name="single_cal1" class="form-control">
						</div>
																<input id="btnSearch" class="btn btn-primary" type="submit" value="Search"/>

						</form>
					</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
          <div class="clearfix"></div>
			 <h4>Date : <?php echo $caldate=($this->input->get("single_cal1",true));?></h4>
<input type="hidden" id="cdate" value="<?php echo $caldate; ?>">

          <!-- top tiles -->
        <div class="row tile_count">
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count" style="width: 14%;">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Inbound Call</span>
              <div class="count"><?php echo $incallhr[0]->inboundcall;?></div>
              <span class="count_bottom">This Day </span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count" style="width: 14%;">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Outbound Call</span>
              <div class="count"><?php echo $outcallhr[0]->outboundcall;?></div>
              <span class="count_bottom">This Day </span>
            </div>
          </div>


          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count" style="width: 14%;">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Inbound Call</span>
              <div class="count"><?php echo $incallwk[0]->inboundcall;?></div>
              <span class="count_bottom"><i class="green"></i> This Week</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count" style="width: 14%;">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Outbound Call</span>
              <div class="count"><?php echo $outcallwk[0]->outboundcall;?></div>
              <span class="count_bottom"><i class="red"></i> This Week</span>
            </div>
          </div>

          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count" style="width: 14%;">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Inbound Call</span>
              <div class="count"><?php echo $incallmonth[0]->inboundcall;?></div>
              <span class="count_bottom"><i class="green"></i> This Month</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count" style="width: 14%;">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Outbound Call</span>
              <div class="count"><?php echo $outcallmonth[0]->outboundcall;?></div>
              <span class="count_bottom"><i class="green"></i> This Month</span>
            </div>
          </div>








        </div>
        <!-- /top tiles -->


        <!--grid-stack-->
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="grid-stack">
        <!--grid-stack start -->




        <!-- chart todays calls  -->
        <div class="grid-stack-item" id="tcallnumber" data-gs-x="0" data-gs-y="0" data-gs-width="12" data-gs-height="4" data-gs-no-resize="true">
                <div class="grid-stack-item-content">


                <div class="x_panel">
                  <div class="x_title">
                  <h2>TOTAL CALLS</h2>
                  <div class="clearfix"></div>
                  </div>

                    <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                      <div style="width: 100%;">
                        <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:250px;"></div>
                      </div>

                  </div>

                </div>
        </div>
        <!-- chart todays calls -->






        <!-- Agent Status -->
        <div class="grid-stack-item" id="agentstatusw" data-gs-x="0" data-gs-y="0" data-gs-width="6" data-gs-height="4" data-gs-no-resize="true">
                <div class="grid-stack-item-content">
            <!---div class="x_panel">
              <div class="x_title">
              <h2>Agent Status</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
              </div>
               <!---div class="x_content" id="agentstatus" style="width:100%;height:230px;overflow:auto;">
                    Loading....
              </div>
            </div---->

            </div>
          </div>
        <!-- Agent Status -->



          <!--Inbound-->
            <div class="grid-stack-item" id="inbound" data-gs-x="0" data-gs-y="4" data-gs-width="6" data-gs-height="4" data-gs-no-resize="true">
                    <div class="grid-stack-item-content">
                              <div class="x_panel">
                                <div class="x_title">
                                <h2>Inbound</h2>

                                <div class="clearfix"></div>
                                </div>
                                <div class="x_content" id="agentstatusq" style="width:100%;position:relative;">
                                 <div style="position:absolute;top:0px;left:0px;"><span id="showInteractive"></span></div>
                                 <div id="flotcontainer" style="width:100%;height:230px;">No Data Available</div>
                                </div>
                              </div>

                    </div>
            </div>
            <!--Inbound-->
            <!--Outbound-->
            <div class="grid-stack-item" id="outbound" data-gs-x="6" data-gs-y="4" data-gs-width="6" data-gs-height="4" data-gs-no-resize="true">
                    <div class="grid-stack-item-content">
                        <div class="x_panel">
                          <div class="x_title">
                          <h2>Outbound</h2>

                          <div class="clearfix"></div>
                          </div>
                           <div class="x_content" id="agentstatusq2" style="width:100%;position:relative;">
                             <div style="position:absolute;top:0px;left:0px;"><span id="showInteractive1"></span></div>

                             <div id="flotcontainer1" style="width:100%;height:230px;">No Data Available</div>
                          </div>
                        </div>

                    </div>
            </div>
            <!--Outbound-->



        <!-- chart todays number  -->
        <div class="grid-stack-item" id="todaycallchart" data-gs-x="0" data-gs-y="0" data-gs-width="6" data-gs-height="4" data-gs-no-resize="true">
                <div class="grid-stack-item-content">


                <div class="x_panel">
                  <div class="x_title">
                  <h2>TOTAL INBOUND CALLS</h2>
                  <div class="clearfix"></div>
                  </div>
                        <div class="x_content" id="" style="width:100%;height:230px;overflow:auto">
                          <table class="table table-striped table-hover">
                            <tr>
                              <th>STATUS</th>
                              <th>COUNT</th>
                            </tr>

                            <?php
                          $class=array("FAILED"=>"danger","BUSY"=>"info","NO ANSWER"=>"warning","ANSWERED"=>"success");
                          for($i=0;$i<count($calldispo);$i++){
                             if(empty($calldispo[$i]->disposition)){
                               $calldispo[$i]->disposition="LIVE CALL";
                             }
                          ?>

                          <tr class2="<?php echo $class[$calldispo[$i]->disposition] ?>" style="background-color:<?php echo $color[$calldispo[$i]->disposition] ?>;color:white;">
                              <td ><?php echo $calldispo[$i]->disposition?></td>
                              <td><?php echo $calldispo[$i]->count?></td>
                          </tr>


                          <?php
                          }

                          ?>
                          </table>
                          </div>

                  </div>

                </div>
        </div>
        <!-- chart todays number -->






        <!--grid-stack end-->
        </div>

        <!--grid end-->
        </div>
        <!--row end-->
        </div>
        <!--grid-stack-->


        </div>
      </div>


      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
            Bitvoice Solutions PVT LTD
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <!--Barge form -->
  <div class="modal fade" id="bargemodel" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="bargemodel-title">Barge </h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="usr">Admin Phone:</label>
                <input type="text" class="form-control" id="adminphone">
                <input type="hidden" class="form-control" id="bargeagent">
              </div>
              <div class="form-group">
                <label for="usr">Mode:</label>
                <select id="bmode" class="form-control">
                    <option value="0">Barge</option>
                    <option value="1">Wisper</option>
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="startamBarge();">Start</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>







  <script src="<?php echo base_url("/admin-assets"); ?>/js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/icheck/icheck.min.js"></script>
  <!-- pace -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/pace/pace.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/custom.js"></script>


</body>

</html>
