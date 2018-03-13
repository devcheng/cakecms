<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Upload Controller
 *
 *
 * @method \Admin\Model\Entity\Upload[] paginate($object = null, array $settings = [])
 */
class UploadController extends AppController
{
    /*
     * 图片上传
     *
     * */
    public function fileupload()
    {
        $result = array();
        if (!empty($this->request->getData('file'))) {
            $filePath = 'files/';
            $result = $this->comm($filePath);
        } else {
            $result = array(
                'statusCode' => '300',
                'message' => '上传失败!',
                'filename' => ''
            );
        }
        die(json_encode($result));
    }

    /*
     * 图片上传公共方法
     *
     * */
    public function comm($filePath)
    {
        $folder = new Folder(WWW_ROOT);
        if (!is_dir($filePath)) {
            $folder->create($filePath);
        }
        $filePath = $filePath . date('Ymd');
        $uploadPath = WWW_ROOT . $filePath;
        $upload = new \FileUpload(array(
            'filePath' => $uploadPath
        ));

        $result = array();
        if ($upload->uploadFile($this->request->getData('file')) == 0) {
            $fileName = $upload->getNewFileName();
            $result = array(
                'statusCode' => '200',
                'message' => '上传成功!',
                'filename' => $filePath . '/' . $fileName
            );
        }
        return $result;
    }
}
