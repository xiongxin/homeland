<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 * php cli.php "request_uri=/console/method"
*/
class ConsoleController extends Yaf\Controller_Abstract  {

    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
    }

    private function delete_files($path, $del_dir = FALSE, $level = 0){
        // Trim the trailing slash
        $path = rtrim($path, DIRECTORY_SEPARATOR);

        if ( ! $current_dir = @opendir($path))
        {
            return FALSE;
        }

        while (FALSE !== ($filename = @readdir($current_dir)))
        {
            if ($filename != "." and $filename != "..")
            {
                if (is_dir($path.DIRECTORY_SEPARATOR.$filename))
                {
                    // Ignore empty folders
                    if (substr($filename, 0, 1) != '.')
                    {
                        $this->delete_files($path.DIRECTORY_SEPARATOR.$filename, $del_dir, $level + 1);
                    }
                }
                else
                {
                    unlink($path.DIRECTORY_SEPARATOR.$filename);
                }
            }
        }
        @closedir($current_dir);

        if ($del_dir == TRUE AND $level > 0)
        {
            return @rmdir($path);
        }

        return TRUE;
    }

    public function cleanCacheAction(){

        if($this->delete_files(ROOT_PATH.'/runtime/cache')){
            echo json_encode(['errcode'=>0,'errmsg'=>'清除缓存成功!']);
        }else{
            echo json_encode(['errcode'=>1,'errmsg'=>'清除缓存失败!']);
        }
    }
}
