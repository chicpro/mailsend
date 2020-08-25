<?php
require __DIR__.'/lib/MAILER.php';
require __DIR__.'/lib/functions.php';
require __DIR__.'/config.php';

// sendMail($fname, $fmail, $to, $subject, $content, $type = 0, $reply = '', $file = '', $cc = '', $bcc = '');

$fname = 'PHPMailer';
$fmail = 'user@example.com';

$to = 'user2@example.com';

$subject = '메일 테스트입니다.';
$content = '메일 내용입니다.<br>테스트 이메일입니다.';

$result = sendMail($fname, $fmail, $to, $subject, $content, 1);

echo $result;