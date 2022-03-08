<?php
include("../class/class.php");
$s=new nebu();
$selpost=trim($_POST['sel']);
$selgt=trim($_GET['sel']);
$trn=$_GET['trnmnt'];
if($selpost!="")
{
	$list_out=$selpost;
}
elseif($selgt!="")
{
	$list_out=$selgt;
}
else
{
	$list_out=1;
}
$sel_trn=$_POST['selct'];
$idds=$_POST['ids'];
$del=$_GET['dl_id'];
$blk=$_GET['bl_id'];
$unblk=$_GET['un_id'];
if($sel_trn=="new")
{
	$trnm_lst=$_POST['trnm_lst'];
	$mtchnm=$_POST['mtchnm'];
	$team_lst1=$_POST['team_lst1'];
	$team_lst2=$_POST['team_lst2'];
	$venue=$_POST['venue'];
	$date=$_POST['date'];
	if($date!=="")
	{
	$date_m=date("Y-m-d",strtotime($date));
	}
	 $hr=$_POST['hour'];
	 $min=$_POST['min'];
	 $fxtim=$_POST['fxtim'];
	 $time=$hr.":".$min." ".$fxtim;
	 $timeis=date("H:i", strtotime("$time"));
	 
	 $datetim=$date_m." ".$timeis;
	 
if($trnm_lst=="0")
		{
		header("location:manage_match.php?id=3&&sel=$list_out&&trnmts=$trnm_lst");
		}
		else
		{
$qry="insert into `matches` (`trnment_id`,`match-name`,`teamcode1`,`teamcode2`,`date`,`venue`,`status`)values('$trnm_lst','$mtchnm','$team_lst1','$team_lst2','$datetim','$venue','1')";
		$result=$s->execute($qry);
			header("location:manage_match.php?id=5&&sel=$list_out&&trnmts=$trnm_lst");
		}
}//if($sel_anounc=="new")
if($idds!="")
{
$trnm_lst=$_POST['trnm_lst'];
	$mtchnm=$_POST['mtchnm'];
	$team_lst1=$_POST['team_lst1'];
	$team_lst2=$_POST['team_lst2'];
	$venue=$_POST['venue'];
	$date=$_POST['date'];
	if($date!="")
	{
	$date_m=date("Y-m-d",strtotime($date));
	}
	
	$hr=$_POST['hour'];
	 $min=$_POST['min'];
	 $fxtim=$_POST['fxtim'];
	 $time=$hr.":".$min." ".$fxtim;
	 $timeis=date("H:i", strtotime("$time"));
	 
	 $datetim=$date_m." ".$timeis;
	if($trnm_lst=="")
		{
		header("location:manage_match.php?id=3&&sel=$list_out&&trnmts=$trnm_lst");
		}
		else
		{
			$qry="update `matches` set `trnment_id`='$trnm_lst',`match-name`='$mtchnm',`teamcode1`='$team_lst1',`teamcode2`='$team_lst2',`date`='$datetim',`venue`='$venue' where `match-id`='$idds'";
		$result=$s->execute($qry);
			header("location:manage_match.php?id=5&&sel=$list_out&&trnmts=$trnm_lst");
		}
}//if($sel_anounc=="edit")
elseif($sel_trn=="statis")
{
	$trnm=$_POST['trnm'];
	$mtch_id=$_POST['mtc_id'];
	$scr1=trim($_POST['scr1']);
	$scr2=trim($_POST['scr2']);
	$poin1=trim($_POST['poin1']);
	$poin2=trim($_POST['poin2']);
	$desc1=$_POST['desc1'];
	$desc2=$_POST['desc2'];
	if(($scr1=="")&&($scr2=="")&&($poin1=="")&&($poin2==""))
	{
	$qry="update `matches` set `team1_score`='$scr1',`team1_point`='$poin1',`team2_score`='$scr2',`team2_point`='$poin2',`mtch_desc1`='$desc1',`mtch_desc2`='$desc2',`statusplyd`='0' where `match-id`='$mtch_id'";
	}
	else
	{
	$qry="update `matches` set `team1_score`='$scr1',`team1_point`='$poin1',`team2_score`='$scr2',`team2_point`='$poin2',`mtch_desc1`='$desc1',`mtch_desc2`='$desc2',`statusplyd`='1' where `match-id`='$mtch_id'";
	}
		$result_m=$s->execute($qry);
			header("location:manage_match.php?id=5&&sel=$list_out&&trnmts=$trnm");
	
}
elseif($del!="")
{
$del_id=$_GET['dl_id'];
		$qry="update `matches` set `status`='2' where `match-id`='$del_id'";
		$name=$s->execute($qry);
		header("location:manage_match.php?sel=$list_out&&trnmts=$trn");
}
elseif($blk!="")
{
$blk=$_GET['bl_id'];
		$qry="update `matches` set `status`='0' where `match-id`='$blk'";
		$name=$s->execute($qry);
		header("location:manage_match.php?sel=$list_out&&trnmts=$trn");
}
elseif($unblk!="")
{
	$unblk=$_GET['un_id'];
	$qry="update `matches` set `status`='1' where `match-id`='$unblk'";
		$name=$s->execute($qry);
		header("location:manage_match.php?sel=$list_out&&trnmts=$trn");
}
?>