@extends('emails.layout')

@section('content')
    <!-- Título de boas-vindas -->
    <h1 style="
        margin: 0 0 20px 0;
        color: #343a40;
        font-size: 28px;
        font-weight: 700;
        text-align: center;
        line-height: 1.3;
    ">
        🎉 Bem-vindo(a) ao {{ config('app.name') }}!
    </h1>
    
    <!-- Saudação personalizada -->
    <p style="
        margin: 0 0 25px 0;
        color: #495057;
        font-size: 18px;
        line-height: 1.6;
        text-align: center;
        font-weight: 500;
    ">
        Olá <strong style="color: #007bff;">{{ $name }}</strong>, é um prazer tê-lo(a) conosco!
    </p>
    
    <!-- Mensagem principal -->
    <p style="
        margin: 0 0 30px 0;
        color: #495057;
        font-size: 16px;
        line-height: 1.6;
        text-align: center;
    ">
        Sua conta foi criada com sucesso e você já pode aproveitar todos os nossos recursos.
        Estamos animados para fazer parte da sua jornada!
    </p>
    
    <!-- Box de informações da conta -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="
        margin: 30px 0;
        background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
        border: 1px solid #bbdefb;
        border-radius: 8px;
    ">
        <tr>
            <td style="padding: 25px;">
                <h3 style="
                    margin: 0 0 15px 0;
                    color: #0d47a1;
                    font-size: 18px;
                    font-weight: 600;
                    text-align: center;
                ">
                    📋 Informações da sua conta
                </h3>
                
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td style="
                            padding: 8px 0;
                            color: #1565c0;
                            font-size: 14px;
                            font-weight: 600;
                            width: 30%;
                        ">
                            E-mail:
                        </td>
                        <td style="
                            padding: 8px 0;
                            color: #0d47a1;
                            font-size: 14px;
                            font-weight: 500;
                        ">
                            {{ $email }}
                        </td>
                    </tr>
                    <tr>
                        <td style="
                            padding: 8px 0;
                            color: #1565c0;
                            font-size: 14px;
                            font-weight: 600;
                        ">
                            Data de cadastro:
                        </td>
                        <td style="
                            padding: 8px 0;
                            color: #0d47a1;
                            font-size: 14px;
                            font-weight: 500;
                        ">
                            {{ now()->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @if(isset($loginUrl))
                    <tr>
                        <td style="
                            padding: 8px 0;
                            color: #1565c0;
                            font-size: 14px;
                            font-weight: 600;
                        ">
                            Link de acesso:
                        </td>
                        <td style="
                            padding: 8px 0;
                            color: #0d47a1;
                            font-size: 14px;
                            font-weight: 500;
                        ">
                            <a href="{{ $loginUrl }}" style="color: #007bff; text-decoration: none;">
                                Fazer login
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
    
    <!-- Botão de ação principal -->
    @if(isset($actionUrl))
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 30px 0;">
        <tr>
            <td style="text-align: center;">
                <a href="{{ $actionUrl }}" style="
                    display: inline-block;
                    padding: 18px 35px;
                    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                    color: #ffffff !important;
                    text-decoration: none;
                    font-size: 16px;
                    font-weight: 600;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(40,167,69,0.3);
                    text-align: center;
                    min-width: 250px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                " target="_blank">
                    🚀 {{ $actionText ?? 'Começar Agora' }}
                </a>
            </td>
        </tr>
    </table>
    @endif
    
    <!-- Próximos passos -->
    @if(isset($nextSteps) && is_array($nextSteps))
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="
        margin: 30px 0;
        background-color: #fff8e1;
        border-left: 4px solid #ffc107;
        border-radius: 4px;
    ">
        <tr>
            <td style="padding: 25px;">
                <h3 style="
                    margin: 0 0 15px 0;
                    color: #f57c00;
                    font-size: 16px;
                    font-weight: 600;
                ">
                    🎯 Próximos passos recomendados:
                </h3>
                <ol style="
                    margin: 0;
                    padding-left: 20px;
                    color: #e65100;
                    font-size: 14px;
                    line-height: 1.8;
                ">
                    @foreach($nextSteps as $step)
                    <li style="margin-bottom: 8px;">{{ $step }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
    </table>
    @endif
    
    <!-- Informações de contato/suporte -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="
        margin: 30px 0;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 6px;
    ">
        <tr>
            <td style="padding: 20px; text-align: center;">
                <p style="
                    margin: 0 0 10px 0;
                    color: #495057;
                    font-size: 14px;
                    font-weight: 600;
                ">
                    💬 Precisa de ajuda?
                </p>
                <p style="
                    margin: 0;
                    color: #6c757d;
                    font-size: 13px;
                    line-height: 1.5;
                ">
                    Nossa equipe de suporte está sempre pronta para ajudar.<br>
                    Entre em contato conosco a qualquer momento!
                </p>
                @if(isset($supportEmail))
                <p style="
                    margin: 10px 0 0 0;
                    font-size: 13px;
                ">
                    <a href="mailto:{{ $supportEmail }}" style="
                        color: #007bff;
                        text-decoration: none;
                        font-weight: 500;
                    ">
                        📧 {{ $supportEmail }}
                    </a>
                </p>
                @endif
            </td>
        </tr>
    </table>
    
    <!-- Mensagem final -->
    <p style="
        margin: 30px 0 0 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
        text-align: center;
        border-top: 1px solid #dee2e6;
        padding-top: 20px;
    ">
        Mais uma vez, seja muito bem-vindo(a)!<br>
        <strong>Equipe {{ config('app.name') }}</strong> ❤️
    </p>
@endsection