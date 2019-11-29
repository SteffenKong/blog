<?php

namespace App\Tools;

use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

/**
 * Class mailer
 * @package App\Tools
 * 邮件发送
 */
class SendMailer {

    private $mailer;


    public function __construct() {
        $this->connectMailServer();
    }

    /**
     * 连接邮件服务器
     */
    private function connectMailServer() {
        $this->mailer = new SmtpMailer([
            'host' => \config('smtp.smtpServerHost'),
            'username' => \config('smtp.smtpUserName'),
            'password' => \config('smtp.smtpPassword'),
        ]);
    }


    /**
     * @param $addTo
     * @param $subject
     * @param $content
     * @return mixed
     * 发送邮件
     */
    public function send($addTo,$subject,$content) {
        $mail = new Message;
        $mail->setFrom(\config('smtp.smtp_Send_From').' <'.\config('smtp.smtpUserName').'>')
            ->addTo($addTo)
            ->setSubject($subject)
            ->setHTMLBody("<p>".$content."</p>");
        return $this->mailer->send($mail);
    }
}
