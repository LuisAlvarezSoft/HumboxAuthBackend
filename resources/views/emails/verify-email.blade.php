@php
  // Lee el Base64 puro
  $logoB64 = file_get_contents(public_path('logo_claro_base64.txt'));
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo</title>
    <style type="text/css">
        @media screen and (max-width: 600px) {
            .main-table {
                width: 100% !important;
            }
            .logo {
                width: 180px !important;
            }
            .content-padding {
                padding: 30px 20px !important;
            }
            h1 {
                font-size: 24px !important;
            }
            .button {
                width: 100% !important;
                padding: 12px 20px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color: #fdfaf6; font-family: 'Segoe UI', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#fdfaf6">
        <tr>
            <td align="center" style="padding: 20px 10px;">
                <!-- Contenedor principal -->
                <table class="main-table" width="600" cellpadding="0" cellspacing="0" style="max-width: 100%; margin: 0 auto; background: #fdfaf6; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <!-- Cabecera con logo más grande -->
                    <tr>
                        <td style="padding: 30px 0; background-color: #f4f1e4;">
                            <img
                                src="data:image/png;base64,{{ trim($logoB64) }}"
                                alt="Logo de Humbox"
                                class="logo"
                                style="width: 220px; height: auto; display: block; margin: 0 auto; line-height: 1.6; max-width: 100%;"
                            >
                        </td>
                    </tr>
                    
                    <!-- Contenido -->
                    <tr>
                        <td class="content-padding" style="padding: 40px 32px;">
                            <h1 style="color: #1b2e46; font-size: 28px; font-weight: 600; margin: 0 0 20px 0; text-align: center;">
                                ¡Verifica tu correo!
                            </h1>
                            
                            <p style="color: #4a5568; font-size: 16px; line-height: 1.6; margin: 0 0 28px 0; text-align: center;">
                                Gracias por registrarte en Humbox. Para activar tu cuenta, haz clic en el botón:
                            </p>
                            
                            <!-- Botón -->
                            <div style="text-align: center; margin: 35px 0;">
                                <form method="POST" action="{{ url('/api/auth/email/confirm') }}" style="display: inline;">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <button type="submit" 
                                            class="button"
                                            style="background-color: #be2621; 
                                                   color: #ffffff; 
                                                   text-decoration: none; 
                                                   padding: 16px 32px; 
                                                   border-radius: 8px; 
                                                   display: inline-block; 
                                                   font-size: 16px; 
                                                   font-weight: 600; 
                                                   transition: all 0.3s ease;
                                                   box-shadow: 0 2px 8px rgba(190,38,33,0.2);
                                                   max-width: 90%; 
                                                   word-break: break-word;
                                                   border: none;
                                                   cursor: pointer;">
                                        Verificar mi correo
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Texto -->
                            <p style="color: #718096; font-size: 14px; line-height: 1.6; margin: 20px 0 0 0; text-align: center;">
                                Este enlace expirará en <strong style="color: #1b2e46;">60 minutos</strong><br>
                                Si no reconoces esta acción, por favor ignora este mensaje
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Pie de página -->
                    <tr>
                        <td style="background: #fdfaf6; padding: 20px; border-top: 1px solid #e2e8f0;">
                            <p style="color: #718096; font-size: 12px; line-height: 1.6; margin: 0; text-align: center;">
                                © 2025 Humbox · Todos los derechos reservados<br>
                                <span style="display: inline-block; padding-top: 8px;">
                                    Este es un mensaje autogenerado, no respondas a este correo.
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