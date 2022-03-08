<?php
session_start();
$user=$_SESSION['user'];
if($user=="")
{
	header("location:logout.php");
}
include("../class/class.php");
include("validation.php");
$s=new nebu();
$list_out=$_GET['sel'];
$trnmnt=$_REQUEST['trnmts'];

if($list_out==1)
{
$qry="SELECT * FROM `matches` where `trnment_id`='$trnmnt' && `status`='1'";
}
elseif($list_out==2)
{
$qry="SELECT * FROM `matches` where `trnment_id`='$trnmnt' && `status`='0'";
}
$result=$s->execute($qry);
$i=0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>::Nebu Football::</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<SCRIPT LANGUAGE="JavaScript" SRC="../javascript/CalendarPopup.js"></SCRIPT>        
        <script src="media/js/jquery.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
        
        <style type="text/css">
            @import "media/css/demo_table_jui.css";
            @import "media/themes/smoothness/jquery-ui-1.8.4.custom.css";
        </style>
        
        <style>
		#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	margin-left:-450px;
	
	}
	
	img{border:none;}
ul,li{
	margin:0;
	padding:0;
}
li{
	list-style:none;
	display:inline;
}
	
            *{
                font-family: arial;
            }
        </style>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[2, "desc"]],
                    "bJQueryUI":true
                });
            })
            
        </script>
<script type="text/javascript" language="javascript">
function Bpost(DestURL){
var ok=confirm("Are you sure you want to Block this?"); 
if (ok) {location.href = DestURL;} 
return ok; 
}
function Upost(DestURL){
var ok=confirm("Are you sure you want to Unblock this?"); 
if (ok) {location.href = DestURL;} 
return ok; 
}
function Dpost(DestURL){
var ok=confirm("Are you sure you want to delete this?"); 
if (ok) {location.href = DestURL;} 
return ok; 
}

/*function stat_check()
{
	if($('#scr1').val()=="")
	{
			alert("Enter team 1 score");
			//document.form4.scr1.focus;
			return false;
	}
	if($('#scr2').val()=="")
	{
			alert("Enter team 2 score");
			//document.form4.scr2.focus;
			return false;
	}
	if($('#poin1').val()=="")
	{
			alert("Enter team 1 points");
			//document.form4.poin1.focus;
			return false;
	}
	if($('#poin2').val()=="")
	{
			alert("Enter team 2 points");
			//document.form4.poin2.focus;
			return false;
	}
		
}//statchk
function add_chk()
{
	if($('#trnm_lst').val()==0)
	{
			alert("Select tournament name");
			//document.form4.poin2.focus;
			return false;
	}
	if($('#mtchnm').val()=="")
	{
			alert("Enter match name");
			//document.form4.poin2.focus;
			return false;
	}
	if($('#team_lst1').val()=="")
	{
			alert("Select Team 1");
			//document.form4.poin2.focus;
			return false;
	}
	if($('#team_lst2').val()=="")
	{
			alert("Select Team 2");
			//document.form4.poin2.focus;
			return false;
	}
	if(($('#team_lst1').val())==($('#team_lst2').val()))
	{
			alert("Selected Team 1 And Team 2 are same");
			//document.form1.team_lst1.focus;
			return false;
	}
}//addcheck*/
</script>
<script src="js/main.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="js/jquery-1.6.min.js"></script>-->
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<link rel="stylesheet" href="css/reveal.css">        
    <link href="css/style1.css" rel="stylesheet" type="text/css">
    </head>
<body>

<div id="main">

<div class="header"></div>

<div class="hd1">

<div style="float:right" class="lgt"><a href="home.php?d=1">Home</a>&nbsp;|&nbsp;<a href="logout.php"> Logout</a></div>
    <div class="lgt"><a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade">Add New</a>&nbsp;&nbsp; <a href="manage_match.php?sel=1&&trnmts=<?php echo $trnmnt;?>">Active</a> &nbsp;&nbsp;<a href="manage_match.php?sel=2&&trnmts=<?php echo $trnmnt;?>">Inactive</a></div>
    
  </div>
       <?php if($list_out==1)
{?> <div class="lgt"  style="padding-bottom:8px;">Active Lists</div><?php } elseif($list_out==2)
{?><div class="lgt"  style="padding-bottom:8px;">Inactive Lists</div><?php }?>
             <table id="datatables" class="display">
             <thead>
                                         
                    <tr>
                        <th width="2%"></th>
                        <th width="13%">Match Name</th>
                        <th width="32%">Teams</th>
                        <th width="23%">Venue</th>
                        <th width="12%">Date</th>
                        <th width="18%">Time</th>
                        <th width="18%">Options</th>                      
               </tr>
                </thead>
                <tbody>
