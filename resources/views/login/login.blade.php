
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

   <!-- estilos css-->
   <link rel="stylesheet" href="{{asset('css/main.css')}}">     


    <title>System electrónic</title>

</head>
<body>
    <div class="login">
        <img src="{{asset('/img/logo.png')}}" alt="logo">
        <form method="POST">
            @csrf
            <input type="text" name="id" placeholder="Usuario" required="required" />
            <input type="password" name="password" placeholder="Contraseña" required="required" />
            {!! $errors->first('user','<span class="help-block">:message</span><br>') !!}
            <br>
            <button type="submit" class="btn btn-primary btn-block btn-large">Login.</button>
        </form>
    </div>
</body>
</html>




