<?php

namespace JC\TaskHalter;

/**
 * Class Halter
 * @package JC\TaskHalter
 */
class Halter
{
    /**
     * Default runtime path
     */
    const RUNTIME_PATH = '/tmp';
    /**
     *
     * Default haltfile extension
     */
    const HALTFILE_EXT = '.halt';
    /**
     * @var null
     */
    public $name;
    /**
     * @var
     */
    public $fileExtension;
    /**
     * @var string
     */
    public $runtimePath;
    /**
     * @var
     */
    protected $haltFile;


    /**
     * Halter constructor.
     * @param null $name
     * @param $runtimePath
     */
    public function __construct($name = null, $runtimePath = self::RUNTIME_PATH)
    {
        $this->setName($name);
        $this->setRuntimePath($runtimePath);
        $this->setFileExtension();
    }

    /**
     * Sets the task halter unique identification name
     * @param null $name
     * @return Halter
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the task halter unique identification name
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets halter file extension
     * @param string $fileExtension
     * @return $this
     */
    public function setFileExtension($fileExtension = self::LOCKFILE_EXT)
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * Gets halter file extension
     * @return mixed
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Sets the runtime path
     * @param string $runtimePath
     * @return Halter
     */
    public function setRuntimePath($runtimePath)
    {
        $this->runtimePath = $runtimePath;
        return $this;
    }

    /**
     * Gets the runtime path
     * @return string
     */
    public function getRuntimePath()
    {
        return $this->runtimePath;
    }


    /**
     * @param $haltFile
     * @return $this
     */
    public function setHaltFile($haltFile)
    {
        $this->haltFile = $haltFile;
        return $this;
    }

    /**
     * Generates the halt file name.
     * @return string
     */
    private function getHaltFile()
    {
        return $this->getRuntimePath() . '/' . $this->getName() . $this->getFileExtension();
    }

    /**
     * Checks if app is marked to be halt by halt().
     * @return bool
     */
    public function isSetToHalt()
    {
        $this->checkConfig();
        $haltFile = $this->getHaltFile();

        if (file_exists($haltFile)) {
            unlink($haltFile);

            return true;
        }

        return false;
    }

    /**
     * Set app to be killed
     */
    public function halt()
    {
        $this->checkConfig();

        if (touch($this->getHaltFile())) {
            return true;
        }

        return false;
    }

    /**
     * Required properties check
     * @return bool
     */
    private function checkConfig()
    {
        if (is_null($this->getName())) {
            throw new \InvalidArgumentException('Invalid Task Name');
        }

        return true;
    }
}