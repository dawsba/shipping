<?php


namespace Models\TransportMethod;


/**
 * Class FTP
 * @package Models\TransportMethod
 */
class FTP extends TransportMethod implements TransportMethodInterface
{
    /**
     * @var mixed
     */
    private $connection;

    /**
     * @var bool
     */
    private $usePassive = false;

    /**
     * @var string
     */
    private $host = '';

    /**
     * @var string
     */
    private $remotePath = '';

    /**
     * @var null|string
     */
    private $remoteUsername = null;

    /**
     * @var null|string
     */
    private $remotePassword = null;

    /**
     * @var int
     */
    private $ftpMode = FTP_ASCII;

    /**
     * Sends data packet from open string/data to FTP remote file
     *
     * Returns TRUE on success
     *
     * @return bool
     */
    public function send()
    {
        // todo remove for production
        return true;


        // Create temp file handle
        $_tempHandle = fopen('php://temp', 'r+');

        // Get file data and push into temp
        fwrite($_tempHandle, $this->getData());
        rewind($_tempHandle);

        // Create FTP connection
        $this->setConnection(ftp_connect($this->getHost()));

        // Login to FTP server
        if (null !== $this->getRemoteUsername()) {
            $_login = ftp_login(
                $this->getConnection(),
                $this->getRemoteUsername(),
                $this->getRemotePassword()
            );
        }

        // Check passive mode
        if (true === $this->isUsePassive()) {
            ftp_pasv($this->connection, true);
        }

        // Push data
        if (ftp_put($this->getConnection(), $this->getRemotePath(), $_tempHandle, $this->getFtpMode())) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getData()
    {
        $data = parent::getData();
        
        if (is_array($data)) return implode(',', $data);
        
        return $data;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return bool
     */
    public function isUsePassive()
    {
        return $this->usePassive;
    }

    /**
     * @param bool $usePassive
     */
    public function setUsePassive($usePassive)
    {
        $this->usePassive = $usePassive;
    }

    /**
     * @return string
     */
    public function getRemotePath()
    {
        return $this->remotePath;
    }

    /**
     * @param string $remotePath
     */
    public function setRemotePath($remotePath)
    {
        $this->remotePath = $remotePath;
    }

    /**
     * @return null|string
     */
    public function getRemoteUsername()
    {
        return $this->remoteUsername;
    }

    /**
     * @param null|string $remoteUsername
     */
    public function setRemoteUsername($remoteUsername)
    {
        $this->remoteUsername = $remoteUsername;
    }

    /**
     * @return null|string
     */
    public function getRemotePassword()
    {
        return $this->remotePassword;
    }

    /**
     * @param null|string $remotePassword
     */
    public function setRemotePassword($remotePassword)
    {
        $this->remotePassword = $remotePassword;
    }

    /**
     * @return int
     */
    public function getFtpMode()
    {
        return $this->ftpMode;
    }

    /**
     * @param int $ftpMode
     */
    public function setFtpMode($ftpMode)
    {
        $this->ftpMode = $ftpMode;
    }
}
