<?php
class ArUpload extends ArComponent
        { public $dest = ''; public $errorMsg = null; protected $upField = ''; public function errorMsg() { return $this->errorMsg; } static public $extensionMap = array( 'img' => array( 'jpg', 'gif', 'png' ), ); public function upload($upField, $dest = '', $extension = 'all') { $this->errorMsg = null; $this->upField = $upField; if (!empty($_FILES[$this->upField]) && empty($_FILES['error']) && is_uploaded_file($_FILES[$this->upField]['tmp_name'])) : if ($extension == 'all' || $this->checkFileType($this->getFileExtensionName($_FILES[$this->upField]['name']), $extension)) : $dest = empty($dest) ? arCfg('PATH.UPLOAD') : $dest; if (!is_dir($dest)) : mkdir($dest, 0777, true); endif; $upFileName = $this->generateFileName(); $destFile = rtrim($dest, DS) . DS . $upFileName; if (move_uploaded_file($_FILES[$this->upField]['tmp_name'], $destFile)) : else : $this->errorMsg = '上传出错'; endif; endif; else : $this->errorMsg = "Filed '$upField' invalid"; endif; if (!!$this->errorMsg) : return false; else : return $upFileName; endif; } protected function checkFileType($extension, $aExtension = 'img') { if (array_key_exists($aExtension, self::$extensionMap)) : if (!in_array($extension, self::$extensionMap[$aExtension])) : $this->errorMsg = "仅支持" . implode(',', self::$extensionMap[$aExtension]). "类型"; endif; elseif ($extension != $aExtension) : $this->errorMsg ="仅支持{$aExtension}类型"; endif; return !$this->errorMsg; } protected function generateFileName() { return md5(time() . rand()) . '.' . $this->getFileExtensionName($_FILES[$this->upField]['name']); } protected function getFileExtensionName($fileName) { return strtolower(substr($fileName, strrpos($fileName, '.') + 1)); } } 
?>