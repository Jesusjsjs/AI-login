<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/login.css" />
    <title>Login</title>
</head>
<body>
    <form class= "login-form" method="post">
        <h1 >Bienvenido</h1>
        <input 
            name="correo" 
            class="inputLogin" 
            type="text" 
            placeholder="Correo electronico" 
            required 
        />
        <input 
            name="password" 
            class="inputLogin" 
            type="password" 
            placeholder="Contraseña" 
            required 
        />
        <br/>
        <button type="submit" name="send2">LOGIN</button>
        <!-- <p class="message">No te haz registrado? <a href="#" style>Crea una cuenta</a></p> -->
    </form>

    
</body>
</html>


