<?php
function sendMail($fname, $fmail, $to, $subject, $content, $type = 0, $reply = '', $file = '', $cc = '', $bcc = '')
{
    if ($type != 1)
        $content = nl2br($content);

    $mail = new MAILER(true);

    if ($sender = CM_SENDER_EMAIL) {
        $mail->setFrom($sender, CM_SENDER_NAME);
    } else {
        $mail->setFrom($fmail, $fname);
    }

    $mail->ClearReplyTos();

    if (!$reply)
        $mail->addReplyTo($fmail, $fname);

    if ($reply) {
        if (!is_array($reply)) {
            $mail->addReplyTo($reply);
        } else {
            foreach ($reply as $k => $v) {
                $mail->addReplyTo($k, $v);
            }
        }
    }

    $mail->Subject = $subject;
    $mail->AltBody = '';
    $mail->msgHTML($content);

    if (!is_array($to)) {
        $mail->addAddress($to);
    } else {
        foreach ($to as $k => $v) {
            $mail->addAddress($k, $v);
        }
    }

    if ($cc) {
        if (!is_array($cc)) {
            $mail->addCC($cc);
        } else {
            foreach ($cc as $k => $v) {
                $mail->addCC($k, $v);
            }
        }
    }

    if ($bcc) {
        if (!is_array($bcc)) {
            $mail->addBCC($bcc);
        } else {
            foreach ($bcc as $k => $v) {
                $mail->addBCC($k, $v);
            }
        }
    }

    if ($file != '') {
        foreach ($file as $f) {
            $mail->addAttachment($f['path'], $f['name']);
        }
    }

    try {
        $mail->send();
        //echo "Message has been sent successfully";
        $result = 'Message has been sent successfully';
    } catch (Exception $e) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        $result = 'Mailer Error: ' . $mail->ErrorInfo;
    }

    return $result;
}