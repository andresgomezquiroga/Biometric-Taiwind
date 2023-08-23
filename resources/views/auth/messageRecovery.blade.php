<h1>Para recuperar tu contraseña debe ingresar al siguiente link</h1>
<p>Este es tu codigo de recuperación: {{ $code }}</p>
<a href="{{ url ('/showVerifyCode/' . $token)}}">Entra a este link</a>
