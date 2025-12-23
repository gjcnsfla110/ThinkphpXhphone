<?php

namespace app\admin\service;
use app\admin\excepthion\type\LoginEx;
use app\common\BaseS;
use think\facade\Cache;
use think\facade\Filesystem;

class BaseService extends BaseS
{
    /**
     * 토큰 기값에 데이터를 입력하는 함수
     * @param $data
     * @return void
     */
    public function setTokenData($datas){
        if(empty($datas)){
            return false;
        }
        try {
            foreach ($datas as $item){
                $name = getValueByKey("name",$item);
                $data = getValueByKey("data",$item);
                $expire = getValueByKey("expire",$item);
                $tag = getValueByKey("tag",$item,"manager");
                if($name&&$data&&$expire){
                    Cache::store(config("cmm.".$tag."token.store"))->set($name, $data,$expire);
                }
            }
        }catch(\think\Exception $e){
            throw new LoginEx($e->getMessage());
        }
    }

    /**
     * 토큰키값에 관련된 데이터를 갖고오는 함수
     * @param $data
     * @return void
     */
    public function getTokenData($data){
        return Cache::get($data);
    }

    /**
     * 토큰을 생성하는 함수
     * @return string
     */
    public function getToken(){
        // 生成token
        return  sha1(md5(uniqid(md5(microtime(true)),true)));
    }

    /**
     * 토큰 삭제 부분
     * @param $data
     * @return void
     */
    public function deleteToken($data){
        $token = getValueByKey("token",$data);
        $tag = getValueByKey("tag",$data,"manager");
        if(empty($token)){
            ApiException("非法登录");
        }
        $user = Cache::store(config("cmm.".$tag."token.store"))->pull($tag."_".$token);
        if(!empty($user))Cache::store(config("cmm.".$tag."token.store"))->pull($tag."_".$user["id"]);
    }

    /**
     * 이미지 업로드 부분
     */
    protected function commCompress($files)
    {
        if (!$files || (is_array($files) ? empty($files) : true)) {
            ApiException("没有上传图片");
        }
        if (!is_array($files)) {
            $files = [$files];
        }
        //디비저장에 에러발생했을시 혹은 업로드시 에러 발생시 삭제하는 배열
        $uploadedPaths = [];
        //이미지 링크를 저장하는 배열
        $imagePathUrl =[];
        $controllerName = request()->controller();
        $allowMime = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        // 방법 1: 별도 Validate 사용 (공식 추천!)
        $validate = new \think\Validate([
            'file' => 'fileSize:10485760|fileExt:jpg,jpeg,png,gif,webp|image'
        ]);
        $domain = request()->domain();
        $ymd = date('Ymd');
        try {
            foreach ($files as $file) {
                // 1️⃣ 파일 유효성 검사
                if (!$validate->check(['file' => $file])) {
                    ApiException("파일 검증 실패: " . $validate->getError());
                }

                // finfo MIME 검사
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $realMime = $finfo ? finfo_file($finfo, $file->getRealPath()) : false;
                if ($finfo) finfo_close($finfo);

                if (!$realMime || !in_array($realMime, $allowMime)) {
                    ApiException("위조된 이미지 감지: " . $file->getOriginalName());
                }

                $realPath = $file->getRealPath();
                if (!file_exists($realPath)) {
                    ApiException("임시 파일이 존재하지 않습니다.");
                }

                // 2. 파일명 생성
                $rand = md5(uniqid(microtime(true), true));
                $finalName = "image/$controllerName/{$ymd}/{$rand}.webp";
                $finalPath = public_path() . 'uploads/' . $finalName;
                !is_dir(dirname($finalPath)) && mkdir(dirname($finalPath), 0755, true);
                $uploadedPaths[] = $finalName;
                // 3. cwebp 1차 압축 (에러 상세 출력 포함)
                $tempWebp = $finalPath . '.temp.webp';
                $cmd1 = "cwebp -q 40 -m 6 -af -mt -low_memory "
                    . escapeshellarg($realPath) . " -o " . escapeshellarg($tempWebp) . " 2>&1";

                exec($cmd1, $output1, $ret1);

                // 디버그용 로그 (실제 운영시 주석처리)
                // \think\facade\Log::error("cwebp cmd: $cmd1");
                // \think\facade\Log::error("cwebp output: " . implode("\n", $output1));

                if ($ret1 !== 0 || !file_exists($tempWebp)) {
                    // 실패시 ThinkImage로 강제 저장 (보험)
                    try {
                        $image = \think\Image::open($realPath);
                        $image->thumb(1200, 1200, \think\Image::THUMB_SCALING);
                        $image->save($finalPath, 'webp', 60);
                    } catch (\Exception $e) {
                        ApiException("cwebp와 ThinkImage 모두 실패: " . implode(" | ", $output1));
                    }
                } else {
                    // 2차 리사이즈 + 압축
                    $cmd2 = "cwebp -q 50 -m 6 -af -mt -resize 1200 0 "
                        . escapeshellarg($tempWebp) . " -o " . escapeshellarg($finalPath) . " 2>&1";
                    exec($cmd2, $output2, $ret2);

                    @unlink($tempWebp);

                    if ($ret2 !== 0) {
                        // 실패시 품질 30으로 원본에서 바로
                        $cmd3 = "cwebp -q 30 -m 6 -af -mt -resize 1200 0 "
                            . escapeshellarg($realPath) . " -o " . escapeshellarg($finalPath) . " 2>&1";
                        exec($cmd3);
                    }
                }

                // 50KB 이하 강제 압축
                if (file_exists($finalPath)) {
                    $size = filesize($finalPath);
                    $q = 30;
                    while ($size > 50 * 1024 && $q >= 10) {
                        $tmp = $finalPath . '.tmp';
                        exec("cwebp -q {$q} -m 6 -af -mt " . escapeshellarg($finalPath)
                            . " -o " . escapeshellarg($tmp) . " && mv " . escapeshellarg($tmp) . " " . escapeshellarg($finalPath));
                        clearstatcache();
                        $size = filesize($finalPath);
                        $q -= 5;
                    }
                }

                // DB 저장
                $url = $domain . '/uploads/' . $finalName;
                $imagePathUrl[] = $url;
            }

            return [
                'imgUrl' => $imagePathUrl,
                'imgPath'=>$uploadedPaths
            ];

        } catch (\think\exception\ValidateException $e) {
            $this->commCleanupFiles($uploadedPaths);
            ApiException("验证失败:".$e->getMessage());
        } catch (\Exception $e) {
            $this->commCleanupFiles($uploadedPaths);
            ApiException("上传失败:".$e->getMessage());
        }
    }

