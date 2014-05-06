<?PHP
	function GetVote($type){
		$ccount = (int)M('community')->where('cstatus = 1')->count();
		$vdata = array();
		$td = array('cid' => 0, 'cname' => '', 'count' =>0);
		for ($i=0; $i < $ccount ; $i++){
			$c = get_cid_vote_count($i,$type);
			if ( $c != 0 ){
				$td['cid'] = $i;
				$td['cname'] = a_getcname($i);
				$td['count'] = $c;
				array_push($vdata,$td);
			}
		}
		return $vdata;
	}

	function get_cid_vote_count($cid,$type){
		return (int)M('vote')->where('cid = ' . $cid . ' and vtype = '.$type)->count();
	}