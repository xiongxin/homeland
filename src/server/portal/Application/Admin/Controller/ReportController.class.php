<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 行为控制器
 * @author huajie <banhuajie@163.com>
 */
class  ReportController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */


	public function _initialize(){
		parent:: _initialize();
	}
	public function candidate(){
		$map = [];
		$edate = '';
		if(empty(I('sdate')))
		{
			$sdate = date('Y-m-01');
			//$map['stat_date'] = ['EGT',$sdate];
			$where = "stat_date >='$sdate' ";
		}else{
			$sdate = I('sdate'); 
			//$map['stat_date'] = ['EGT',$sdate];
			$where = " stat_date >='$sdate' ";
		}
		if(!empty(I('edate')))
		{
			$edate = I('edate'); 
			$where .= " and stat_date <='$edate' ";
			//$map['stat_date'] = ['ELT',$edate];
		}
		$list =$this->lists('tjfx_candidate_add_daily',$where,'stat_date desc');
		$this->assign('_list', $list);
		$this->assign('sdate', $sdate);
		$this->assign('edate', $edate);
		$this->meta_title = '新增线上非会员统计';
		$this->display();
	}
	public function share(){
		$map = [];
		$edate = '';
		if(empty(I('sdate')))
		{
			$sdate = date('Y-m-01');
			$where = " stat_date >='$sdate' ";
			//$map['stat_date'] = ['EGT',$sdate];
		}else{
			$sdate = I('sdate'); 
			$where = " stat_date >='$sdate' ";
			//$map['stat_date'] = ['EGT',$sdate];
		}
		if(!empty(I('edate')))
		{
			$edate = I('edate'); 
			//$map['etat_date'] = ['ELT',$edate];
			$where .= " and  stat_date <='$edate' ";
		}
		$m  = M('tjfx_share_stat_hourly')->group('stat_date');
		$list =$this->lists($m ,$where,'stat_date desc',"sum(baby_wonderful_share_count) as baby_wonderful_share_count,sum(baby_mature_share_count) as baby_mature_share_count,sum(baby_appointment_share_count) as baby_appointment_share_count,stat_date");
		$this->assign('_list', $list);
		$this->assign('sdate', $sdate);
		$this->assign('edate', $edate);
		$this->meta_title = '分享统计';
		$this->display();
	}
	function interlocution()
	{
		$map = [];
		$edate = '';
		if(empty(I('sdate')))
		{
			$sdate = date('Y-m-01');
			$where = " stat_date >='$sdate' ";
			//$map['stat_date'] = ['EGT',$sdate];
		}else{
			$sdate = I('sdate'); 
			//$map['stat_date'] = ['EGT',$sdate];
			$where = " stat_date >='$sdate' ";
		}
		if(!empty(I('edate')))
		{
			$edate = I('edate'); 
			$where .= " and stat_date <='$edate' ";
			//$map['etat_date'] = ['ELT',$edate];
		}

		$m  = M('tjfx_interlocution_hourly')->group('stat_date');
		$list =$this->lists($m ,$where,'stat_date desc',"sum(question_count) as question_count,sum(answer_count) as answer_count ,stat_date");
		$this->assign('_list', $list);
		$this->assign('sdate', $sdate);
		$this->assign('edate', $edate);
		$this->meta_title = '宝宝问答访问统计';
		$this->display();
	}
	function courseSpend()
	{
		if(empty(I('stat_year')))
		{
			$year= date('Y');
		}else{
			$year= I('stat_year');
		}
		if(empty(I('stat_month')))
		{
			$month= date('m');
		}else{
			$month= I('stat_month');;
		}
		$m  = M('tjfx_course_spend_stat_monthly');
		$list =$this->lists($m ,['stat_year'=>$year,'stat_month'=>$month],'order_id');
		$this->assign('_list', $list);
		$this->meta_title = '耗课统计';
		$this->assign('stat_year', $year);
		$this->assign('stat_month', $month);
		$this->display();
	}
}
