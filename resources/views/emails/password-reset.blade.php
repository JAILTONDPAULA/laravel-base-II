@extends('emails.layout')

@section('content')
    <!-- Título principal -->
    <h1 style="
        margin: 0 0 30px 0;
        color: #343a40;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        line-height: 1.3;
    ">
        🔐 Redefinição de Senha
    </h1>

    <!-- Saudação -->
    <p style="
        margin: 0 0 20px 0;
        color: #495057;
        font-size: 16px;
        line-height: 1.6;
    ">
        Olá <strong>{{ $name }}</strong>,
    </p>

    <!-- Descrição do e-mail -->
    <p style="
        margin: 0 0 25px 0;
        color: #495057;
        font-size: 16px;
        line-height: 1.6;
    ">
        Você solicitou a redefinição da senha de sua conta em nosso sistema.
        Este e-mail contém as informações necessárias para que você possa criar uma nova senha de forma segura.
    </p>

    <!-- Box com informações importantes -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="
        margin: 25px 0;
        background-color: #e8f4fd;
        border-left: 4px solid #007bff;
        border-radius: 6px;
    ">
        <tr>
            <td style="padding: 25px;">
                <p style="
                    margin: 0 0 15px 0;
                    color: #0056b3;
                    font-size: 16px;
                    font-weight: 600;
                    line-height: 1.4;
                ">
                    📌 Informações do Reset:
                </p>

                <p style="
                    margin: 0 0 10px 0;
                    color: #495057;
                    font-size: 14px;
                    line-height: 1.5;
                ">
                    <strong>Token:</strong> 
                    <span style="
                        font-size: 18px;
                        font-weight: bold;
                        color: #007bff;
                        background: #f8f9fa;
                        padding: 5px 10px;
                        border-radius: 4px;
                        border: 2px dashed #007bff;
                        display: inline-block;
                        font-family: 'Courier New', monospace;
                        letter-spacing: 2px;
                    ">{{ $token }}</span>
                </p>

                <p style="
                    margin: 0;
                    color: #6c757d;
                    font-size: 13px;
                    line-height: 1.4;
                ">
                    Use o token acima para redefinir sua senha através do link abaixo.
                </p>
            </td>
        </tr>
    </table>

    <!-- Botão de ação -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 30px 0;">
        <tr>
            <td align="center">
                <a href="{{ $url }}" style="
                    display: inline-block;
                    padding: 15px 35px;
                    background-color: #007bff;
                    color: #ffffff !important;
                    text-decoration: none;
                    border-radius: 6px;
                    font-weight: 600;
                    font-size: 16px;
                    text-align: center;
                    line-height: 1;
                    border: none;
                    cursor: pointer;
                ">
                    🔑 Redefinir Minha Senha
                </a>
            </td>
        </tr>
    </table>

    <!-- Informações de segurança -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="
        margin: 30px 0;
        background-color: #fff3cd;
        border-left: 4px solid #ffc107;
        border-radius: 6px;
    ">
        <tr>
            <td style="padding: 20px;">
                <p style="
                    margin: 0 0 10px 0;
                    color: #856404;
                    font-size: 15px;
                    font-weight: 600;
                    line-height: 1.4;
                ">
                    ⚠️ Importante:
                </p>

                <ul style="
                    margin: 0;
                    padding-left: 20px;
                    color: #856404;
                    font-size: 14px;
                    line-height: 1.5;
                ">
                    <li style="margin: 0 0 8px 0;">Se você não solicitou esta redefinição, ignore este e-mail</li>
                    <li style="margin: 0 0 8px 0;">Este link expira em 5 minutos por segurança</li>
                    <li style="margin: 0 0 8px 0;">Nunca compartilhe este token com outras pessoas</li>
                    <li style="margin: 0;">Sua senha atual permanecerá ativa até que seja alterada</li>
                </ul>
            </td>
        </tr>
    </table>

    <!-- Link alternativo caso o botão não funcione -->
    <p style="
        margin: 25px 0 0 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.5;
        text-align: center;
    ">
        Se o botão não funcionar, copie e cole este link no seu navegador:<br>
        <a href="{{ $url }}" style="color: #007bff; text-decoration: underline;margin-bottom: 16px;">{{ $url }}</a>
    </p>

    <!-- Mensagem de segurança -->
    <p style="
        margin: 30px 0 0 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
        text-align: center;
        border-top: 1px solid #dee2e6;
        padding-top: 20px;
    ">
        🔒 <strong>Dica de Segurança:</strong> Sempre verifique se este email veio do endereço oficial
        e nunca compartilhe suas credenciais com terceiros.
    </p>
@endsection
