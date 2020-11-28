<?php


namespace Models\TransportMethod;


/**
 * Class Email
 * @package Models\TransportMethod
 */
class Email extends TransportMethod implements TransportMethodInterface
{
    /**
     * @var string
     */
    private $sender = 'webmaster@bobsclothing.co.uk';

    /**
     * @var string
     */
    private $subject = '';

    /**
     * @var string
     */
    private $recipient = '';

    /**
     * @var null|string
     */
    private $headers = null;

    /**
     * Send data by simple email
     * 
     * Return TRUE on success
     * 
     * @return bool
     */
    public function send()
    {
        // Create temp headers
        $_headers = "From: {$this->getSender()}\r\nReply-To: {$this->getSender()}\r\nX-Mailer: PHP/" . phpversion();
        
        // if headers set, override temp var
        if (null !== $this->getHeaders()) {
            $_headers = $this->getHeaders();
        }
        
        if (mail($this->getRecipient(), $this->getSubject(), $this->getData(), $_headers)) {
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
     * @return null|string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param null|string $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }
}
