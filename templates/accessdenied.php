<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RAVE</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">
    <style>
        body {
            padding: 2rem;
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h1>RAVE (REST API Very Epic) </h1>
    <p>
        <?php
            if (!empty($data['noKey']))
                echo 'A valid <strong>API key</strong> is required to gain access. To get one contact <a href="mailto:mail@foo.bar">mail@foo.bar</a>.';
            else if (!empty($data['noResource']))
                echo 'No access to this resource. To gain access contact <a href="mailto:mail@foo.bar">mail@foo.bar</a>.';
        ?>
        
    </p>
</body>
</html>