<!--new -->            
<div id="myModal" class="reveal-modal" style="width:600px;">
<div id="frmContact">
<div id="mail-status"></div>
<a class="close-reveal-modal">&#215;</a>
<form action="manag_matchprocess.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<div class="ann_bx" style="width:600px;">
<div class="ann_bx1_top">Add Match Details</div>
<div class="ann_box1_center" style="width:600px;">
<div class="ann_bx1">
<input type="hidden" name="sel" value="<?php echo $list_out;?>" />
<input type="hidden" name="selct" value="new" />
<?php
$qry="SELECT `trn_id`,`trn_name` FROM `tournament` WHERE `status`='1'";
$trn_lists=$s->execute($qry);
?>
<div class="an_fld">
<div class="an_label">Tournament Name</div>
<div class="an_textfld">
<select name="trnm_lst" class="an_textfld2" required="true">
<option value="">--Select--</option>
<?php while($trn_list=mysql_fetch_array($trn_lists)){?>
<option value="<?php echo $trn_list[0];?>"><?php echo $trn_list[1];?></option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
</div>

<div class="an_fld">
<div class="an_label">Match Name</div>
<div class="an_textfld"><input type="text"  name="mtchnm" id="mtchnm"  class="an_textfld2" required="true"/></div>
<div style="clear:both"></div>
</div>
</div>

<?php
$qry="SELECT `tem_id`,`tem_name` FROM `team_master` WHERE `status`='1'";
$team_lists1=$s->execute($qry);
?>
<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Team 1</div>
<div class="an_textfld">
<select name="team_lst1" class="an_textfld2">
<option value="0">--Select--</option>
<?php while($team_list1=mysql_fetch_array($team_lists1)){?>
<option value="<?php echo $team_list1[0];?>"><?php echo $team_list1[1];?></option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
</div>
</div>

<?php
$qry="SELECT `tem_id`,`tem_name` FROM `team_master` WHERE `status`='1'";
$team_lists2=$s->execute($qry);
?>
<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Team 2</div>
<div class="an_textfld">
<select name="team_lst2" class="an_textfld2">
<option value="0">--Select--</option>
<?php while($team_list2=mysql_fetch_array($team_lists2)){?>
<option value="<?php echo $team_list2[0];?>"><?php echo $team_list2[1];?></option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
</div>
</div>

<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Venue</div>
<div class="an_textfld"><input type="text"  name="venue" id="venue"  class="an_textfld2"/></div>
<div style="clear:both"></div>
</div>
</div>

<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Date</div>
<div class="an_textfld"><input  name="date" type="text" id="date" size="20"/>
	<script language="JavaScript" type="text/javascript">
        var cal1x = new CalendarPopup();
        </script>
        <a href="#" onClick="cal1x.select(document.forms['form1'].date,'anchor1x','dd-MM-yyyy'); return false;" name="anchor1x" id="anchor1x"><img src="images/calendar_icon.gif" alt=""  border="0" /></a>
        <div id="testdiv1"></div>
</div>
<div style="clear:both"></div>
</div>
</div>

<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Time</div>
<div class="an_textfld">
<select name="hour">
 <option value="00">Select</option> 
        <?php for($x=1;$x<=12;$x++) { ?>        
            <option value="<?php echo $x ?>"><?php echo $x ?></option>  
        <?php } ?>
    </select> 
<select name="min">
<option value="00">-Select-</option>
        <?php for($m=00;$m<=60;$m++) { 
		?>          
            <option value="<?php echo $m ?>"><?php echo $m ?></option>  
           
        <?php } ?>
    </select> 
<select name="fxtim">
<option value=<?php echo "am";?>>AM</option>
<option value=<?php echo "pm";?>>PM</option></select>
</div>
<div style="clear:both"></div>
</div>
</div>


<div class="ann_submit"><input type="image" src="images/submit.png" name="submit" id="submit" value="Submit" onClick="sendContact();"/></div>
</div>

<div class="ann_box1_bottom"></div>

<div style="clear:both"></div>
</div>
</form>
</div>
</div>

<?php
while ($row = mysql_fetch_array($result))
{
	$i++;
?>
<tr>
<td></td>
<td><?php echo $row[2];?></td>
<td><table style="border-style:dotted">
  <?php 
$qry="SELECT `tem_name` FROM `team_master` WHERE `tem_id`='$row[4]'";
$team1_nm=$s->execute($qry);
$team1=mysql_fetch_array($team1_nm);
$qry="SELECT `tem_name` FROM `team_master` WHERE `tem_id`='$row[5]'";
$team2_nm=$s->execute($qry);
$team2=mysql_fetch_array($team2_nm);
?>
  <tr>
    <td colspan="3"><?php echo $team1[0];?></td>
    <td rowspan="3">X</td>
    <td colspan="3"><?php echo $team2[0];?></td>
  </tr>
  <tr>
    <td>score</td>
    <td>|</td>
    <td>points</td>
    <td>score</td>
    <td>|</td>
    <td>points</td>
  </tr>
  <tr>
    <td><?php echo $row[6];?></td>
    <td>&nbsp;</td>
    <td><?php echo $row[7];?></td>
    <td><?php echo $row[8];?></td>
    <td>&nbsp;</td>
    <td><?php echo $row[9];?></td>
  </tr>
</table></td>
<td><?php echo $row[11];?></td>
<td>

<?php 

if(($row[10]!=0000-00-00)&&($row[10]!="")){echo date("d-m-Y",strtotime($row[10]));}else{echo $row[10];} ?></td>
<td>
<?php
$datedisplay=trim($row[10]);
$dattime=explode(" ", $datedisplay);
if($dattime[1]!="00:00:00")
{
echo $time= date("g:i a", strtotime($dattime[1]));
}
?>
</td>


<td><a href="#" class="big-link" data-reveal-id="editing<?php echo $i;?>" data-animation="fade"><img src="images/edit.png" border="0" ></a>
<?php if($list_out==1){?><input type="image" onClick="Bpost('manag_matchprocess.php?bl_id=<?php echo $row[0];?>&& sel=<?php echo $list_out;?>&&trnmnt=<?php echo $trnmnt;?>')" src="images/block.png">
<?php }elseif($list_out==2){?>
    <input type="image" onClick="Upost('manag_matchprocess.php?un_id=<?php echo $row[0];?>&& sel=<?php echo $list_out;?>&&trnmnt=<?php echo $trnmnt;?>')" src="images/Capture-acpt.PNG">
  <?php }?>  
    <input type="image" onClick="Dpost('manag_matchprocess.php?dl_id=<?php echo $row[0];?>&& sel=<?php echo $list_out;?>&&trnmnt=<?php echo $trnmnt;?>')" src="images/delete.png">
    <a href="#" class="big-link" data-reveal-id="stat<?php echo $i;?>" data-animation="fade">
    <input type="image" src="../images/add_contact.jpg">
    </a>
 
 <div id="stat<?php echo $i;?>" class="reveal-modal" style="width:600px; ">
<a class="close-reveal-modal">&#215;</a>
<form action="manag_matchprocess.php" method="post" enctype="multipart/form-data" name="form4" id="form4">
<table width="439" border="0">
  <tr>
    <td colspan="3">Add Match Statistics</td>
  </tr><input type="hidden" name="mtc_id" id="mtc_id" value="<?php echo $row[0];?>"/>
  <tr><input type="hidden" name="selct" id="selct" value="statis"/>
  <input type="hidden" name="trnm" id="trnm" value="<?php echo $trnmnt;?>"/>
    <td width="115">&nbsp;</td>
    <td width="144" align="center">score</td>
    <td width="166" align="center">points</td>
  </tr>
  <tr>
    <td>Team <?php echo $team1[0];?></td>
    <td><input type="text" name="scr1" id="scr1" value="<?php echo $row[6];?>"/></td>
    <td><input type="text" name="poin1" id="poin1" value="<?php echo $row[7];?>"/></td>
  </tr>
  <tr>
    <td>Team <?php echo $team2[0];?></td>
    <td><input type="text" name="scr2" id="scr2"  value="<?php echo $row[8];?>"/></td>
    <td><input type="text" name="poin2" id="poin2"  value="<?php echo $row[9];?>"/></td>
  </tr>
  <tr>
    <td>Description 1</td>
    <td colspan="2"><textarea name="desc1" id="desc1" cols="45" rows="5"><?php echo $row[12];?></textarea></td>
    </tr>
  <tr>
    <td>Description 2</td>
    <td colspan="2"><textarea name="desc2" id="desc2" cols="45" rows="5"><?php echo $row[13];?></textarea></td>
  </tr>
   <tr>
    <td colspan="3" align="center"><input type="image" src="images/submit.png" name="submit" id="submit" value="Submit" onClick="return stat_check()"/></td>  </tr>
 
</table>
</form>
</div>


  </td>
</tr>
<!--edit-->
<div id="editing<?php echo $i;?>" class="reveal-modal" style="width:600px;">
<a class="close-reveal-modal">&#215;</a>
<form action="manag_matchprocess.php" method="post" enctype="multipart/form-data" name="form2" id="form2">
<div class="ann_bx" style="width:600px;">
<div class="ann_bx1_top">Edit Match Details</div>
<div class="ann_box1_center" style="width:600px;">
<div class="ann_bx1">
<input type="hidden" name="sel" value="<?php echo $list_out;?>" />
<input type="hidden" name="ids" value="<?php echo $row[0];?>" />
<?php
$qry="SELECT `trn_id`,`trn_name` FROM `tournament` WHERE `status`='1'";
$trn_lists=$s->execute($qry);
?>
<div class="an_fld">
<div class="an_label">Tournament Name</div>
<div class="an_textfld">
<select name="trnm_lst" class="an_textfld2">
<option value="<?php echo $row[1];?>"><?php echo $trnn[0];?></option>
<?php while($trn_list=mysql_fetch_array($trn_lists)){?>
<option value="<?php echo $trn_list[0];?>"><?php echo $trn_list[1];?></option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
</div>

<div class="an_fld">
<div class="an_label">Match Name</div>
<div class="an_textfld"><input type="text"  name="mtchnm" id="mtchnm"  class="an_textfld2" value="<?php echo $row[2]?>"/></div>
<div style="clear:both"></div>
</div>
</div>

<?php
$qry="SELECT `tem_id`,`tem_name` FROM `team_master` WHERE `status`='1'";
$team_lists1=$s->execute($qry);
?>
<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Team 1</div>
<div class="an_textfld">
<select name="team_lst1" class="an_textfld2">
<option value="<?php echo $row[4];?>"><?php echo $team1[0];?></option>
<?php while($team_list1=mysql_fetch_array($team_lists1)){?>
<option value="<?php echo $team_list1[0];?>"><?php echo $team_list1[1];?></option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
</div>
</div>

<?php
$qry="SELECT `tem_id`,`tem_name` FROM `team_master` WHERE `status`='1'";
$team_lists2=$s->execute($qry);
?>
<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Team 1</div>
<div class="an_textfld">
<select name="team_lst2" class="an_textfld2">
<option value="<?php echo $row[5];?>"><?php echo $team2[0];?></option>
<?php while($team_list2=mysql_fetch_array($team_lists2)){?>
<option value="<?php echo $team_list2[0];?>"><?php echo $team_list2[1];?></option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
</div>
</div>

<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Venue</div>
<div class="an_textfld"><input type="text"  name="venue" id="venue"  class="an_textfld2" value="<?php echo $row[11];?>"/></div>
<div style="clear:both"></div>
</div>
</div>

<?php
$datedisplay=trim($row[10]);
$dattime=explode(" ", $datedisplay);
?>
<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Date</div>
<div class="an_textfld"><input  name="date" type="text" id="date" size="20" value="<?php if(($dattime[0]!=0000-00-00)&&($dattime[0]!="")){echo date("d-m-Y",strtotime($dattime[0]));}?>"/>
	<script language="JavaScript" type="text/javascript">
        var cal1x = new CalendarPopup();
        </script>
        <a href="#" onClick="cal1x.select(document.forms['form2'].date,'anchor1x','dd-MM-yyyy'); return false;" name="anchor1x" id="anchor1x"><img src="images/calendar_icon.gif" alt=""  border="0" /></a>
        <div id="testdiv1"></div>
</div>
<div style="clear:both"></div>
</div>
</div>
<?php 
$time=date("g:i a", strtotime($dattime[1])); 
$hrmin=explode(":",$time);
 $sec=explode(" ",$hrmin[1])
?>
<div class="ann_bx1">
<div class="an_fld">
<div class="an_label">Time</div>
<div class="an_textfld">
<select name="hour">
 <option value=<?php echo $hrmin[0];?>><?php echo $hrmin[0];?></option> 
        <?php for($x=1;$x<=12;$x++) { ?>        
            <option value="<?php echo $x ?>"><?php echo $x ?></option>  
        <?php } ?>
    </select> 
<select name="min">
<option value=<?php echo $sec[0];?>><?php echo $sec[0];?></option>
        <?php for($m=00;$m<=60;$m++) { 
		?>          
            <option value="<?php echo $m ?>"><?php echo $m ?></option>  
           
        <?php } ?>
    </select> 
<select name="fxtim">
<option value=<?php echo $sec[1];?>><?php echo $sec[1];?></option>
<option value=<?php echo "am";?>>am</option>
<option value=<?php echo "pm";?>>pm</option></select>
</div>
<div style="clear:both"></div>
</div>
</div>



<div class="ann_submit"><input type="image" src="images/submit.png" name="submit" id="submit" value="Submit" /></div>
</div>

<div class="ann_box1_bottom"></div>

<div style="clear:both"></div>
</div>
</form>
</div>

<?php
}
?>


</tbody>


</table>


</div>
</body>
</html>
