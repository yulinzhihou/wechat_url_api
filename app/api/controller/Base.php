<?php
namespace app\api\controller;

use app\BaseController;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use think\db\exception\PDOException;
use think\facade\Db;
use think\facade\Env;
use think\facade\Filesystem;

class Base extends BaseController
{
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
     * 初始化方法
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 处理数据结构
     * @param array $data   请求接收到的数据
     * @param string $type  构建查询数据类型，只有3种。vague=模糊，focus=准确，order=排序
     * @param array $name   数据库字段，需要查询的字段名称
     * @param array $condition  条件，比如此字段值不能为空，或者不能等于0之类的。['',0],主要是前端请求提交过来的值，当这个条件成立的时候，相应搜索条件不成立
     * @return bool
     */
    public function doDataStructure(array $data,array $name,string $type = 'vague',array $condition = ['','0']):bool
    {
        if (empty($data) || empty($condition) || empty($type) || empty($name)) {
            return false;
        }
        //定义type的类型，只有3种。模糊，准确，排序
        if (in_array($type,['vague','focus','order'])) {
            foreach ($name as $value) {
                if (isset($data[$value]) && !in_array($data[$value],$condition,true)) {
                    $this->$type[$value] = $data[$value];
                }
            }
        }
        return true;
    }

    /**
     * 公共方法验证器
     * @param string $sceneName 对应场景
     * @param array $data   需要验证的数据，数组结构
     */
    public function commonValidate(string $sceneName,array $data) :bool
    {
        if(!$this->validate->scene($sceneName)->check($data)) {
            if (false === strrpos($this->validate->getError(),'|')) {
                $this->code = -1;
                $this->msg  = $this->validate->getError();
            } else {
                $err = explode('|',$this->validate->getError());
                $this->code = $err[0];
                $this->msg  = $err[1];
            }
            return true;
        }
        return false;
    }

    /**
     * 公共方法返回数据结构
     * @param bool $validate    表示是否是验证器异常信息
     */
    public function message(bool $validate = false): \think\Response\Json
    {
        $this->sysMsg[0] = $this->sysMsg[0]  ?? 'invalid';
        $this->sysMsg[$this->code] = $this->sysMsg[$this->code] ?? 'validate invalid';

        $data = [
            'status'        => $this->status,
            'code'          => $this->code,
            'data'          => $this->returnData,
            'message'       => $this->msg,
            'sysMsg'        => $validate ? $this->sysMsg[0] : $this->sysMsg[$this->code]
        ];
        return json($data);
    }

    /**
     * 公共的返回数据接口
     * @param array|string $msg     返回的消息
     * @param array|bool $result    返回的结果
     * @param bool $validate        是否是验证器
     */
    public function jsonR($msg,$result = false,bool $validate = false): \think\Response\Json
    {
        if (is_array($msg)) {
            if (count($msg) === 2) {
                $this->msg  = $result ? $msg[1] : $msg[0];
            } else {
                //如果只传一个值。
                $this->msg  = $msg[0];
            }
        } elseif (is_string($msg)) {
            $this->msg = $msg;
        } else {
            $this->msg = 'error invalid';
        }
        $this->code     = $result ? 1 : 0;
        $this->status   = $result ? 200 : 504;
        $this->returnData = !is_array($result) ? [] : $result;
        return $this->message($validate);
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
        //构建返回数据结构
        return $this->jsonR('获取成功',$result);
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
        return $this->jsonR(['获取失败','获取成功'],$result);
    }