    /**
     * 사진한장 업로드
     */
    protected function uploadOne($file){

        //디비저장에 에러발생했을시 혹은 업로드시 에러 발생시 삭제하는 배열
        $uploadedPaths = [];
        //이미지 링크를 저장하는 배열
        $imagePathUrl =[];
        $controllerName = request()->controller();
        $allowMime = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        // 방법 1: 별도 Validate 사용 (공식 추천!)
        $validate = new \think\Validate([
            'file' => 'fileSize:10485760|fileExt:jpg,jpeg,png,gif,webp|image'
        ]);
        $domain = request()->domain();
        $ymd = date('Ymd');
        try {
                // 1️⃣ 파일 유효성 검사
                if (!$validate->check(['file' => $file])) {
                    ApiException("파일 검증 실패: " . $validate->getError());
                }

                // finfo MIME 검사
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $realMime = $finfo ? finfo_file($finfo, $file->getRealPath()) : false;
                if ($finfo) finfo_close($finfo);

                if (!$realMime || !in_array($realMime, $allowMime)) {
                    ApiException("위조된 이미지 감지: " . $file->getOriginalName());
                }

                $realPath = $file->getRealPath();
                if (!file_exists($realPath)) {
                    ApiException("임시 파일이 존재하지 않습니다.");
                }

                // 2. 파일명 생성
                $rand = md5(uniqid(microtime(true), true));
                $finalName = "image/$controllerName/{$ymd}/{$rand}.webp";
                $finalPath = public_path() . 'uploads/' . $finalName;
                !is_dir(dirname($finalPath)) && mkdir(dirname($finalPath), 0755, true);
                $uploadedPaths[] = $finalName;
                // 3. cwebp 1차 압축 (에러 상세 출력 포함)
                $tempWebp = $finalPath . '.temp.webp';
                $cmd1 = "cwebp -q 40 -m 6 -af -mt -low_memory "
                    . escapeshellarg($realPath) . " -o " . escapeshellarg($tempWebp) . " 2>&1";

                exec($cmd1, $output1, $ret1);

                // 디버그용 로그 (실제 운영시 주석처리)
                // \think\facade\Log::error("cwebp cmd: $cmd1");
                // \think\facade\Log::error("cwebp output: " . implode("\n", $output1));

                if ($ret1 !== 0 || !file_exists($tempWebp)) {
                    // 실패시 ThinkImage로 강제 저장 (보험)
                    try {
                        $image = \think\Image::open($realPath);
                        $image->thumb(1200, 1200, \think\Image::THUMB_SCALING);
                        $image->save($finalPath, 'webp', 60);
                    } catch (\Exception $e) {
                        ApiException("cwebp와 ThinkImage 모두 실패: " . implode(" | ", $output1));
                    }
                } else {
                    // 2차 리사이즈 + 압축
                    $cmd2 = "cwebp -q 50 -m 6 -af -mt -resize 1200 0 "
                        . escapeshellarg($tempWebp) . " -o " . escapeshellarg($finalPath) . " 2>&1";
                    exec($cmd2, $output2, $ret2);

                    @unlink($tempWebp);

                    if ($ret2 !== 0) {
                        // 실패시 품질 30으로 원본에서 바로
                        $cmd3 = "cwebp -q 30 -m 6 -af -mt -resize 1200 0 "
                            . escapeshellarg($realPath) . " -o " . escapeshellarg($finalPath) . " 2>&1";
                        exec($cmd3);
                    }
                }

                // 50KB 이하 강제 압축
                if (file_exists($finalPath)) {
                    $size = filesize($finalPath);
                    $q = 30;
                    while ($size > 50 * 1024 && $q >= 10) {
                        $tmp = $finalPath . '.tmp';
                        exec("cwebp -q {$q} -m 6 -af -mt " . escapeshellarg($finalPath)
                            . " -o " . escapeshellarg($tmp) . " && mv " . escapeshellarg($tmp) . " " . escapeshellarg($finalPath));
                        clearstatcache();
                        $size = filesize($finalPath);
                        $q -= 5;
                    }
                }

                // DB 저장
                $url = $domain . '/uploads/' . $finalName;

            return [
                'imgUrl' => $url,
                'imgPath'=>$uploadedPaths[0]
            ];

        } catch (\think\exception\ValidateException $e) {
            $this->commCleanupFiles($uploadedPaths);
            ApiException("验证失败:".$e->getMessage());
        } catch (\Exception $e) {
            $this->commCleanupFiles($uploadedPaths);
            ApiException("上传失败:".$e->getMessage());
        }
    }

