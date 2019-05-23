<?php
defined('BASEPATH') or exit('No direct script access allowed');
//verificar cambios
class Cron extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('boletas_model');
        $this->load->model('vigencias_model');
        $this->load->model('usuario_model');
        $this->load->helper('form');
        $this->load->database('default');
        $this->load->library('encrypt');
        $this->load->library('user_agent');
        $this->load->helper('vayes_helper');
    }

    public function test()
    {

        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();

        date_default_timezone_set('Etc/UTC');
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = "mail.oopp.gob.bo";
        $mail->Port = 25;
        $mail->SMTPAuth = true;
        $mail->Username = "cristiam.herrera@oopp.gob.bo";
        $mail->Password = "450748";
        $mail->setFrom('cristiam.herrera@oopp.gob.bo', 'Cristiam Demo');
        $mail->addAddress('cristiam.herrera@oopp.gob.bo', 'Crt');
        $mail->Subject = 'Esta es la prueba de que envia';
        $mail->Body = 'Este es el cuerpo de muestra';
        $mail->AltBody = 'Este es el mensaje';
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Mensaje enviado!";
        }

    }

    public function envia($dias = null)
    {
        // echo 'si cambio de funcion ' . $dias . '<br />';
        $vencidos = array('boletas' => $this->boletas_model->getBoletas());
        $mensaje = "Procesos a vencer en $dias dias";
        // vdebug($vencidos, false, false, true);
        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();
        date_default_timezone_set('Etc/UTC');
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = "mail.oopp.gob.bo";
        $mail->Port = 25;
        $mail->SMTPAuth = true;
        $mail->Username = "cristiam.herrera@oopp.gob.bo";
        $mail->Password = "450748";
        $mail->setFrom('cristiam.herrera@oopp.gob.bo', 'Sistema SACB-PMGM');
        $mail->addAddress('cristiam.herrera@oopp.gob.bo', 'Crt');
        $mail->Subject = $mensaje;
        $contador = 1;
        $cuerpo = "El siguiente detalle informa las boletas que estan por expirar los siguientes $dias dias. <br/>";
        $cuerpo .= '<table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">#</th>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">Nro Registro</th>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">Emisor</th>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">Objeto</th>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">Monto</th>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">Solicitante</th>
                            <th style="padding: 15px;border-bottom: 1px solid #ddd;">Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($vencidos['boletas'] as $v) {
            // vdebug($v, true, false, true);
            if ($v->dif2 == $dias || $v->dif1 == $dias) {
                
                if ($v->fin != '') {
                    $fecha_vencimiento=$v->fin;
                } else { 
                    $fecha_vencimiento=$v->fn;
                }
                $cuerpo .= '
                    <tr>
                        <td style="padding: 15px;text-align: center;">'.$contador.'</td>
                        <td style="padding: 15px;text-align: center;">'.$v->codigo.'</td>
                        <td style="padding: 15px;text-align: center;">'.$v->ent_financiera.'</td>
                        <td style="padding: 15px;text-align: center;">'.$v->objeto.'</td>
                        <td style="padding: 15px;text-align: center;">'.$v->moneda.' '.number_format($v->monto, 2).'</td>
                        <td style="padding: 15px;text-align: center;">'.$v->empresa.'</td>
                        <td style="padding: 15px;text-align: center;">'.$fecha_vencimiento.'</td>
                    </tr>';
                $contador++;
            }
        }
        $cuerpo .= '</tbody>
                    </table>';
        // vdebug($cuerpo, true, false, true);
        $mail->Body = $cuerpo;
        $mail->AltBody = 'Este es el mensaje';

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Mensaje enviado!";
        }
            
    }

    public function envia_correos()
    {

        // if (!$this->session->userdata('is_logued_in')) {
        //     redirect('inicio/login', 'refresh');
        // }
        $quince = false;
        $diez = false;
        $cinco = false;
        $vencidos = array('boletas' => $this->boletas_model->getBoletas());
        // vdebug($vencidos['boletas'], false, false, true);\
        foreach ($vencidos['boletas'] as $v) {

            // vdebug($v, false, false, true);
            if ($v->dif2 == 15 || $v->dif1 == 15) {
                $quince = true;
            } elseif ($v->dif2 == 10 || $v->dif1 == 10) {
                $diez = true;
            } elseif ($v->dif2 == 5 || $v->dif1 == 5) {
                $cinco = true;
            }
        }
        if ($quince == true) {
            $this->envia(15);
        }
        //echo "quince " . $quince . "<br>";
        if ($diez == true) {
            $this->envia(10);
        }
        //echo "diez " . $diez . "<br>";
        if ($cinco == true) {
            $this->envia(5);
        }
        //echo "cinco " . $cinco . "<br>";

    }
}