    /**
     * 保存新建的资源
     */
    public function save():\think\Response
    {
        $inputData = $this->request->param();
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
     * 删除指定资源
     */
    public function delete($id):\think\Response\Json
    {
        $inputData = $this->request->param();
        //额外增加请求参数
        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $result = $this->model->delData($inputData);
        return $this->jsonR(['删除失败','删除成功'],$result);
    }

    /**
     * 图片，ICON上传
     */
    public function upload():\think\Response\Json
    {
        $files = $this->request->file();
        if (!$files) {
            return $this->jsonR("请选择上传的文件");
        }
        $field = array_keys($files)[0];
        $data = [];
        //七牛云验证
//        $this->qn->validate($this->validate->rule[$field]);
        //兼容多图上传
        if (is_array($files) && count($files) > 1 ) {
            //不同字段文件名上传 image img ico
            //上传到七牛
            foreach ($files as $key => $fileSimple) {
//                if ($this->commonValidate(__FUNCTION__, [$key => $fileSimple])) {
//                    return $this->jsonR($this->validate->getError());
//                }
                //上传本地
                $result = Filesystem::putFile(public_path().'uploads',$fileSimple);
//                $result[$key] = $this->qn->uploadFile($key);
            }

//            foreach ($result as $key => $item) {
//                $data[] = [
//                    'cdn' => Env::get('QINIU.cdn'),
//                    'origin_name' => $files[$key]->getOriginalName(),
//                    'filename' => explode('/', $item['filename'])[count(explode('/', $item['filename'])) - 1],
//                    'md5'      => md5_file($files[$key]->getPathname()),
//                    'url' => $item['remote_url'],
//                    'relative_path' => $item['filename']
//                ];
//            }
        } elseif (is_array($files[$field]) && count($files[$field]) > 1) {
            //同一名称的数组文件上传.image[0] image[1]
            foreach ($files as $key => $fileSimple) {
//                if ($this->commonValidate(__FUNCTION__, [$key => $fileSimple])) {
//                    return $this->jsonR($this->validate->getError());
//                }
                //上传本地
                $filename = Filesystem::disk('public')->putFile('', $fileSimple, 'unique_id');
            }

//            $result = Filesystem::putFile(public_path().'uploads',$fileSimple);
            //上传到七牛
//            $result = $this->qn->uploadFile($field, true, count($files[$field]));

//            foreach ($result as $key => $item) {
//                $data[] = [
//                    'cdn' => Env::get('QINIU.cdn'),
//                    'origin_name' => $files[$field][$key]->getOriginalName(),
//                    'filename' => explode('/', $item['filename'])[count(explode('/', $item['filename'])) - 1],
//                    'md5'   => md5_file($files[$field][$key]->getPathname()),
//                    'url' => $item['remote_url'],
//                    'relative_path' => $item['filename']
//                ];
//            }
        } else {
//            if ($this->commonValidate(__FUNCTION__,[$field => $files])) {
//                return $this->jsonR($this->validate->getError());
//            }
            //上传本地
            $filename = Filesystem::disk('public')->putFile('', $files[$field], 'unique_id');
            //上传到七牛
//            $result = $this->qn->uploadFile($field);
            $data = [
                'cdn'           => Env::get('QINIU.cdn'),
                'origin_name'   => $files[$field]->getOriginalName(),
                'filename'       => $filename,
                'md5'           => md5_file($files[$field]->getPathname()),
                'url'           => $this->request->domain(true).'/storage/'  . $filename,
                'relative_path' => 'storage/'  . $filename
            ];
        }

        return $this->jsonR('上传成功',$data);
    }

    /**
     * curl请求
     * @param $url  string 请求的url链接
     * @param $data string|array|mixed 请求的数据
     * @param bool $is_post 是否是post请求，默认false
     * @param array $options 是否附带请求头
     * @return array|mixed
     */
    public function http(string $url, array $data, bool $is_post=false, array $options=[]):array
    {
        $data  = json_encode($data);
        $headerArray = [
            'Content-type: application/json;charset=utf-8',
            'Accept: application/json'
        ];
        $curl = curl_init();
        $arr = [];
        array_push($arr,$url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
        if ($is_post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($options['cookie'])) {
            curl_setopt($curl, CURLOPT_COOKIE, $options['cookie']);
        }
        $output = curl_exec($curl);
        $http_status = curl_errno($curl);
        $http_msg = curl_error($curl);
        curl_close($curl);
        if ($http_status == 0) {
            return json_decode($output, true);
        } else {
            return ['status' => $http_status, 'message' => $http_msg, 'data' => []];
        }
    }

}