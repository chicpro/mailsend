<?php
/**
 * Mail send
 * type : text=0, html=1, text+html=2
 */

require __DIR__.'/PHPMailer/PHPMailerAutoload.php';

class MAILER extends PHPMailer
{
    public function __construct($exceptions = null)
    {
        parent::__construct($exceptions);

        if (CM_SMTP_USE === true) {
            $this->isSMTP();

            $this->Host = CM_SMTP_HOST;
            $this->Port = CM_SMTP_PORT;

            $this->Username   = CM_SMTP_USER;
            $this->Password   = CM_SMTP_PASS;
            $this->SMTPSecure = CM_SMTP_SECURE;

            $this->SMTPAuth   = CM_SMTP_AUTH;
        }

        if (CM_SMTP_DEBUG === true) {
            $this->SMTPDebug = 2;
            $this->Debugoutput = 'html';
        }

        $this->CharSet = 'UTF-8';
        $this->AltBody = '';
    }
}