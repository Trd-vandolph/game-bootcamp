<?php
  $file_handle = fopen("en.csv", "r");

  $fp = file("en.csv", FILE_SKIP_EMPTY_LINES);

  $lines = count($fp);

  $row = 0;
  while (!feof($file_handle) ) {
    $row++;
    $line_of_text = fgets($file_handle);
    $parts = explode('=', $line_of_text);

    $exp = explode(',', $parts[0]);

    switch ($row) {
      case "1":
        $header = $exp[1];
        break;
      case "2":
        $subheader = $exp[1];
        break;
      case "3":
        $item = explode('~', $exp[1]);
        $menu1 = $item[0];
        $menu2 = $item[1];
        $menu3 = $item[2];
        $menu4 = $item[3];
        $menu5 = $item[4];
        $menu6 = $item[5];
        $menu7 = $item[6];
        $menu8 = $item[7];
        $menu9 = $item[8];
        break;
      case "4":
        $item = explode('~', $exp[1]);
        $memSettings1 = $item[0];
        $memSettings2 = $item[1];
        break;
      case "5":
        $item = explode('~', $exp[1]);
        $headButton = $item[0];
        break;
      case "6":
        $item = explode('~', $exp[1]);
        $gameHeader = $item[0];
        break;
      case "7":
        $item = explode('~', $exp[1]);
        $titleFeature1 = $item[0];
        $titleFeature2 = $item[1];
        $titleFeature3 = $item[2];
        break;
      case "8":
        $item = explode('~', $exp[1]);
        $bodyFeature1 = $item[0];
        $bodyFeature2 = $item[1];
        $bodyFeature3 = $item[2];
        break;
      case "9":
        $item = explode('~', $exp[1]);
        $aboutList1 = $item[0];
        $aboutList2 = $item[1];
        $aboutList3 = $item[2];
        break;
      default:
        break;
    }
  }
  fclose($file_handle);

  Session::set('memSettings1', $memSettings1);
  Session::set('memSettings2', $memSettings2);
  Session::set('menu1', $menu1);
  Session::set('menu2', $menu2);
  Session::set('menu3', $menu3);
  Session::set('menu4', $menu4);
  Session::set('menu5', $menu5);
  Session::set('menu6', $menu6);
  Session::set('menu7', $menu7);
  Session::set('menu8', $menu8);
  Session::set('menu9', $menu9);
  Session::set('headButton', $headButton);
  Session::set('header', $header);
  Session::set('subheader', $subheader);
  Session::set('lines', $lines);
  Session::set('gameHeader', $gameHeader);
  Session::set('titleFeature1', $titleFeature1);
  Session::set('titleFeature2', $titleFeature2);
  Session::set('titleFeature3', $titleFeature3);
  Session::set('bodyFeature1', $bodyFeature1);
  Session::set('bodyFeature2', $bodyFeature2);
  Session::set('bodyFeature3', $bodyFeature3);
  Session::set('aboutList1', $aboutList1);
  Session::set('aboutList2', $aboutList2);
  Session::set('aboutList3', $aboutList3);
?>
