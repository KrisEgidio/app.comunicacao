<x-mail::message>
# Olá, <span style="font-style: italic; color: #e74c3c">{{ $usuario->name }}</span> 👋

É com grande satisfação que damos as boas-vindas ao {{env('APP_NAME')}}, a plataforma para gestão de grupos e comunicados.

Seu acesso foi criado e você já pode começar a desfrutar dos benefícios confirmando seu cadastro.

Para começar, clique no botão abaixo abaixo:

<x-mail::button :url="route('usuarios.verificar', $usuario->uuid)">
    Confirmar cadastro
</x-mail::button>

Caso você tenha dúvidas ou problemas, entre em contato conosco.

Atenciosamente, <br>
Equipe {{env('APP_NAME')}} 🚀
</x-mail::message>
