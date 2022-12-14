<?php
if (!isset($_GET['pass']) || $_GET['pass'] !== 'etpgpb-ml') {
    die();
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Визуализация квеста</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="scripts/springy.js"></script>
    <script src="scripts/springyui.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    var quest = {};
    $.ajax({
        url: 'getQuestJson.php?pass=etpgpb-ml',
        type: 'GET',
        dataType: 'json',
        async: false,
        success: function (data) {
            quest = data;
        }
    });
</script>
<div style="display: flex;align-content: center;flex-direction: column;align-items: center;">
    <div style="display: block;padding-bottom: 20px;">
        <div style="display: flex;">
            <div>ID стартового шага: </div>
            <div id="start_id" style="padding-left: 5px;"></div>
        </div>
        <div style="display: flex;">
            <div>ID финального шага: </div>
            <div id="final_id" style="padding-left: 5px;"></div>
        </div>
    </div>
    <canvas id="graphDiv" width="900" height="900" style="border: solid 2px black;"></canvas>
</div>
<script>
    document.getElementById('start_id').innerHTML = quest.start_id;
    document.getElementById('final_id').innerHTML = quest.final_id;

    var graph = new Springy.Graph();
    var nodes = {};
    var links = [];

    quest.steps.forEach(function(step) {
        var text = '';
        var image = '';
        step.content.forEach(function(contentAr) {
            if (contentAr.type === 'text') {
                text += contentAr.value;
                return;
            }
            image = contentAr.value;
        });
        var buttons = [];
        step.answer.forEach(function(answer) {
            links.push({from: step.id, to: answer.move})
            buttons.push({text: answer.value, move: answer.move});
        });
        nodes[step.id] = graph.newNode({
            label: step.id,
            stepText: text,
            stepImage: image,
            stepButtons: buttons
        });
    });

    links.forEach(function(link) {
        graph.newEdge(nodes[link.from], nodes[link.to], {color: '#00A0B0'})
    })

    jQuery(function(){
        var springy = window.springy = jQuery('#graphDiv').springy({
            graph: graph,
            nodeDoubleClicked: function (node) {
                var footer = '<div style="display: block;"><div>Кнопки: </div>';
                node.data.stepButtons.forEach(function (button) {
                    footer += '<div>`' + button.text + '`[' + button.move + ']</div>';
                });
                footer += '</div>';
                Swal.fire({
                    text: node.data.stepText,
                    imageUrl: node.data.stepImage,
                    footer: footer
                });
            }
        });
    });
</script>
</body>
</html>