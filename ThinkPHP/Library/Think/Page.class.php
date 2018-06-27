<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Think;

class Page{
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数(完整url模式)
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $rollPage   = 11;// 分页栏每页显示的页数
    public $lastSuffix = true; // 最后一页是否显示总页数

    private $p       = 'page'; //分页参数名 默认为page
    private $url     = ''; //当前链接URL
    private $nowPage = 1;

    //记录url有多少个参数
    private $paramNum;

    // 分页显示定制
    private $config  = array(
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    );

    /**
     * 架构函数
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows, $listRows=10,$rollPage=8,$parameter = array()) {
        C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
        /* 基础设置 */
        $this->totalRows  = $totalRows; //设置总记录数
        $this->listRows   = $listRows;  //设置每页显示行数
        $this->rollPage = $rollPage; //定义分页栏每页显示的页数
        /*
         * 'URL_PARAMS_BIND_TYPE'  =>  1
         * 如果是设置了设置参数绑定按照变量顺序绑定  虽然简化了url
         * 这时要补充相应操作以满足参数$this->parameter获取
         */
        if(C('URL_PARAMS_BIND_TYPE')){
            //判断有多少个参数
            for($i=0;$i<100;$i++){
                if(empty($_GET[$i])){
                    break;
                }
            }
            $this->paramNum = $i;
            for($j=0;$j<$i;$j++){
                if($j == $i-1){  //最后一个参数
                    $str = $this->p;    //最后一个参数为分页默认值，定义为$this->p;
                }else{
                    $str = '[PARAMS'.$j.']';
                }
                $_GET[$str] = $_GET[$j];      //模拟重构Get过来的参数
                while($param=each($_GET)){
                    $this->parameter[$str] = $param['value'];  //记录除最后一个参数之外，都定义为[PARAMS0] [PARAMS1] [PARAMS2] .....
                }
                unset($_GET[$j]);  //注销定义(不能省略)
            }
        }else{
            $this->parameter  = empty($parameter) ? $_GET : $parameter;
        }
        //----------------调试打印1------------------------
//        while($param=each($this->parameter)){
//            echo $param['key'].':'.$param['value'];
//            echo '|';
//        }
//        echo '当前页面:'.$_GET[$this->p];
//        echo '<br />';
        //exit;
        //----------------调试打印------------------------
        $this->nowPage    = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
        $this->nowPage    = $this->nowPage>0 ? $this->nowPage : 1;
        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url($page){
        $url = str_replace(urlencode('[PAGE]'), $page, $this->url);
        if(C('URL_PARAMS_BIND_TYPE')){
            $url = str_replace('/'.$this->p.'/', '/', $url);
        }
        //----------------调试打印------------------------
//        echo '当前页面:'.$_GET[$this->p];
//        echo ',替换页面后URL：'.str_replace(urlencode('[PAGE]'), $page, $url);
//        echo '<br />';
        //exit;
        //----------------调试打印------------------------
        return $url;
    }

    /**
     * 过滤URL_PARAMS_BIND_TYPE=1模式下，虚构的参数[PARAMS0] [PARAMS1] [PARAMS2] ...
     * eg:
     * 2:2|[PARAMS0]:181|[PARAMS1]:2|page:2|当前页面:2
     *   [PARAMS0]:181|[PARAMS1]:2|page:[PAGE]|当前页面:2U方法取得URL：/Home/Newlist/classify/[PARAMS0]/181/[PARAMS1]/2/page/%5BPAGE%5D.html
     *   [PARAMS0]:181|[PARAMS1]:2|page:[PAGE]|当前页面:2U方法取得URL：/Home/Newlist/classify/[PARAMS0]/181/[PARAMS1]/2/page/1.html
     */
    private function filter(){
//        echo '共有多少个参数：'.$this->paramNum;
        for($i=0 ; $i < $this->paramNum ; $i++) {
            $str = '[PARAMS'.$i.']';
            $this->url = str_replace('/'.$str.'/', '/', $this->url);
        }
//        echo '，过滤[PARAMS】后的url:'.$this->url;
//        echo '<br />';
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        if(0 == $this->totalRows) return '';
        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        $this->url = U(ACTION_NAME, $this->parameter);
        //----------------调试打印------------------------
//        echo '当前页面:'.$_GET[$this->p];
//        echo ',U方法取得URL：'.$this->url;
//        echo '<br />';
        //----------------调试打印------------------------
        //补充隐藏模块，过滤模块字眼Home：
        $this->url = str_replace('/Home/', '/', $this->url);
        //过滤虚构的参数[PARAMS0] [PARAMS1] [PARAMS2] ...
        if(C('URL_PARAMS_BIND_TYPE')){
            $this->filter();
        }

        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页临时变量 */
        $now_cool_page      = $this->rollPage/2;
        $now_cool_page_ceil = ceil($now_cool_page);
        $this->lastSuffix && $this->config['last'] = $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        $up_page = $up_row > 0 ? '<a class="prev" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a>' : '';

        //下一页
        $down_row  = $this->nowPage + 1;
        $down_page = ($down_row <= $this->totalPages) ? '<a class="next" href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';

        //第一页
        $the_first = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
            $the_first = '<a class="first" href="' . $this->url(1) . '">' . $this->config['first'] . '</a>';
        }

        //最后一页
        $the_end = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
            $the_end = '<a class="end" href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a>';
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
            if(($this->nowPage - $now_cool_page) <= 0 ){
                $page = $i;
            }elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
                $page = $this->totalPages - $this->rollPage + $i;
            }else{
                $page = $this->nowPage - $now_cool_page_ceil + $i;
            }
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '<a class="num" href="' . $this->url($page) . '">' . $page . '</a>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '<span class="current">' . $page . '</span>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']);
        return "<div>{$page_str}</div>";
    }
}
