<?php
namespace Tools;

class Logor
{
    private static $PATH;
    public static function setPath($path)
    {
        self::$PATH = $path;
    }

    private static $LOGORS = array();
    public static function getLogors()
    {
        return self::$LOGORS;
    }

    private $fileName;
    private $fp;

    private function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->openFp();
    }

    private function openFp()
    {
        if (is_null(self::$PATH)) return;

        $fullPath = self::$PATH . '/' . date('d-m-Y', time());
        mkdir($fullPath, 0700, true);
        $this->fp = fopen($fullPath . '/' . $this->fileName . '.log', 'a+');
    }

    public static function get($fileName, $logorName = 'main')
    {
        if(isset(self::$LOGORS[$logorName]))
            return self::$LOGORS[$logorName];
        
        self::$LOGORS[$logorName] = new Logor($fileName);
        return self::$LOGORS[$logorName];
    }

    public function log($data)
    {
        fwrite($this->fp, $this->dataHandler($data));
    }

    private function dataHandler($rawData)
    {
        $stringlifyData = "";
        $stringlifyData .= "[" . date('d-m-Y, H:i:s', time()) . "]";
        $stringlifyData .= "\r\n";
        $stringlifyData .= print_r($rawData, true);
        $stringlifyData .= "\r\n";
        return $stringlifyData;
    }

    function __destruct()
    {
        fclose($this->fp);
    }
}