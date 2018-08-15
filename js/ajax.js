/* Article FructCode.com */
$( document ).ready(function() {
    $("#btn").click(
        function(){
            sendAjaxForm('comments', 'ajax_form', 'action_ajax_form.php');
            return false;
        }
    );
});

function sendAjaxForm(comments, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            $('#comments').html('Имя: '+result.name+'<br>E-Mail: '+result.email+'<br>Комментарий: '+result.comment);
        },
        error: function(response) { // Данные не отправлены
            $('#comments').html('Ошибка. Данные не отправлены.');
        }
    });
}