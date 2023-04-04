<!DOCTYPE html>

<head>

</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <label>Arquivo</label>
        <input type="file" name="file">
        <button type="submit">Importar</button>
    </form>
</body>
</html>

