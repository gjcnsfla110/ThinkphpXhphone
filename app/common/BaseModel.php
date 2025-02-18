<?php

namespace app\common;
use think\facade\Db;
use think\Model;

class BaseModel extends Model
{
    /**
     * 자식메뉴만들기 
     * @param $data
     * @param $field
     * @param $child
     * @param $pid
     * @param $callback
     * @return array
     */
    public function list_to_tree2($data,$field="pid",$child="child",$pid=0,$callback = null){
         if(!is_array($data))return [];
         $arr = [];
         foreach($data as $v){
             $extra = true;
             if(is_callable($callback)){
                 $extra = $callback($v);
             }
             if($extra && $v[$field] == $pid){
                 $v[$child] = $this->list_to_tree2($data,$field,$child,$v['id'],$callback);
                 $arr[] = $v;
             }
         }
         return $arr;
    }

    /**
     * 이미지클래스를 위하여 만든것 자식만 보이게하기위해서이다
     * @param $data
     * @param $field
     * @param $child
     * @param $pid
     * @param $callback
     * @return array
     */
    public function listChild($data,$field="pid",$child="child",$pid=0,$callback = null){
        if(!is_array($data))return [];
        $arr = [];
        foreach($data as $v){
            $extra = true;
            if(is_callable($callback)){
                $extra = $callback($v);
            }
            if($extra && $v[$field] == $pid){
                $v[$child] = $this->list_to_tree2($data,$field,$child,$v['id'],$callback);
                $arr[] = $v;
            }
        }
        $list = array_map(function ($item){
            $clearChild = array_map(function($child){
                if(!empty($child['child'])&&count($child['child'])>0){
                    $child['child'] = [];
                }
                return $child;
            },$item['child']);
            return array_replace($item,["child"=>$clearChild]);
        },$arr);
        array_unshift($list,[
            "id"=>0,
            "name"=>"最上级图片菜单",
            "child"=>[]
        ]);
        return $list;
    }

    /**
     * //아이디로 등 특정 값으로  자식에 관련된 모든것을 삭제
     * @param $dbName
     * @param $parentId
     * @return bool
     */
    public function deleteCategoryWithChildren($dbName,$parentId)
    {
        if(empty($dbName)){
            ApiException("데이터이름이 없어요. 관리자 연락부탁드립니다");
        }
        // 1️⃣ CTE (공통 테이블 표현식)로 부모 ID를 기준으로 모든 하위 카테고리 찾기
        $sql = "
        WITH RECURSIVE category_tree AS (
            SELECT * FROM {$dbName} WHERE id = ?
            UNION ALL
            SELECT c.* FROM {$dbName} c
            INNER JOIN category_tree p ON c.pid = p.id
        )
        SELECT id FROM category_tree
        ";
        // 2️⃣ SQL 실행 및 ID 목록 가져오기
        $ids = Db::query($sql, [$parentId]);
        if (empty($ids)) {
            return false; // 삭제할 데이터 없음
        }

        // 3️⃣ ID 목록을 배열로 변환하여 삭제 실행
        $idList = array_column($ids, 'id');
        return $this->whereIn('id', $idList)->delete();
    }

    /// 밑부분 가장 많이 사용할거 같은 공요부분
    public function MPsave($data){
       return $this->save($data);
    }
    public function MPupdate($data,$where=[]){
        return $this->where($where)->save($data);
    }

    public function MPdelete(){
        return request()->Model->delete();
    }

    public function MPdelereOne($where=[]){
        return $this->where($where)->delete();
    }

    public function MPdeleteAll($ids){
        return $this->destroy($ids);
    }
    public function MPselectAll($where=[],$order=['id'=>'desc']){
         return $this->where($where)->order($order)->select();
    }

}