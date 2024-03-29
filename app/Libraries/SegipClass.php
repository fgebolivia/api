<?php
namespace App\Libraries;

use Exception;

class SegipClass
{
    function __construct()
    {
    }

    public function getCertificacionSegip($data)
    {
        // === INICIALIZACION DE VARIABLES ===
            $respuesta = array(
                'respuesta' => '',
                'sw'        => 0
            );

            $error1 = FALSE;
            //dd($data);
        // === OPERACION ===
            try
            {

                $params = [
                    'encoding' => 'UTF-8'
                ];

                $cliente = new \SoapClient('http://172.27.104.3:86/ServicioExternoInstitucion.svc?singleWsdl', $params);
                //dd($cliente);
                $parametros = array(
                    'pCodigoInstitucion'       => 4,//env('SEGIP_CODIGO_INSTITUCION'),
                    'pUsuario'                 => 'pablo.corral',//env('SEGIP_USUARIO'),
                    'pContrasenia'             => 'Corral2018',//env('SEGIP_CONTRASENIA'),
                    'pClaveAccesoUsuarioFinal' => 'P33638371',//env('SEGIP_CLAVE_ACCESO_USUARIO_FINAL'),
                    'pNumeroAutorizacion'      => '',
                    'pNumeroDocumento'         => $data['n_documento'],
                    'pComplemento'             => $data['complemento'],
                    'pNombre'                  => $data['nombre'],
                    'pPrimerApellido'          => $data['ap_paterno'],
                    'pSegundoApellido'         => $data['ap_materno'],
                    'pFechaNacimiento'         => date("d/m/Y", strtotime($data['f_nacimiento']))
                );

                $respuesta_soap1 = (array) $cliente->ConsultaDatoPersonaCertificacion($parametros);
                //dd($respuesta_soap1);
                $respuesta_soap = (array) $respuesta_soap1["ConsultaDatoPersonaCertificacionResult"];
            }
            catch (Exception $e)
            {
                $respuesta['respuesta'] .= "ERROR EN EL SOAP";
                $error1                  = TRUE;
            }

            if( ! $error1)
            {
                $respuesta['respuesta'] = $respuesta_soap;
                $respuesta['sw']        = 1;

            }

        return $respuesta;
    }
}