@php
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
<body>
    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#fdfaf6">
        <tr>
            <td align="center" style="padding: 20px 10px;">
                <table class="main-table" width="600" cellpadding="0" cellspacing="0">
                    <!-- Cabecera igual al correo -->
                    <tr>
                        <td style="padding: 30px 0; background-color: #f4f1e4;">
                            <img src="data:image/png;base64,{{ trim($logoB64) }}" alt="Logo" class="logo">
                        </td>
                    </tr>
                    
                    <!-- Contenido de confirmación -->
                    <tr>
                        <td class="content-padding" style="padding: 40px 32px;">
                            <h1 style="...">¡Correo verificado!</h1>
                            
                            <p style="...">
                                Ahora tu cuenta está activa y puedes iniciar sesión.
                            </p>
                            
                            <div style="text-align: center; margin: 35px 0;">
                                <a href="{{ route('login') }}" 
                                   style="...">
                                    Ir al Login
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Pie de página igual al correo -->
                </table>
            </td>
        </tr>
    </table>
</body>
</html>