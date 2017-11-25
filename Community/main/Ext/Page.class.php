<?php
/**
 * class of page
 *
 * @author assnr <ycassnr@gmail.com>
 */
class Page {
    // 总行数
    protected $totalRows;
    // 每页显示行数
    protected $listRows;
    // 分页参数
    protected $p = 'page';

    protected $firstRows;

    public $totalPages;

    public $nowPage;

    protected $rollPage = 9;

    protected $url;

    protected $config = array(
        // 1
        // 'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        // 'prev'   => '<',
        // 'next'   => '>',
        // 'first'  => '首页',
        // 'last'   => '末页',
        // 'theme'  => '%UP_PAGE% %FIRST% %LINK_PAGE% %END% %DOWN_PAGE%',

        // 2 bootstrap
        'header' => '',
        'prev'   => '«',
        'next'   => '»',
        'first'  => '首页',
        'last'   => '末页',
        'theme'  => '%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%',
    );

    /**
     * construct.
     *
     * @param integer $totalRows totalRows.
     * @param integer $listRows  listRows.
     * @param string  $urlParams urlParams.
     *
     * @return void
     */
    public function __construct($totalRows, $listRows, $urlParams = '')
    {
        if ($urlParams) :
            $this->p = $urlParams;
        endif;

        $this->totalRows = $totalRows;
        $this->listRows = $listRows;
        $this->nowPage = (!arGet($this->p) || arGet($this->p) < 1) ? 1 : intval(arGet($this->p));
        $this->totalPages = ceil($this->totalRows/$this->listRows);

        if ($this->nowPage > $this->totalPages && $this->totalPages > 0)
            $this->nowPage = $this->totalPages;

        $this->firstRows = ($this->nowPage - 1) * $this->listRows;

    }

    /**
     * set param value.
     *
     * @return mixed
     */
    public function __set($name, $value)
    {
        return property_exists($this, $name) ? $this->$name = $value : '';

    }


    /**
     * set param config values.
     *
     * @return mixed
     */
    public function setConfig($key, $value)
    {
        return array_key_exists($key, $this->config) ? $this->config[$key] = $value : $this->config = $value;

    }

    /**
     * generate url.
     *
     * @return string
     */
    protected function generationUrl($page)
    {
        return arU('', array('page' => $page, 'greedyUrl' => true));

    }

    /**
     * data limit
     *
     */
    public function limit()
    {
        return $this->firstRows . ',' . $this->listRows;

    }

    /**
     * show page html data.
     *
     * @return string
     */
    public function show()
    {
        $pageStr = '';
        if ($this->totalRows == 0)
            return '';

        // firstPage
        $firstPage = '';
        if ($this->nowPage != 1)
            $firstPage = '<li><a title="首页" href="' . $this->generationUrl(1) . '" class="first">' . $this->config['first'] . '</a></li>';

        // up page
        $upPage = '';
        if ($this->nowPage > 1)
            $upPage = '<li><a title="上一页" href="' . $this->generationUrl($this->nowPage - 1) . '" class="prev">'. $this->config['prev']  . '</a></li>';

        // next page
        $nextPage = '';
        if ($this->nowPage < $this->totalPages)
            $nextPage = '<li><a title="下一页" href="' . $this->generationUrl($this->nowPage + 1) . '" class="next">'. $this->config['next']  . '</a></li>';

        // end page
        $endPage = '';
        if ($this->nowPage != $this->totalPages)
            $endPage = '<li><a title="点开有惊喜" href="' . $this->generationUrl($this->totalPages) . '" class="end">'. $this->config['last']  . '</a></li>';

        $halfRollPage = $this->rollPage/2;
        $halfRollPageCeil = ceil($halfRollPage);
        $page = 0;
        $linkPage = '';

        $lellipsis = $rellipsis = '<li><span class="ellipsis">...</span></li>';
        if ($this->totalPages <= $this->rollPage)
            $lellipsis = $rellipsis = '';

        for ($i = 1; $i <= $this->rollPage; $i ++) :
            if ($this->nowPage <= $halfRollPageCeil) :
                $page = $i;
                $lellipsis = '';
            elseif ($this->nowPage + $halfRollPageCeil - 1 >= $this->totalPages) :
                $page = $this->totalPages - $this->rollPage  + $i;
                $rellipsis = '';
            else :
                $page = $this->nowPage - $halfRollPageCeil + $i;
            endif;

            if ($page > 0 && $page != $this->nowPage) :
                if ($page < $this->totalPages)
                    $linkPage .= '<li><a href="' . $this->generationUrl($page) . '" class="num">' . $page . '</a></li>';
                else
                    break;
            else :
                if ($page > 0)
                    $linkPage .= '<li class="active"><span class="current">' . $page . '</span></li>';
            endif;
        endfor;
        $linkPage = $lellipsis . $linkPage . $rellipsis;

        $pageStr = str_replace(
            array(
                '%HEADER%',
                '%NOW_PAGE%',
                '%UP_PAGE%',
                '%DOWN_PAGE%',
                '%FIRST%',
                '%LINK_PAGE%',
                '%END%',
                '%TOTAL_ROW%',
                '%TOTAL_PAGE%'
            ),
            array(
                $this->config['header'],
                $this->nowPage,
                $upPage,
                $nextPage,
                $firstPage,
                $linkPage,
                $endPage,
                $this->totalRows,
                $this->totalPages
            ),
            $this->config['theme']);
        return '<ul class="pagination">' . $pageStr . '</ul>';

    }

}
