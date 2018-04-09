<?php session_start(); ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- SEO -->
    <meta name="description" content="150 words">
    <meta name="author" content="uipasta">
    <meta name="url" content="http://www.yourdomainname.com">
    <meta name="copyright" content="company name">
    <meta name="robots" content="index,follow">
    <title><?php echo $title; ?></title>
    <?php if(isset($mota)) echo "<meta name='description' content='{$mota}'>"; ?>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="images/favicon/apple-touch-icon.png">
    <!-- All CSS Plugins -->
    <link rel="stylesheet" type="text/css" href="css/plugin.css">
    <!-- Main CSS Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/truong.css">
    <!-- Google Web Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="../js/tinymce/tinymce.min.js"></script>
    <!-- <script>tinymce.init({
      selector: 'textarea',
      height: 500,
      theme: 'modern',
      plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
      toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
      image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
      ]
     });
    </script> -->
    <!-- HTML5 shiv and Respond.js support IE8 or Older for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>