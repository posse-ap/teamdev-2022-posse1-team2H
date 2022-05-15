<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/sanitize.css">
    <link rel="stylesheet" href="../static/css/agencyInfo.css">
    <script src="https://kit.fontawesome.com/727d59e43e.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Craft for Boozer</title>
</head>

<body>

    <header>
        <div class="header_inner">
            <div class="page_name">管理画面</div>
            <div id="changing_status" class="changing_status_and_delete">
                <button onclick="select()">選択</button>
                <button onclick="deleting()">消去</button>
            </div>
        </div>
    </header>