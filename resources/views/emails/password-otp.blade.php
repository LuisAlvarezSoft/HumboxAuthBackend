@php
  // Lee el Base64 puro
  $logoB64 = file_get_contents(public_path('logo_claro_base64.txt'));
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu contraseña</title>
    <style type="text/css">
        @media screen and (max-width: 600px) {
            .main-table {
                width: 100% !important;
                max-width: 100% !important;
            }
            .logo {
                width: 200px !important;
            }
            .content-padding {
                padding: 30px 20px !important;
            }
            h1 {
                font-size: 24px !important;
            }
            .otp-code {
                font-size: 32px !important;
                letter-spacing: 2px !important;
            }
            .otp-container {
                margin: 25px 0 !important;
                padding: 12px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color: #fdfaf6; font-family: 'Segoe UI', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#fdfaf6">
        <tr>
            <td align="center" style="padding: 30px 15px;">
                <!-- Contenedor principal responsive -->
                <table class="main-table" width="600" cellpadding="0" cellspacing="0" style="max-width: 100%; margin: 0 auto; background: #fdfaf6; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <!-- Cabecera con logo aumentado -->
                    <tr>
                        <td style="padding: 35px 0; background-color: #f4f1e4;">
                            <img
                                src="data:image/png;base64,{{ trim($logoB64) }}"
                                alt="Logo de Humbox"
                                class="logo"
                                style="width: 220px; display: block; margin: 0 auto; max-width: 90%; height: auto;"
                            >
                        </td>
                    </tr>
                    
                    <!-- Contenido responsive -->
                    <tr>
                        <td class="content-padding" style="padding: 40px 32px;">
                            <h1 style="color: #1b2e46; font-size: 28px; font-weight: 600; margin: 0 0 20px 0; text-align: center;">
                                Recuperación de contraseña
                            </h1>
                            
                            <p style="color: #4a5568; font-size: 16px; line-height: 1.6; margin: 0 0 24px 0; text-align: center;">
                                Hemos recibido una solicitud para restablecer tu contraseña. Utiliza el siguiente código de verificación:
                            </p>
                            
                            <!-- Contenedor OTP responsive -->
                            <div class="otp-container" style="background: #f4f1e4; border-radius: 8px; padding: 20px; margin: 35px 0; text-align: center;">
                                <span class="otp-code" style="font-size: 40px; font-weight: 700; letter-spacing: 3px; color: #be2621; display: inline-block; min-width: 200px;">
                                    {{ $otp }}
                                </span>
                            </div>
                            
                            <p style="color: #718096; font-size: 14px; line-height: 1.6; margin: 24px 0 0 0; text-align: center;">
                                Válido por <strong style="color: #1b2e46;">15 minutos</strong><br>
                                Si no reconoces esta acción, por favor ignora este mensaje
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Pie de página optimizado -->
                    <tr>
                        <td style="background: #fdfaf6; padding: 20px; border-top: 1px solid #e2e8f0;">
                            <p style="color: #718096; font-size: 12px; line-height: 1.6; margin: 0; text-align: center;">
                                © 2025 Humbox · Todos los derechos reservados
                                <br>
                                <span style="display: inline-block; padding-top: 8px;">
                                    Este es un mensaje autogenerado, no responda a este correo.
                                </span>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>