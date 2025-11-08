<?php

namespace app\admin\service;
use app\admin\model\Image as ImageModel;
use think\facade\Filesystem;
use think\Image as ThinkImage;
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
        Db::startTrans();
        $uploadedPaths = [];

        try {
            foreach ($files as $file) {
                // 1️⃣ 파일 유효성 검사
                validate([
                    'file' => 'fileSize:10485760|fileExt:jpg,png,jpeg'
                ])->check(['file' => $file]);

                // 2️⃣ 파일 저장
                $domain = request()->domain();
                $saveName = Filesystem::disk('public')->putFile('image', $file);
                $saveName = str_replace('\\', '/', $saveName); // OS 호환
                $path = app()->getRootPath() . 'public/uploads/' . $saveName;

                // 상대 경로 저장 (삭제 시 Filesystem에서 쓸 수 있게)
                $uploadedPaths[] = $saveName;

                // 3️⃣ 이미지 리사이즈 + 압축
                $image = ThinkImage::open($path);
                if ($image->width() > 1920) {
                    $image->thumb(1920, null);
                }
                $image->save($path, null, 85);

                // 4️⃣ DB 저장
                $url = $domain . '/uploads/' . $saveName;
                ImageModel::create([
                    'image_class_id' => $category_id,
                    'original_name'  => $file->getOriginalName(),
                    'name'           => $saveName,
                    'url'            => $url,
                    'size'           => filesize($path),
                    'ext'            => $file->extension(),
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
            ApiException("삭제실패:".$e->getMessage());
        }
        Db::commit();
        return ["msg"=>"성공"];
    }
}