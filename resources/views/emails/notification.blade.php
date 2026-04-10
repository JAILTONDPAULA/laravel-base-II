@extends('emails.layout')

@section('content')
    <!-- Título -->
    <h1 style="
        margin: 0 0 20px 0;
        color: #343a40;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        line-height: 1.3;
    ">
        {{ $title }}
    </h1>
    
    <!-- Saudação -->
    @if(!empty($name))
    <p style="
        margin: 0 0 20px 0;
        color: #495057;
        font-size: 16px;
        line-height: 1.6;
    ">
        Olá <strong>{{ $name }}</strong>,
    </p>
    @endif
    
    <!-- Mensagem principal -->
    <div style="
        margin: 20px 0 30px 0;
        color: #495057;
        font-size: 16px;
        line-height: 1.6;
    ">
        {!! nl2br(e($message)) !!}
    </div>
    
    <!-- Botão de ação (se fornecido) -->
    @if(isset($actionUrl) && isset($actionText))
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 30px 0;">
        <tr>
            <td style="text-align: center;">
                <a href="{{ $actionUrl }}" style="
                    display: inline-block;
                    padding: 15px 30px;
                    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                    color: #ffffff !important;
                    text-decoration: none;
                    font-size: 16px;
                    font-weight: 600;
                    border-radius: 6px;
                    box-shadow: 0 2px 8px rgba(0,123,255,0.3);
                    text-align: center;
                    min-width: 200px;
                " target="_blank">
                    {{ $actionText }}
                </a>
            </td>
        </tr>
    </table>
    @endif
    
    <!-- Informações adicionais -->
    @if(isset($additionalInfo) && !empty($additionalInfo))
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="
        margin: 25px 0;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    ">
        <tr>
            <td style="padding: 20px;">
                <div style="
                    color: #495057;
                    font-size: 14px;
                    line-height: 1.6;
                ">
                    {!! nl2br(e($additionalInfo)) !!}
                </div>
            </td>
        </tr>
    </table>
    @endif
    
    <!-- Assinatura -->
    <p style="
        margin: 30px 0 0 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
        text-align: center;
        border-top: 1px solid #dee2e6;
        padding-top: 20px;
    ">
        Atenciosamente,<br>
        <strong>Equipe {{ config('app.name') }}</strong>
    </p>
@endsection