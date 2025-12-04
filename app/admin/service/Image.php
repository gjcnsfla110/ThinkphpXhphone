<?php

namespace app\admin\service;
use app\admin\model\Image as ImageModel;
use think\facade\Filesystem;
use think\facade\Db;
class Image extends BaseService
{
    public function saveImg($files,$category_id){
        return $this->compress($files,$category_id);
    }

    public function deleteImg(){
        return $this->deleteImgFile();
    }

    public function updateImg($original_name){
        return request()->Model->save(['original_name'=>$original_name]);
    }

    private function compress($files, $category_id)
    {
        if (!$files || (is_array($files) ? empty($files) : true)) {
            ApiException("没有上传图片");
        }
        if (!is_array($files)) {
            $files = [$files];
        }
        Db::startTrans();
        $uploadedPaths = [];
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
                $finalName = "image/{$ymd}/{$rand}.webp";
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
                $size = file_exists($finalPath) ? filesize($finalPath) : 0;
                $url = $domain . '/uploads/' . $finalName;

                ImageModel::create([
                    'image_class_id' => $category_id,
                    'original_name'  => $file->getOriginalName(),
                    'name'           => $finalName,
                    'url'            => $url,
                    'size'           => $size,
                    'ext'            => 'webp',
                ]);
            }

            Db::commit();
            return ['message' => '上传成功！'];

        } catch (\think\exception\ValidateException $e) {
            Db::rollback();
            $this->cleanupFiles($uploadedPaths);
            ApiException("验证失败:".$e->getMessage());
        } catch (\Exception $e) {
            Db::rollback();
            $this->cleanupFiles($uploadedPaths);
            ApiException("上传失败:".$e->getMessage());
        }
    }

    /**
     * 🔧 업로드 실패 시 파일 정리용 함수
     */
    private function cleanupFiles(array $paths)
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
    private function deleteImgFile(){
        Db::startTrans();
        $disk = Filesystem::disk('public');
        try {
            $path = request()->Model->name;
            if ($disk->has($path)) {
                $disk->delete($path);
            }
            request()->Model->delete();
        }catch(\Exception $e){
            Db::rollback();
            ApiException("삭제실패:".$e->getMessage());
        }
        Db::commit();
        return ["msg"=>"성공"];
    }

    // cwebp 초강력 압축 (200KB → 40KB 실화)
    private function cwebpCompress($filepath)
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

}