    /**
     * 🔧 업로드 실패 시 파일 정리용 함수
     */
    protected function commCleanupFiles(array $paths)
    {
        if (empty($paths)) {
            return false;
        }
        $disk = Filesystem::disk('public');
        try {
            foreach ($paths as $path) {
                $rel = ltrim($path, '/');
                if ($disk->has($rel)) {
                    $disk->delete($rel);
                }
            }
        } catch (\Exception $e) {
            // 예외를 로깅하거나 사용자 정의 예외로 던지기
            throw new \Exception("上传图片失败，请联系客服: " . $e->getMessage());
        }
    }

    //롤백되였을때 사진삭제부분
    protected function commDeleteImgFile($paths){
        $disk = Filesystem::disk('public');
        try {
            foreach ($paths as $path) {
                if ($disk->has($path)) {
                    $disk->delete($path);
                }
            }
        }catch(\Exception $e){
            ApiException("삭제실패:".$e->getMessage());
        }
    }

    // cwebp 초강력 압축 (200KB → 40KB 실화)
    protected function commCwebpCompress($filepath)
    {
        // 서버에 cwebp 설치되어 있어야 함 (아래 설치법 참고)
        $cmd = "cwebp -q 70 -m 6 -af -sharp_yuv -mt -quiet '{$filepath}' -o '{$filepath}.tmp' && mv '{$filepath}.tmp' '{$filepath}'";
        exec($cmd, $output, $returnCode);

        // 실패시 ThinkImage 품질만으로도 충분
        if ($returnCode !== 0) {
            // 품질 65로 재시도 (보험)
            $cmd = "cwebp -q 65 '{$filepath}' -o '{$filepath}.tmp' && mv '{$filepath}.tmp' '{$filepath}'";
            exec($cmd);
        }
    }

