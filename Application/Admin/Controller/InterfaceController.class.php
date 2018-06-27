<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/27
 * Time: 9:29
 */

namespace Admin\Controller;

use Common\Controller\CommonController;

class InterfaceController extends CommonController
{
    public function index(){
        $this->ajaxJSON('Interface控制器');
    }

    /**********************************************************************************基础接口集*****************************************************************************************************/
    /**
     * @param $model ajax方式，读取表单数据，更新操作
     */
    final public function update($model){
       //$this->showParams();
        $Form = M($model);
        $data = $Form->create();  //获取所有post过来的参数，默认htmlspecialchars转义操作
        //对于kindeditor编辑content字段，还原转义前的html格式
        if($model == 'resuccess' || $model == 'infolist' || $model == 'remedia'){
            $data['content'] = htmlspecialchars_decode($data['content']); // stripslashes(htmlspecialchars_decode($_POST['content']));
        }
       // $this->ajaxJSON($data);exit;
        if($data){
            $result = $Form->save($data);
            if($result){
                $this->success('操作成功!');
            }else{
                $this->error('写入错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }
    /**
     * @param $model ajax方式，读取表单数据，插入操作
     */
    final public function add($model){
        //$this->showParams();
        $Form = M($model);
        $data = $Form->create();  //获取所有post过来的参数，默认htmlspecialchars转义操作
        //对于kindeditor编辑content字段，还原转义前的html格式
        if($model == 'resuccess' || $model == 'infolist' || $model == 'remedia'){
            $data['content'] = htmlspecialchars_decode($data['content']); // stripslashes(htmlspecialchars_decode($_POST['content']));
        }else if($model == 'admin'){
            $data['password'] = md5($data['password']);
        }
        // $this->ajaxJSON($data);exit;
        if($data){
            $result = $Form->add($data);
            if($result){
                $this->success('操作成功!');
            }else{
                $this->error('写入错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }
    /**
     * @param $model ajax提交操作，返回数组含status
     */
    final public function delete($model,$ids){
        //$this->showParams();
        $Form = M($model);
        $param['id'] = array('IN',$ids);
        $result = $Form->where($param)->delete();

        if($result){
            $this->success('删除成功!');
        }else{
            $this->error('删除错误！');
        }
    }
    /**
     * 读取列表信息
     * @param $models 模型对象集
     * @param $field 限制字段
     * @param int $page  当前页
     * @param int $pageNum
     */
    public function getList(){
        $model = I('post.model');        //表名: repinggu
        $field = I('post.field','');     //限制字段:
        $page = I('post.page','1');
        $pageNum = I('post.pageNum','10');
        $where = I('post.where','');    //搜索范围：
        $join = I('post.join','');      //一般为左关联：left join galaxy_urllist ON galaxy_repinggu.id = galaxy_urllist.obscureid
        $order = I('post.order','id');  //默认最新再最前面

        //可以用D('User')快捷方法 \Admin\Model\UserModel()
        if($pageNum == '0'){
            $result = M($model)->join($join)->where($where)->field($field)->order($order)->select();
        }else{
            $result = M($model)->join($join)->where($where)->field($field)->page($page)->limit($pageNum)->order($order." desc")->select();
        }
        $sql = M($model)->getLastSql();

        //计算总页数
        $pageAll = M($model)->join($join)->where($where)->field('id')->count();
        $pageAll = ceil($pageAll/$pageNum);
        if($result){
            $data['field'] = $field;
            $data['sql'] = $sql;
            $data['data'] = $result;
            $data['pageAll'] = $pageAll;
            $this->ajaxJSON($data);
        }else{
            $this->ajaxJSON('false');
        }
    }
    /**
     * 读取单个模型
     * @param $model
     * @param $key
     * @param $value
     */
    public function getModel(){
        $model = I('model');
        $where = I('where');
        $result = M($model)->where($where)->find();
        $sql = M($model)->getLastSql();
        if($result){
            $data['sql'] = $sql;
            $data['data'] = $result;
            $this->ajaxJSON($data);
        }else{
            $this->ajaxJSON('false');
        }
    }
    /**********************************************************************************基础接口集*****************************************************************************************************/

    /**********************************************************************************扩展接口*****************************************************************************************************/
    /**
     * 获取更多用户评估的信息
     */
    public function getObscureInfo(){
        $param['obscureid'] = I("post.obscureid");
        $ip = M('urllist')->where($param)->field("ip")->find();
        $where['ip'] = $ip['ip'];
        $result = M('urllist')->where($where)->limit(100)->select();
        if($result){
            $this->ajaxJSON($result);  //二维数组
        }
    }
    /**
     * 设置处理事件
     */
    public function setCheckInfo($database,$id){
        $result = D($database)->where("id=".$id)->setField('checkinfo','true');
        if($result){
            $this->ajaxJSON('true');
        }
    }
    /**********************************************************************************扩展接口*****************************************************************************************************/

    public function uploadFile()
    {
        if (IS_POST) {
            $config = C('ImgConfig');
            $upload = new \Think\Upload($config);// 实例化上传类
            $path = '/uploads/image/';
            $file = $upload->upload();
            if ($file) {
                $file_url = $path . $file['imgFile']['savepath'] . $file['imgFile']['savename'];
//                //成功时KindEditor要求返回的格式
//                {
//                    "error" : 0,
//                    "url" : "http://www.example.com/path/to/file.ext"
//                }
//                //失败时
//                {
//                    "error" : 1,
//                    "message" : "错误信息"
//                }
                echo json_encode(array('error' => 0, 'url' => $file_url));//返回的信息必须是json格式的
            } else {
                $this->error($upload->getError());//获取失败信息
            }
        }
    }

    public function resetPwd(){
        if(IS_POST){
            $id = I('post.id');
            $pwd = I('post.pwd');
            $param['id'] = $id;
            $param['password'] = md5($pwd);
            $result = M('admin')->save($param);
            if($result){
                $this->ajaxJSON('true');
            }else{
                $this->ajaxJSON('false');
            }
        }
    }

    //打印参数
    private function showParams(){
        $params = $_POST;
        echo $params['posttime'];
        foreach($params as $key=>$value){
            echo $key.':'.$value;
            echo '\r\n';
        }
        exit;
    }

}