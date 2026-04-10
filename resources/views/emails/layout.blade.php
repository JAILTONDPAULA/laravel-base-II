<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject ?? config('app.name') }}</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
</head>
<body style="
    margin: 0;
    padding: 0;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    background-color: #f4f4f4;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
">
    <!-- Wrapper completo -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4; min-height: 100vh;">
        <tr>
            <td style="padding: 20px 0;">
                <!-- Container principal -->
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="
                    margin: 0 auto;
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    max-width: 100%;
                ">
                    <!-- Header com logo -->
                    <tr>
                        <td style="
                            padding: 30px;
                            text-align: center;
                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            border-radius: 8px 8px 0 0;
                        ">
                        @php
                            $logoPath = public_path('image/logo-traum-fabrik-white.png');
                            $logoBase64 = '';
                            if (file_exists($logoPath)) {
                                $logoData = file_get_contents($logoPath);
                                $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
                            }
                        @endphp

                            <img src="{{ $logoBase64 ?: url('/image/logo-traum-fabrik.png') }}"
                                 alt="{{ config('app.name') }}"
                                 style="
                                     height: 50px;
                                     max-width: 200px;
                                     width: auto;
                                     display: block;
                                     margin: 0 auto;
                                 ">
                        </td>
                    </tr>

                    <!-- Conteúdo principal -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- Rodapé -->
                    <tr>
                        <td style="
                            padding: 30px;
                            background-color: #f8f9fa;
                            border-radius: 0 0 8px 8px;
                            border-top: 1px solid #e9ecef;
                            text-align: center;
                        ">
                            <p style="
                                margin: 0 0 10px 0;
                                color: #6c757d;
                                font-size: 14px;
                                line-height: 1.5;
                            ">
                                Este é um email automático, não responda a esta mensagem.
                            </p>
                            <p style="
                                margin: 0;
                                color: #6c757d;
                                font-size: 12px;
                                line-height: 1.5;
                            ">
                                © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
