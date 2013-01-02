<?php
class StatsComponent extends Component {

	public function twoSampleTTest($avg1, $avg2, $var1, $var2, $count1, $count2) {
		if(is_null($avg1) || is_null($avg2) || is_null($var1) || is_null($var2) || is_null($count1) || is_null($count2))
			return false;
		if($count1 == 0 || $count2 == 0)
			return false;
		if($var1 == 0 && $var2 == 0)
			return false;

		//ref: http://www.itl.nist.gov/div898/handbook/eda/section3/eda353.htm
		//Y = avg
		//s = var
		//N = count
		
		$Y = array($avg1, $avg2);
		$s = array($var1, $var2);
		$N = array($count1, $count2);
		
		$T = ($Y[0] - $Y[1])/sqrt($s[0]/$N[0] + $s[1]/$N[1]);
		$v = pow($s[0]/$N[0] + $s[1]/$N[1],2)/(pow($s[0]/$N[0],2)/($N[0]-1) + pow($s[1]/$N[1],2)/($N[1]-1));
		$p = (1 - stats_cdf_t($T, $v, 1)) * 2;
		return ($p > 1 ? 2-$p : $p);
		
	}

}

?>