    public function randName( $length = 8){
        // 1. 랜덤 이름에 사용될 문자 집합 정의
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';

        // 2. 지정된 길이만큼 반복하여 문자열 생성
        for ($i = 0; $i < $length; $i++) {
            // mt_rand()를 사용하여 문자 집합에서 랜덤한 문자를 선택
            $randomString .= $characters[mt_rand(0, $charLength - 1)];
        }

        // 3. 생성된 문자열 반환
        return $randomString;
    }


    /**
     * $array1에서 $array2에 없는 요소들만 'id'와 'name' 값 쌍을 기준으로 추출합니다 (차집합: A - B).
     * * @param array $array1 기준 배열 (A)
     * @param array $array2 뺄 배열 (B)
     * @return array $array1에만 존재하는 요소들
     */
    function getDifferenceByTwoKeys(array $array1, array $array2): array {
        $key1 = 'id';
        $key2 = 'name';

        // 1. array_reduce를 사용하여 배열 2를 제외할 식별자 목록(Map)으로 변환합니다.
        $identifiers_to_exclude = array_reduce($array2, function($carry, $item) use ($key1, $key2) {
            // 필수 키가 모두 있는지 확인합니다.
            if (isset($item[$key1]) && isset($item[$key2])) {
                $identifier = $item[$key1] . '|' . $item[$key2]; // 예: "102|B"
                $carry[$identifier] = true;
            }
            return $carry;
        }, []);

        // 2. array_filter를 사용하여 배열 1에서 제외할 목록에 없는 요소만 필터링합니다.
        $result = array_filter($array1, function($item) use ($identifiers_to_exclude, $key1, $key2) {
            // 필수 키가 없으면 안전하게 통과시키지 않습니다.
            if (!isset($item[$key1]) || !isset($item[$key2])) {
                return false;
            }

            $identifier = $item[$key1] . '|' . $item[$key2];

            // 식별자가 제외 목록에 포함되지 않았는지 확인합니다.
            // 제외 목록에 없으면 (true), 이 요소를 결과에 포함합니다.
            return !isset($identifiers_to_exclude[$identifier]);
        });

        // 3. 키를 재배열하고 반환합니다.
        return array_values($result);
    }

    /**
     * $array1과 $array2 모두에 'id'와 'name' 키 쌍이 일치하는 요소만 추출합니다 (교집합).
     * * @param array $array1 교집합을 확인할 첫 번째 배열
     * @param array $array2 교집합을 확인할 두 번째 배열 (기준 맵 생성)
     * @return array 두 배열에 공통으로 존재하는 요소들
     */
    function getIntersectionByTwoKeys(array $array1, array $array2): array {
        $key1 = 'id';
        $key2 = 'name';

        // 1. 배열 2를 Map(고유 식별자 목록)으로 변환하여 검색 속도를 높입니다.
        // 키: "id|name", 값: true
        $identifiers_in_array2 = array_reduce($array2, function($carry, $item) use ($key1, $key2) {
            // 필수 키가 모두 있는지 확인 (안전성)
            if (isset($item[$key1]) && isset($item[$key2])) {
                $identifier = $item[$key1] . '|' . $item[$key2];
                $carry[$identifier] = true;
            }
            return $carry;
        }, []);

        // 2. 배열 1을 필터링하여, 식별자가 Map에 존재하는 요소만 추출합니다.
        $result = array_filter($array1, function($item) use ($identifiers_in_array2, $key1, $key2) {
            // 필수 키 확인
            if (!isset($item[$key1]) || !isset($item[$key2])) {
                return false;
            }

            $identifier = $item[$key1] . '|' . $item[$key2];

            // 식별자가 배열 2의 맵에 포함되어 있는지 확인합니다.
            // 포함되어 있다면 (true), 이 요소를 결과에 포함합니다.
            return isset($identifiers_in_array2[$identifier]);
        });

        // 3. 키를 재배열하고 반환합니다.
        return array_values($result);
    }

    //롤백되였을때 사진삭제부분
    protected function uploadDelete($paths){
        if(empty($paths)){
            return;
        }
        $disk = Filesystem::disk('public');
        try {
            foreach ($paths as $path) {
                if ($disk->has($path['url'])) {
                    $disk->delete($path['url']);
                }
            }
        }catch(\Exception $e){
            ApiException("삭제실패:".$e->getMessage());
        }
    }

}






