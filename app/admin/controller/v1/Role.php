<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\Role as RoleModel;
use app\admin\validate\Role as RoleValidate;

/**
 * 角色组控制器
 */
class Role extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new RoleModel();
        $this->validate = new RoleValidate();
    }


    /**
     * 显示资源列表
     */
    public function index() :\think\Response
    {
        $inputData = $this->request->param();

        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        //判断是否需要分页
        if (isset($inputData['page']) && $inputData['page'] != 0) {
            $this->page = (int)$inputData['page'];
        }
        if (isset($inputData['size']) && $inputData['size'] != 0) {
            $this->pageSize = (int)$inputData['size'];
        }

        $result = $this->model->getIndexList($this->page,$this->pageSize,$this->field,$this->vague,$this->focus,$this->order);
        // 处理rules
        foreach ($result as $key => $item) {
            if ($item['rules'] != '*') {
                $result[$key]['rules'] = explode(',',$item['rules']);
            }
        }

        //构建返回数据结构
        return $this->jsonR('获取成功',$result);
    }


    /**
     * 保存新建的资源
     */
    public function save():\think\Response
    {
        $inputData = $this->request->param();
        // 处理rules
        if (isset($inputData['rules']) && !empty($inputData['rules'])) {
            $inputData['rules'] = implode(',',$inputData['rules']);
        }

        //额外增加请求参数
        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $result = $this->model->addData($inputData);
        return $this->jsonR(['新增失败','新增成功'],$result);
    }

    /**
     * 保存更新的资源
     */
    public function update($id):\think\Response\Json
    {
        $inputData = $this->request->param();
        // 处理rules
        if (isset($inputData['rules']) && !empty($inputData['rules'])) {
            $inputData['rules'] = implode(',',$inputData['rules']);
        }
        //额外增加请求参数
        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $result = $this->model->editData($inputData);
        return $this->jsonR(['修改失败','修改成功'],$result);
    }

    /**
     * 显示指定的资源
     */
    public function read($id):\think\Response\Json
    {
        $inputData = $this->request->param();
        //额外增加请求参数
        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $result = $this->model->getInfo((int)$inputData['id']);
        // 处理rules
        if ($result['rules'] != '*' && strrpos($result['rules'],',') == false) {
            $result['rules'] = explode(',',$result['rules']);
        }
        return $this->jsonR(['获取失败','获取成功'],$result);
    }


}
