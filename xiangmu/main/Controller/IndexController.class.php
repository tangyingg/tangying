<?php
/**
 * Powerd by ArPHP.
 *
 * Controller.
 *
 * @author ycassnr <ycassnr@gmail.com>
 */

/**
 * Default Controller of webapp.
 */
class IndexController extends ArController {

    /**
     * just the example of get contents.
     *
     * @return void
     */
    public function init(){
		if(!isset($_SESSION)){
			session_start();
		}
		$this->setLayoutFile('index');
	}

	public function indexAction()
	{
		
		$this->display();

	}
	public function loginAction()
	{
		// 设置头文件
		$this->setLayoutFile('pub');
		if ($data = arPost()) :
			// 匹配数据库里是否存在输入值
			if (PollingModel::model()->getDb()->where(array('tel' => $data['dianhua']))->count() > 0) :
				// 这个'login',可能有问题。改之前是index
				$this->redirectError('login', '您已经报名');
			endif;
			if($ref=$data['tuijianren']) :
				if (PollingModel::model()->getDb()->where(array('tel' => $ref))->count() == 0) :
					// 这个'login',可能有问题。改之前是index
					$this->redirectError('login', '推荐人不存在');
				endif;
			endif;

			$time=date('Y-m-d h:m:s');
			// addUserResult变量名
			$addUserResult = PollingModel::model()->getDb()->insert(array('name'=>$data['xingming'],'tel'=>$data['dianhua'],'refereetel'=>$data['tuijianren'],'datetime'=>$time));
			if ($addUserResult) :
				// 下面两处login改之前均为index
				$this->redirectSuccess('login', '报名成功',20);
			else :
				$this->redirectError('login', '报名失败',5);
			endif;
		else :
			// 获取polling数据表中id总数
			$totalCount = PollingModel::model()->getDb()->count();
			$this->assign(array('totalCount' => $totalCount));
			$this->display();
		endif;
		
	}



    public function listAction()
	{
		/**对获取的数据进行分页**/
		//先获取总行数
		$totalRows=PollingModel::model()->getDb()->count();
		//再执行分页函数
		$page = new Page($totalRows,10);
		//对所有数据执行分页
		$view=PollingModel::model()->getDb()->limit($page->limit())->queryAll();
		/*分页结束*/
		//执行数据传输
	    $this->assign(array('pollings' => $view,'page'=>$page));
		$this->display();

	}


	public function hpagAction()
	{

		$this->display();

	}



}