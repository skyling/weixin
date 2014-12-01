<?php
/**
 * 续借函数
 * @param unknown $certid 学号
 * @param ocidb $objoci
 * @return string
 */
function renew($certid,ocidb $objoci)  //$certid  学号//,$ct,$tele
{
	$strinfo = "";
	$strinfo1 = "";
	$strinfogz = "";
	$strinfocs = "";
	$strinfotj = "";
	$strinfoch = "";
	$strinfoyy = "";
	$strinfodq = "";
	$test = "";
	$date22 = "";
	$a = 0;
	$b = 0;
	$c = 0;
	$d = 0;
	$e = 0;
	$f = 0;
	$nowtime = date('Y-m-dH:i:s',time());
	$i = 0;
	$sql = "select a.name,a.dept,a.redr_type_code,a.lend_grd,a.volt_flag,a.debt_flag,a.total_lend_qty,a.year_lend_qty,a.redr_flag,a.redr_del_day,b.redr_type_name,b.chk_validity_period,b.max_lend_qty,b.max_debt_amt,b.max_preg_qty from reader a,reader_type b where a.cert_id='" . $certid . "' and a.redr_type_code=b.redr_type_code";

	$rs = $objoci->get_one($sql);;

	$name=$rs["NAME"];
	$dept=$rs["DEPT"];
	$redr_type_code = $rs["REDR_TYPE_CODE"];
	$lendgrd = $rs["LEND_GRD"];
	$volt_flag = $rs["VOLT_FLAG"];
	$debt_flag = $rs["DEBT_FLAG"];
	$total_lend_qty = $rs["TOTAL_LEND_QTY"];
	$year_lend_qty = $rs["YEAR_LEND_QTY"];
	$redr_flag = $rs["REDR_FLAG"];
	$redr_del_day = $rs["REDR_DEL_DAY"];
	$redr_type_name = $rs["REDR_TYPE_NAME"];
	$chk_validity_period = $rs["CHK_VALIDITY_PERIOD"];
	$max_lend_qty = $rs["MAX_LEND_QTY"];
	$max_preg_qty = $rs["MAX_PREG_QTY"];
	$max_debt_amt = $rs["MAX_DEBT_AMT"];


	if ($volt_flag != 0)
	{
		$strinfo = "有违章记录,不能续借!";
	}
	else
	{
		if ($debt_flag > $max_debt_amt)
		{
			$strinfo = "有超期款没交,不能续借!";
		}
		else
		{
			//	$counts = Convert.ToInt32(oracle.MyExecuteScalar("select count(*) from lend_lst where cert_id='" + $certid + "' and norm_ret_date<to_char(sysdate,'yyyy-mm-dd')"));
			$nowdate = date('Y-m-d',$nowtime);
			$sql = "select count(*) from lend_lst where cert_id='" . $certid . "' and norm_ret_date<to_char(sysdate,'yyyy-mm-dd')";
			$rcounts  = $objoci->get_one($sql);
			$counts = $rcounts[0];
			if ($counts > 0)
			{
				$strinfo = "有超期书,不能续借!";
			}
			else
			{
				//		counts = C(oracle.MyExecuteScalar("select count(*) from lend_lst where cert_id='" + $certid + "'"));
				$sql  = "select count(*) from lend_lst where cert_id='" . $certid . "'";
				$rcounts = $objoci->get_one($sql);
				$counts = $rcounts[0];
				if ($counts > $max_lend_qty)
				{
					$strinfo = "借书数已满,不能续借!";
				}
				else
				{
					if ($counts == 0)
					{
						$strinfo = "您没有借阅记录,不能续借!";
					}
					else
					{
						$sql = "select a.norm_ret_date,a.renew_date,a.renew_times,a.asback_date,a.asback_times,a.location_f,a.rule_no_f,b.book_stat_code,b.call_no,b.prop_no from lend_lst a,item b where a.cert_id='" . $certid . "' and a.prop_no=b.prop_no";
						//	OracleDataReader rs1 = oracle.MyOracleDataReader(sql);
						$rs1 = $objoci->get_all($sql);
						$k=0;
						while ($rs1[$k])
						{
							$norm_ret_date = $rs1[$k][0];
							$renew_date = $rs1[$k][1];
							$renew_times = $rs1[$k][2];
							$asback_times = $rs1[$k][4];
							$location_f = $rs1[$k][5];
							$rule_no_f = $rs1[$k][6];
							$book_stat_code = $rs1[$k][7];
							$callno = $rs1[$k][8];
							$propno = $rs1[$k][9];
							$k++;
							$sql1 = "select a.lend_grd,a.circ_type_code from call_no_lst a where call_no='" . $callno . "'";
							$rs2 = $objoci->get_one($sql1);
							//	DataRow rs2 = oracle.ReturnDataRow(sql1);
							$lend_grd1 = $rs2["LEND_GRD"];
							$circ_type_code = $rs2["CIRC_TYPE_CODE"];
							if ($lendgrd < $lend_grd1)
							{
								$strinfo = "您的借阅等级不够,不能续借!";
							}
							else
							{
								$sql2 = "select rule_no,to_char(sysdate,'yyyy-mm-dd') as today FROM rule_comp WHERE no=(SELECT MAX(no) FROM rule_comp WHERE (circ_type_code_c = '*' or circ_type_code_c like '" . $circ_type_code . "%' or circ_type_code_c like '%" . $circ_type_code . "%') AND (redr_type_code_c = '*' or redr_type_code_c like '" . $redr_type_code . "%' or redr_type_code_c like '%" . $redr_type_code . "%' ) AND (loca_code_c = '*' or loca_code_c like '" . $location_f . "%' or loca_code_c like '%" . $location_f . "%') )";
								//DataRow rs3 = oracle.ReturnDataRow(sql2);
								$rs3 = $objoci->get_one($sql2);
								$rule_no = $rs3["RULE_NO"];
								$today = $rs3["TODAY"];
								$sql3 = "select renew_ysno,max_renew_times,min_use_days,renew_bef_exp_days,renew_calc_flag,fst_renew_days,add_renew_days from circ_rule where rule_no='" . $rule_no . "'";
								//	DataRow rs4 = oracle.ReturnDataRow(sql3);
								$rs4 = $objoci->get_one($sql3);
								$renew_ysno = $rs4["RENEW_YSNO"];
								$max_renew_times = $rs4["MAX_RENEW_TIMES"];
								$min_use_days = $rs4["MIN_USE_DAYS"];
								$renew_bef_exp_days = $rs4["RENEW_BEF_EXP_DAYS"];
								$renew_calc_flag = $rs4["RENEW_CALC_FLAG"];
								$fst_renew_days = $rs4["FST_RENEW_DAYS"];
								$add_renew_days = $rs4["ADD_RENEW_DAYS"];
								if ($renew_ysno == "0")
								{
									//$strinfo = $strinfo + "条码为'" + propno + "'借阅规则不允许续借!";
									$strinfogz=$strinfogz . $propno ."|";
									$a = $a + 1;
								}
								else
								{
									if ($max_renew_times <= $renew_times)
									{
										//$strinfo = $strinfo + "条码为'" + propno + "'超过最大续借次数,不能续借!";
										$strinfocs = $strinfocs . $propno . "|";
										$b = $b + 1;
									}
									else
									{
										if ($book_stat_code == "3C")
										{
											//$strinfo = $strinfo + "条码为'" + propno + "'的书被停借,不能续借!";
											$strinfotj = $strinfotj . $propno . "|";
											$c = $c + 1;
										}
										else
										{
											if ($asback_times > 0)
											{
												//$strinfo = $strinfo + "条码为'" + propno + "'的书被催还,不能续借!";
												$strinfoch = $strinfoch .  $propno . "|";
												$d = $d + 1;
											}
											else
											{
												$sql4 = "SELECT count(*) FROM call_no_lst,preg_lst WHERE call_no_lst.call_no = preg_lst.call_no AND preg_lst.call_no ='" . $callno . "' and preg_lst.location ='" . $location_f . "' and  preg_lst.PREG_END_DATE>to_char(sysdate,'yyyy-mm-dd')";
												$rcounts = $objoci->get_one($sql4);
												$counts =$rcounts[0];
												//counts = Convert.ToInt32(oracle.MyExecuteScalar(sql4));
												if ($counts > 0)
												{
													//$strinfo = $strinfo + "条码为'" + propno + "'的被预约,不能续借!";
													$strinfoyy = $strinfoyy .  $propno  . "|";
													$e = $e + 1;
												}
												else
												{
													$date1 = strtotime($today);
													$date1 = $date1+24*60*60;
													$date1 = $date1+$renew_bef_exp_days*24*60*60;
													if ($date1 < strtotime($norm_ret_date))
													{
														// $strinfo = $strinfo + "条码为'" + propno + "'的还没达到续借期,不能续借!";
														$strinfodq = $strinfodq . $propno . "|";
														$f = $f + 1;
													}
													else
													{
														if ($renew_calc_flag == "1")
														{
															$date2 = strtotime($norm_ret_date);
															$date2 = $date2+($fst_renew_days*24*60*60);
															$date22 = closeday(date('Y-m-d',$date2), $location_f,$objoci);
															$i = $i + 1;
															$test = $test . "条码为" . $propno . "的书的归还日期为" . $date22."\n";
															$strinfo1 = "您有" . $i . "本书续借成功!";
														}
														else
														{
															$date3 = date($today);
															$date3 = $date3+$fst_renew_days*24*60*60;
															$date22 = closeday(date('Y-m-d',$date3), $location_f,$objoci);
															$strinfo = $date22;
														}
														$objoci->query("update lend_lst set renew_times=renew_times+1,norm_ret_date='" . $date22 . "',renew_date='" . $today . "' where cert_id='" . $certid . "' and prop_no='" . $propno . "'");
														$objoci->query("update item set year_circ_times=year_circ_times+1,total_circ_times=total_circ_times+1,last_use_date='" . $today . "' where prop_no='" . $propno . "'");
														$objoci->query("update call_no_lst set year_circ_times=year_circ_times+1,total_circ_times=total_circ_times+1 where call_no='" . $callno . "'");
													}

												}
											}

										}

									}

								}
							}
						}
					}

				}
			}

		}

	}

	if ($i > 0)
	{
		$strinfo = $test.$strinfo1;
	}
	else
	{
		$strinfo = "抱歉,您有书因故不能续借。原因如下:\n".$strinfo;
		if ($a > 0)
		{
			$strinfo = $strinfo . "有" . $a . "本书规则不允许!\n";
		}
		if ($b > 0)
		{
			$strinfo = $strinfo . "有" .$b. "本书已超过最大续借次数!\n";
		}
		if ($c > 0)
		{
			$strinfo = $strinfo . "有" .$c. "本书已停借\n";
		}
		if ($d > 0)
		{
			$strinfo = $strinfo . "有" . $d . "本书已催还!\n";
		}
		if ($e > 0)
		{
			$strinfo = $strinfo . "有" . $e . "本书已被预约!\n";
		}
		if ($f > 0)
		{
			$strinfo = $strinfo . "有" . $f . "本还没到续借期!\n";
		}
			
	}
	return $strinfo;

}


function closeday($date, $location,ocidb $objoci)
{

	$sql = "SELECT count(*) FROM  CLOSE_DAY WHERE location='" . $location . "' and close_bgn_day<='" . $date . "'  and close_end_day>='" . $date . "'";
	$rs = $objoci->get_one($sql);
	$counts = $rs[0];
	$sql = "SELECT CLOSE_BGN_DAY,CLOSE_END_DAY,EXT_DAYS FROM  CLOSE_DAY WHERE location='" . $location . "' and close_bgn_day<='" . $date . "'  and close_end_day>='" . $date . "'";
	if ($counts > 0)
	{
		$dtr = $objoci->get_one($sql);
		$close_bgn_day = $dtr["CLOSE_BGN_DAY"];
		$close_end_day = $dtr["CLOSE_END_DAY"];
		$ext_days = $dtr["EXT_DAYS"];
		$endday = strtotime($close_end_day);
		$endday = $endday+($ext_days+1)*24*60*60;
		$enddayStr = date('Y-m-d',$endday);
		return $enddayStr;
	}
	else
	{
		return $date;
	}

}


?>