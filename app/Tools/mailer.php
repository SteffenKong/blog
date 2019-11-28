<?php

namespace App\Tools;

use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

/**
 * Class mailer
 * @package App\Tools
 * 邮件发送
 */
class mailer {

    private $mailer;


    /**
     * 连接邮件服务器
     */
    private function connectMailServer() {
        $this->mailer = new SmtpMailer([
            'host' => 'smtp.gmail.com',
            'username' => '',
            'password' => '',
            'secure' => 'ssl',
            'context' =>  [
                'ssl' => [
                    'capath' => '/path/to/my/trusted/ca/folder',
                ],
            ],
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
        $mail->setFrom('John <john@example.com>')
            ->addTo($addTo)
            ->setSubject($subject)
            ->setHTMLBody("<p>".$content."</p>");
        return $this->mailer->send($mail);
    }
}
