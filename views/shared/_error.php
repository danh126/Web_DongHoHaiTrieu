<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $this->meta['title'] ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/Web_HaiTrieu/public/images/logo-icon.png" />
    <link href="/Web_HaiTrieu/assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require_once("views/{$url}.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/Web_HaiTrieu/assets/js/scripts.js"></script>
</body>

</html>