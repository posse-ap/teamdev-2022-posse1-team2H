<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/sanitize.css">
    <link rel="stylesheet" href="../static/./css/./admin.css">
    <script src="https://kit.fontawesome.com/727d59e43e.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Craft for Boozer</title>
</head>

<body>

    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
            <nav>
                <ul class="for_transition">
                    <li><a href="">掲載・編集関連画面へ</a></li>
                </ul>
            </nav>
            <form class="for_name_sort" action="">
                <select class="select_content" name="" id="">
                    <option value="">売上順</option>
                    <option value="">支払い済み</option>
                    <option value="">未払い</option>
                </select>
                <!-- <input type="submit"> -->
            </form>
            
            <form class="for_serach" action="">
                <input type="text" value=""  placeholder='社名を入力してください'>
                <input id="serach_name" type="submit" value="社名検索">
            </form>

        </div>
    </header>