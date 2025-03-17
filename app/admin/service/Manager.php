<?php

namespace app\admin\service;
use app\admin\model\Manager as ManagerModel;
use app\admin\model\TitleMenu;
use app\admin\model\Rule;
class Manager extends BaseService
{

    /**
     * 로그인 토큰 저장부분
     * @param $param
     * @return string
     * @throws \app\admin\excepthion\type\LoginEx
     */
     public function login($param){
         $data = getValueByKey('data',$param);
         if(empty($data)){
             ApiException("会员登录系统错误");
         }
         $tag = getValueByKey("tag",$param,"manager");
         $expire = getValueByKey("expire",$param,3600);
         $user = is_object($data) ? $data->toArray() : $data;
         $pass = getValueByKey("password",$user);
         if($pass)unset($user['password']);
         $token = $this->getTokenData($tag."_".$user['id']);
         if(!empty($token)){
             return $token;
         }
         $token = $this->getToken();
         $tokenName1 = $tag."_".$token;
         $tokenName2 = $tag."_".$user['id'];
         $this->setTokenData([
             [
                 'name'=>$tokenName1,
                 'data'=>$user,
                 'expire'=>$expire,
             ],
             [
                 'name'=>$tokenName2,
                 'data'=>$token,
                 'expire'=>$expire,
             ]
         ]);
         $login_ip = request()->ip(0,true);
         $last_login = date('Y-m-d H:i:s');
         ManagerModel::where('id',$user['id'])->update(['login_ip'=>$login_ip,'last_login'=>$last_login]);
        return $token;
     }

     public function logout($data){
         $this->deleteToken($data);
     }

    public function getInfo(){
         $titleMenu = TitleMenu::order(['priority'=>'desc','id'=>'desc'])->select()->toArray();
         array_push($titleMenu,['id'=>0,'name'=>"菜单",'child'=>"[0]",'init'=>1,"create_time" => "2025-03-17 21:03:40"]);
         $menu = Rule::where('menu',1)->order(['order'=>'desc','id'=>'desc'])->select()->toArray();
         return ['titleMenu'=>$titleMenu,'menu'=>$menu];
    }

    public function getManagers($page, $limit, $username){
        return $this->M->getManagers($page, $limit, $username);
    }

    public function addManager($data){
         if(empty($data)){
             ApiException("添加管理员失败");
         }
         if(!is_array($data)){
             ApiException("添加管理员失败");
         }
         if(getValueByKey('password',$data)){
             $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
         }
         unset($data['checkPassword']);
         $loginIp = request()->ip(0, true);
         $lastLogin = date('Y-m-d H:i:s');
         $data['login_ip'] = $loginIp;
         $data['last_login'] = $lastLogin;
         return $this->M->MPsave($data);
    }

    public function updateManager($param){
         return request()->Model->save($param);
    }

    public function updateStatus($param){
        return $this->M->MPupdateStatus($param);
    }

    public function updatePass(){

    }
    public function superPassReset($id){
        $newPass = password_hash("121212", PASSWORD_DEFAULT);
        return $this->M->where('id',$id)->update(['password'=>$newPass]);
    }
    public function deleteManager(){
       return  $this->M->MPdelete();
    }
}