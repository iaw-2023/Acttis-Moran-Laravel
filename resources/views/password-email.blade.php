<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - Contraseña</title>
</head>
<body>
<p>Hola,</p>
<p>Tu contraseña en {{ config('app.name') }} es: <strong>{{ $password }}</strong></p>
<p>Por favor, asegúrate de mantener esta información segura y no compartirla con nadie.</p>
<p>Saludos cordiales,</p>
<p>El equipo de {{ config('app.name') }}</p>
</body>
</html>
