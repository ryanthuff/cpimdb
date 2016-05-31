<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>NetGain IM Compliance Reporting Tool</title>
    <LINK href="css/mainNavigation.css" rel="stylesheet" type="text/css">
  </head>
    <body style="font-family: Tahoma, Verdana, Arial;">
        
        <div align="left"><img src="logo.png"></div>
        <table width="100%">
            <tr>
                <td style="background-color: #840427;"><?php include_once 'navbar.php'; ?></td>
            </tr>
        </table>
        <?php
        $page = "default";
        if (isset($_GET['q'])) {
            $page = $_GET['q'];
        }
        switch ($page) {
        case "stream" : include_once 'stream.php'; break;
        case "search" : include_once 'search.php'; break;
        case "cstream" : include_once 'cstream.php'; break;
        case "export" : include_once 'export.php'; break;
        default : include_once 'default.php';
        }
        ?>
      <div style='text-align: center; font-size: 12px; border: 1px solid #000000; padding: 10px; margin-top: 10px;'>Copyright <?php echo date('Y'); ?>&copy; AnyCompany ABC</div>
  </body>
</html>