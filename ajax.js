"use strict";

let url = document.querySelector(".url");
let button = document.querySelector(".button");
let answer = document.querySelector(".answer");

button.addEventListener(`click`, function (e) {
    e.preventDefault();
    if (url.value === '') {
        return answer.innerHTML = 'Ииии??';
    } else {
        let params = `url=${url.value}`;
        ajaxQuery('app.php', params, function (data) {
            answer.innerHTML = data;
            url.value = '';
        });
    }
});

function ajaxQuery(url, params, callback) {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (Request.readyState != 4) {
            answer.innerHTML = 'Идет загрузка..';

            if (this.readyState == 4 && this.status == 200) {
                callback(xhr.responseText);
            }
        }
    };
    xhr.open('POST', url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
}
