<?php
namespace app\api\controller;

use app\BaseController;

class Base extends BaseController
{

    /**
     * 管理员信息
     * @var array
     */
    protected $adminInfo = [];

    /**
     * 需要额外加入的请求数据，
     * @var array
     */
    protected $params = [];

    /**
     * 查询过滤字段，需要的字段请写入
     * @var array
     */
    protected $field = [];

    /**
     * 定义精准搜索条件
     * @var array
     */
    protected $focus = [];

    /**
     * 定义模糊搜索条件
     * @var array
     */
    protected $vague = [];

    /**
     * 定义排序字段
     * @var array
     */
    protected $order = [];

    /**
     * 分页页码
     * @var integer
     */
    protected $page = 0;

    /**
     * 分页数量
     * @var integer
     */
    protected $pageSize = 0;

    /**
     * 模型单例
     * @var null
     */
    protected $model = null;

    /**
     * 验证器单例
     * @var null
     */
    protected $validate = null;

    /**
     * 返回给客户端请求的数据
     * @var array
     */
    protected $returnData = [];

    /**
     * http返回状态码，200表示请求成功，504表示 请求失败
     * @var array
     */
    protected $status = 504;

    /**
     * 提示信息
     * @var string
     */
    protected $msg = '';

    /**
     * 返回给前端的状态码。0表示请求数据失败，1表示请求数据成功
     * @var int
     */
    protected $code = 0;

    /**
     * 反馈开发提示信息
     * @var string
     */
    protected $sysMsg = [
        'ERROR','SUCCESS'
    ];

    /**
     * 公共方法返回数据结构
     * @param bool $validate    表示是否是验证器异常信息
     */
    public function message(bool $validate = false): \think\Response\Json
    {
        return json([
            'status'        =>  $this->status,
            'data'          =>  [
                'code'          => $this->code,
                'data'          => $this->returnData,
                'message'   => $this->msg,
                'sysMsg'    => $validate ? $this->sysMsg[0] : $this->sysMsg[$this->code]
            ],
            'message'   => $this->msg,
            'sysMsg'    => $validate ? $this->sysMsg[0] : $this->sysMsg[$this->code]
        ]);
    }

    /**
     * 公共的返回数据接口
     * @param array|string $msg
     * @param array|bool $result
     * @param bool $validate
     * @return \think\Response\Json
     */
    public function commonReturn($msg,$result = false,bool $validate = false): \think\Response\Json
    {
        if (is_array($msg)) {
            if (count($msg) > 0) {
                if (count($msg) == 2) {
                    $this->msg =  $result ? $msg[1] : $msg[0];
                }
                $this->status = $result ? 200 : 504;
                $this->code = $result ? 1 : 0;
            } else {
                $this->msg = '';
                $this->status = 504;
                $this->code = 0;
            }
        } elseif (is_string($msg)) {
            $this->msg = $msg;
            $this->code = 1;
            $this->status = 200;
        }
        $this->returnData = is_bool($result) ? [] : $result;
        return $this->message($validate);
    }

}