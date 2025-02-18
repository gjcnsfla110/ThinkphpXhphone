<?php
// 应用公共文件

/**
 * 성공했을때 response
 * @param $data
 * @param $msg
 * @param $code
 * @return \think\response\Json
 */
function showSuccess($data='',$msg='success',$code=200){
    return json(['msg'=>$msg,'data'=>$data],$code);
}

/**
 * 에러였했을때 response
 * @param $msg
 * @param $code
 * @return \think\response\Json
 */
function showError($msg='error',$code=400){
    return json(['msg'=>$msg],$code);
}

/**
 * 강제적으로 response 보내기
 * @param $msg
 * @param $errorCode
 * @param $statusCode
 * @return void
 */
function ApiException($msg = '请求错误',$errorCode = 20000,$statusCode = 400)
{

    abort($errorCode, $msg,[
        'statusCode' => $statusCode
    ]);

}

/**
 * 배열에 키값  확인 및 값 가져오기
 * @param $key
 * @param $array
 * @param $default
 * @return false|mixed
 */
function getValueByKey($key,$array,$default = false){
    return array_key_exists($key,$array) ? $array[$key] : $default;
}
