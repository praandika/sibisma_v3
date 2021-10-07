<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $title }}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('dist/img/SibismaIcon.png') }}">

  <style>
    body{
      font-family: Arial, "Tw Cent MT", "Century Gothic", Helvetica;
      font-size: 17px;
    }
    .tbreport thead tr{
      background-color: #E3E0E0;
      border: 1px solid #000000;
    }
    .tbreport tfoot tr{
      background-color: #F6F1F1;
      border-style: 2px solid #161616;
    }
    .tbreport{
      width: 100%;
    }
    .tbreport tr th{
      padding: 5px;
    }
    .tbreport tr td{
      padding: 5px;
      border-top: 0.5px dashed #7F7F7F;
    }
    .tanggal{
      font-size: 9px;
    }
    .footer-report{
      font-weight: bold;
      font-size: 18px;
    }
    .table-report{
      column-width: 100px;
    }
    .label-header{
      background-color: #3131A8;
      color: #FFFFFF;
    }
  </style>
</head>

<body>
@yield('content')
<footer class="footer">
  <center style="font-size: 10px">
  <hr>
  &copy; Tim CRM Bisma
  <br>
  Sistem Informasi Bisma
</center>
</footer>
</body>
</html>
