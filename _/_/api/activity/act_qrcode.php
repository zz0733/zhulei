<?php
/**
 * 生成微信活动推广二维码地址
 * POST
 * @param intval modelId 活动id
 * @param string model 活动类型
 * @param string title 活动标题
 * @param string info 活动介绍
 * @param string image 活动图片
 * @param string token 绑定token
 * 
 * @return array 带参数二维码地址
 */
define('PIGCMS_PATH', dirname(__FILE__).'/../../');
require_once PIGCMS_PATH.'source/init.php';
require_once '../functions.php';
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

    $sign_key = $_POST['sign_key'];
        unset($_POST['sign_key']);

    $data = array();
    $data['modelId'] = $_POST['modelId'];
    $data['model'] = $_POST['model'];
    $data['title'] = $_POST['title'];
    $data['info'] = $_POST['info'];
    $data['keyword'] = $_POST['keyword'];
    $data['image'] = $_POST['image'];
    $data['token'] = $_POST['token'];
    $data['product_id'] = $_POST['product_id'];
    $data['sku_id'] = $_POST['sku_id'];

    $_POST['salt'] = SIGN_SALT;
    if (!_checkSign($sign_key, $_POST)) {
        $error_code = 1003;
        $error_msg = '签名无效';

    } else {

        // 取新表记录
        // 无或过期则创建/修改
        $returnData = M('Activity_spread')->getQcode($data);
        $error_code = $returnData['error_code'];
        $error_msg = $returnData['error_msg'];

        $actData['qcode'] = $returnData['qcode'];
        // dump($data);exit;
        // // for test
        // $data['qcode'] = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQFK7zoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL1p6dUVWMkxteVRLd21LR1FqaFdDAAIEWlBmVgMEgDoJAA%3D%3D';
        // $error_code = 0;
        // $error_msg = '请求成功';

    }

} else {
    $error_code = 1001;
    $error_msg = '请求失败';

}
echo json_encode(array('error_code' => $error_code, 'error_msg' => $error_msg, 'data' => $actData));
exit;