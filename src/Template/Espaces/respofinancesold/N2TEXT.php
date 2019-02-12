<?php
/******************************************
*class to convert the number into french text
*******************************************/
class ConvertNumberToText{
	private $unite = array("zéro","un","deux","trois","quatre","cinq","six","sept","huit","neuf");
	private $dix = array("dix","onze","douze","treize","quatorze","quinze","seize","dix sept","dix huit","dix neuf");
	private $disaine = array(1=>"dix","vingt","trante","quarante","cinquante","soixante","soixante dix","quatre-vingt","quatre-vingt dix");
	private $other = array(1=>"mille","million","milliard","billion","billiard","trillion","trilliard"/*,"quadrillion",
							"quadrilliard","quintillion","quintilliard","sextillion","sextilliard","septillion",
							"septilliard","octillion","octilliard","nonillion","nonilliard","décillion","décilliard"*/
						);
	public function Convert($number){
		$number = preg_replace(array("/ /"),array(""),$number);
		$string="";# var_dump($number);
		$number = (string)$number; #echo $number."<br>";
		if(strlen($number)>24) return "Le nombre à traiter est trop grand";
		#var_dump($number); echo "<br>";
		$counter = strlen($number)/3; $to_be_converted = array(); $n=""; $count=0;
		if(strlen($number)%3 == 0 && $counter !=0) $counter -= 1;
		for($i=strlen($number)-1; $i>=0;$i--){
			#echo $number[0]."<br>";
			if($count != 0 && $count%3 == 0){
				/* convert this and continue to the next if any */
				$to_be_converted[$counter] = strrev($n);
				$n = ""; $counter--;
			}
			$n .= $number[$i];
			$count++;
		}
		$to_be_converted[$counter] = strrev($n);
		//sort($to_be_converted);
		#var_dump($to_be_converted); echo"<br>";
		/* start conversation */
		$switch = count($to_be_converted)-1;$nmbr="";# echo $switch;
		for($i=0;$i<count($to_be_converted);$i++){
			$nmbr .= $to_be_converted[$i];
			$valid = false;
			if(count($to_be_converted)-1 != $i) $nmbr .= " ";
			/* each string will be converted independently */
			$string .= ConvertNumberToText::convertHundrends($to_be_converted[$i],$valid);
			/* add the range of counting */
			if($valid){
				#var_dump($this->other);
				#echo $switch;
				$string .= " ".@$this->other[$switch]." ";# break;
			}
			/* decrement the counter */
			$switch--;
		}
		//var_dump($this->unite);
		//echo strlen($number);
		return ucfirst($string."(<b>".$nmbr."</b>)");
	}
	private function convertHundrends($number, &$valid){
		#var_dump((int)$number); echo "<br>";
		$rtn=""; $start = true;
		if((int)$number != 0) $valid = true;
		#var_dump($valid);
		switch(strlen($number)){
			case 3:
				if($number[0] !=0){
					if($number[0] == 1){
						$rtn .= "cent ";
					} else{
						$rtn .= $this->unite[$number[0]]." cent ";
						//$start = false;
					}
				}
				$start = false;
			case 2:
				#echo $number[1];
				if(!$start){
					if($number[1] != 0){
						if($number[1] != 1 && $number[1] != 7 && $number[1] != 9){
							$rtn .= $this->disaine[$number[1]]." ";
						}
					}
				} else{
					if($number[0] != 0){
						if($number[0] != 1 && $number[0] != 7 && $number[0] != 9){
							$rtn .= $this->disaine[$number[0]]." ";
						}
					}
				}
			case 1:
				if(@$number[2] != NULL){
					if($number[1] == 1){
						$rtn .= $this->dix[$number[2]];
					} elseif($number[1] == 7){
						$rtn .= "soixante ".$this->dix[$number[2]];
					} elseif($number[1] == 9){
						$rtn .= "quatre-vingt ".$this->dix[$number[2]];
					} else{
						if($number[2] !=0) $rtn .= $this->unite[$number[2]]." ";
					}
				} elseif(@$number[2] == NULL && @$number[1] != NULL){
					if($number[0] == 1){
						$rtn .= $this->dix[$number[1]];
					} elseif($number[0] == 7){
						$rtn .= "soixante ".$this->dix[$number[1]];
					} elseif($number[0] == 9){
						$rtn .= "quatre-vingt ".$this->dix[$number[1]];
					} else{
						$rtn .= $this->unite[$number[1]]." ";
					}
				} else{
					$rtn .= $this->unite[$number[0]]." ";
				}
			default:
		}/*
		if(@$number[2] != "" && $number[0]!=0){
			if($number[0] == 1) $rtn .="cent ";
			else $rtn .= $this->unite[$number[0]]." cent "; #goto rtn;
		}
		//var_dump($number);
		if(@$number[1] && $number[1] != 0 && $number[0] != ""){
			//var_dump($number[1]);
			if(@$number[2] != ""){
				if($number[1] != 1) $rtn .= $this->disaine[$number[1]]." ";
				elseif($number[1] != 1 && $number[2] !=0){
					$rtn .= $this->disaine[$number[2]]." ";
					goto rtn;
				}
				if($number[2] != 0) $rtn .= $this->unite[$number[2]]." ";
				goto rtn;
			}/*
			if($number[0] != 1 && $number[0] != 9 && $number[0] != 7) $rtn .= $this->disaine[$number[0]]." ";
			else{
				if($number[0] == 7){
					if($number[1] == 0) $rtn .= $this->disaine[$number[0]]." ";
					elseif($number[1]<=6) $rtn .= "soixante ".$this->dix[$number[1]];
					goto rtn;
				} elseif($number[0] == 0){
					$rtn .= $this->disaine[$number[0]]." ";
					goto rtn;
				} elseif($number[0]<6){
					$rtn .= $this->dix[$number[0]]." ";
					goto rtn;
				} else{
					$rtn .= "dix-".$this->unite[$number[0]]." ";
					goto rtn;
				}
			}/
		}
		if(@$number[1] == null){
			if($number[0] != null) $rtn .= $this->unite[$number[0]]." ";
		}*/
		rtn:
		return $rtn;
	}
}
?>