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

    public function deleteImg($ids){
        return $this->M->Mdelete($ids);
    }

    public function updateImg($data){
        return $this->M->Mupdate($data);
    }

    private function compress($files,$category_id)
    {
        // 트랜잭션 시작
        Db::startTrans();
        $uploadedPaths = [];
        try {
              foreach ($files as $file) {
                  // 1️⃣ 파일 유효성 검사
                  validate([
                      'file' => 'fileSize:10485760|fileExt:jpg,png,jpeg'
                  ])->check(['file' => $file]);

                  // 2️⃣ 원본 파일 임시 저장
                  $saveName = Filesystem::disk('public')->putFile('image', $file);
                  $path = app()->getRootPath() . 'public/uploads/' . $saveName;
                  $uploadedPaths[] = $path; // 저장된 파일 경로 기록

                  // 3️⃣ 이미지 압축 및 리사이즈
                  $image = ThinkImage::open($path);

                  // 💡 폭이 1920px보다 크면 1920px로 줄이기 (비율 유지)
                  $width = $image->width();
                  if ($width > 1920) {
                      $image->thumb(1920, null);
                  }

                  // 💡 품질 85%로 압축 (고화질 유지하면서 용량 감소)
                  $image->save($path, null, 85); // 85는 품질값(1~100)

                  // 4️⃣ DB 저장
                  $url = '/uploads/' . $saveName;

                  ImageModel::create([
                      'image_class_id' => $category_id,
                      'original_name' => $file->getOriginalName(),
                      'name'     => $saveName,
                      'url'           => $url,
                      'size'          => filesize($path),
                      'ext'           => $file->extension(),
                  ]);
              }
              // 모든 파일이 성공했을 때만 커밋
              Db::commit();

              return ([
                  'message' => '上传成功！'
              ]);
        } catch (\think\exception\ValidateException $e) {
            // 유효성 검증 실패 시 롤백
            Db::rollback();
            $this->cleanupFiles($uploadedPaths);
            return json(['error' => '验证失败: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // 기타 오류 시 롤백
            Db::rollback();
            $this->cleanupFiles($uploadedPaths);
            return json(['error' => '上传失败: ' . $e->getMessage()]);
        }
    }

    // 🔧 업로드 실패 시 파일 정리용 함수
    private function cleanupFiles(array $paths)
    {
        try {
            if (!$paths) {  // 빈 배열, null, false, 0 등
                return false;
            }
            foreach ($paths as $path) {
                // 상대 경로로 변환
                $relativePath = str_replace('/uploads/', '', $path);

                // Filesystem 디스크 사용
                $disk = Filesystem::disk('public');

                // 파일 존재 여부 확인 후 삭제
                if ($disk->exists($relativePath)) {
                    return $disk->delete($relativePath);
                }
            }
            return false; // 존재하지 않음
        } catch (\Exception $e) {
            // 로그 기록 가능
            \think\facade\Log::error('파일 삭제 실패: ' . $e->getMessage());
            return false;
        }
    }
}