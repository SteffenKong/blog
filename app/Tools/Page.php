<?php

namespace App\Tools;

/**
 * Class Page
 * 分页类
 */
class Page {

//    private $total;     //数据总数
//    private $url;       //跳转的url
//    private $current;   //当前页
//    private $offset;    //偏移量
//    private $pagesize;  //每页显示的条数
//
//    public function __construct($total,$current,$url,$pagesize=5)
//    {
//        $this->total = $total;
//        $this->url = $url;
//        $this->current = $current;
//        $this->pagesize = $pagesize;
//        $this->offset = ($this->current-1)*$pagesize;
//    }
//
//
//    public function  ShowPage(){
//        echo $this->getPageHtml($this->total,$this->current,$this->url);
//    }

    /**
     * 获取分页的HTML内容
     * @param integer $page 当前页
     * @param integer $pages 总页数
     * @param string $url 跳转url地址    最后的页数以 '&page=x' 追加在url后面
     *
     * @param int $pageNum
     * @return string HTML内容;
     */
    public static function getPageHtml($page, $pages, $url,$pageNum = 5){
        //最多显示多少个页码
        $_pageNum = $pageNum;
        //当前页面小于1 则为1
        $page = $page<1?1:$page;
        //当前页大于总页数 则为总页数
        $page = $page > $pages ? $pages : $page;
        //页数小当前页 则为当前页
        $pages = $pages < $page ? $page : $pages;

        //计算开始页
        $_start = $page - floor($_pageNum/2);
        $_start = $_start<1 ? 1 : $_start;
        //计算结束页;
        $_end = $page + floor($_pageNum/2);
        $_end = $_end>$pages? $pages : $_end;

        //当前显示的页码个数不够最大页码数，在进行左右调整
        $_curPageNum = $_end-$_start+1;
        //左调整
        if($_curPageNum<$_pageNum && $_start>1){
            $_start = $_start - ($_pageNum-$_curPageNum);
            $_start = $_start<1 ? 1 : $_start;
            $_curPageNum = $_end-$_start+1;
        }
        //右边调整
        if($_curPageNum<$_pageNum && $_end<$pages){
            $_end = $_end + ($_pageNum-$_curPageNum);
            $_end = $_end>$pages? $pages : $_end;
        }

        $_pageHtml = '<ul class="pagination" style="float:right;">';

        if($page>1){
            $_pageHtml .= '<li><a  title="上一页" href="'.$url.'?page='.($page-1).'">«</a></li>';
        }
        for ($i = $_start; $i <= $_end; $i++) {
            if($i == $page){
                $_pageHtml .= '<li class="active"><a>'.$i.'</a></li>';
            }else{
                $_pageHtml .= '<li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if($page<$_end){
            $_pageHtml .= '<li><a  title="下一页" href="'.$url.'?page='.($page+1).'">»</a></li>';
        }
        $_pageHtml .= '</ul>';
        return $_pageHtml;
    }
}
