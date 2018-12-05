<?php

namespace Modules\System\Upload\Controllers;

use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Ilya\Models\Blobs;

/**
 * @property Helper helper
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        try {
            $blob = $this->dispatcher->getParam('blob');

            $exp_blob = explode('.', $blob);

            $blobId = $exp_blob[0];
            $format = $exp_blob[1];

            if(!$blobId)
                throw new \Exception('Error 1');

            if(!is_numeric($blobId))
                throw new \Exception('Error 2');

            $blob = Blobs::findFirst($blobId);

            if(!$blob)
                throw new \Exception('Error 3');

            if($blob->format !== $format)
                throw new \Exception('Error 4');

            if(!isset($blob->content))
            {
                $fileName = BASE_PATH. 'public/files/'. $blobId. '.'. $blob->format;
                $blob->content = file_get_contents($fileName);
            }

            // allows browsers and proxies to cache the blob (30 days)
            header('Cache-Control: max-age=2592000, public');

            $disposition = 'inline';

            switch ($blob->format) {
                case 'jpeg':
                case 'jpg':
                    header('Content-Type: image/jpeg');
                    break;

                case 'gif':
                    header('Content-Type: image/gif');
                    break;

                case 'png':
                    header('Content-Type: image/png');
                    break;

                case 'pdf':
                    header('Content-Type: application/pdf');
                    break;

                case 'swf':
                    header('Content-Type: application/x-shockwave-flash');
                    break;

                default:
                    header('Content-Type: application/octet-stream');
                    $disposition = 'attachment';
                    break;
            }

            // for compatibility with HTTP headers and all browsers
            $filename = preg_replace('/[^A-Za-z0-9 \\._-]+/', '', $blob->name);
            header('Content-Disposition: ' . $disposition . '; filename="' . $filename . '"');

            echo $blob->content;
            die;
        } catch(\Exception $exception) {
            dump($exception->getMessage());
        }
    }

    public function thumbAction()
    {
        try {
            $blob = $this->dispatcher->getParam('blob');

            $exp_blob = explode('.', $blob);

            $blobId = $exp_blob[0];
            $format = $exp_blob[1];

            if(!$blobId)
                throw new \Exception('Error 1');

            if(!is_numeric($blobId))
                throw new \Exception('Error 2');

            $blob = Blobs::findFirst($blobId);

            if(!$blob)
                throw new \Exception('Error 3');

            if($blob->format !== $format)
                throw new \Exception('Error 4');

            if(!isset($blob->content))
            {
                $fileName = BASE_PATH. 'public/files/thumbnail/'. $blobId. '.'. $blob->format;
                $blob->content = file_get_contents($fileName);
            }

            // allows browsers and proxies to cache the blob (30 days)
            header('Cache-Control: max-age=2592000, public');

            $disposition = 'inline';

            switch ($blob->format) {
                case 'jpeg':
                case 'jpg':
                    header('Content-Type: image/jpeg');
                    break;

                case 'gif':
                    header('Content-Type: image/gif');
                    break;

                case 'png':
                    header('Content-Type: image/png');
                    break;

                case 'pdf':
                    header('Content-Type: application/pdf');
                    break;

                case 'swf':
                    header('Content-Type: application/x-shockwave-flash');
                    break;

                default:
                    header('Content-Type: application/octet-stream');
                    $disposition = 'attachment';
                    break;
            }

            // for compatibility with HTTP headers and all browsers
            $filename = preg_replace('/[^A-Za-z0-9 \\._-]+/', '', $blob->name);
            header('Content-Disposition: ' . $disposition . '; filename="' . $filename . '"');

            echo $blob->content;
            die;
        } catch(\Exception $exception) {
            dump($exception->getMessage());
        }
    }

    public function dltempsAction()
    {
        $this->view->disable();
        try {
            $blobs = Blobs::find([
                'columns' => 'id,format,status',
                'conditions' => 'status = :status:',
                'bind' => [
                    'status' => 'tmp'
                ]
            ]);

            if(count($blobs->toArray()) === 0)
            {
                throw new \Exception('Error 1');
            }

            $files_path = BASE_PATH. 'public/files/';

            /** @var Blobs $blob */
            foreach($blobs as $blob)
            {
                $blob = Blobs::findFirst($blob->id);
                if(!$blob)
                    continue;

                $filename = $files_path. $blob->id. '.'. $blob->format;
                $filenameThumb = $files_path. 'thumbnail/'. $blob->id. '.'. $blob->format;

                if(!$blob->delete())
                {
                    dump($blob->getMessages());
                }

//                unlink($filename);
//                unlink($filenameThumb);
            }

        } catch(\Exception $exception)
        {
            dump($exception->getMessage());
        }
    }
}