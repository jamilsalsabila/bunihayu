<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email - Contact Us</title>
</head>

<body>
    <div>
        <p>{{ $data['nama'] }}</p>

        <p>{{ $data['email'] }}</p>
        <p>{{ $data['hp'] }}</p>

        <span>{{ $data['pesan'] }}</span>
    </div>
</body>

</html>