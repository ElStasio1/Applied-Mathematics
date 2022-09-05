"use strict";
const textarea = document.getElementById("textarea");

function insertAtCursor(myField, myValue) {
    if (myField.selectionStart || myField.selectionStart == "0") {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value =
            myField.value.substring(0, startPos) +
            myValue +
            myField.value.substring(endPos, myField.value.length);
    } else {
        myField.value += myValue;
    }
}

function compile() {
    const compiled = document.getElementById("compiled");
    let data = textarea.value;
    const openCompileTags = {
        "[table]": "<table class='post-table'>",
        "[tablerow]": "<tr class='post-table-row'>",
        "[tableelem]": "<td class='post-table-element'>",
        "[h1]": "<h1>",
        "[h2]": "<h2>",
        "[h3]": "<h3>",
        "[p]": "<p class='text-just'>",
        "[content]": "<div class='content'>",
        "[quote]": "<div class='quote'>",
        "[img url='": "<img class='post-image w-33' src='",
        "']": "' alt='",
        "[b]": "<span class='bold'>",
        "[u]": "<span class='under'>",
        "[i]": "<span class='italic'>",
        "[left]": "<div class='content left'>",
        "[right]": "<div class='content right'>",
        "[center]": "<div class='content center'>",
        "[imgcaption]": "<div class='img-caption'>",
        "[list]": "<ul class='post-list'>",
        "[*]": "<li class='post-element'>",
        "[link url='": "<a href='",
        "'|]": "'>",
    };
    const closeCompileTags = {
        "[/table]": "</table>",
        "[/tablerow]": "</tr>",
        "[/tableelem]": "</td>",
        "[/h1]": "</h1>",
        "[/h2]": "</h2>",
        "[/h3]": "</h3>",
        "[/p]": "</p>",
        "[/content]": "</div>",
        "[/quote]": "</div>",
        "[/img]": "'>",
        "[/b]": "</span>",
        "[/u]": "</span>",
        "[/i]": "</span>",
        "[/left]": "</div>",
        "[/right]": "</div>",
        "[/center]": "</div>",
        "[/imgcaption]": "</div>",
        "[/list]": "</ul>",
        "[/*]": "</li>",
        "[/link]": "</a>",
    };
    for (const [key, value] of Object.entries(openCompileTags)) {
        data = data.replaceAll(key, value);
    }
    for (const [key, value] of Object.entries(closeCompileTags)) {
        data = data.replaceAll(key, value);
    }
    compiled.innerHTML = data;
}
const tags = {
    table: "[table][/table]",
    tablerow: "[tablerow][/tablerow]",
    tableelem: "[tableelem][/tableelem]",
    h1: "[h1][/h1]",
    h2: "[h2][/h2]",
    h3: "[h3][/h3]",
    p: "[p][/p]",
    content: "[content][/content]",
    quote: "[quote][/quote]",
    img: "[img url=''][/img]",
    b: "[b][/b]",
    u: "[u][/u]",
    i: "[i][/i]",
    left: "[left][/left]",
    right: "[right][/right]",
    center: "[center][/center]",
    imgcaption: "[imgcaption][/imgcaption]",
    list: "[list][/list]",
    listelement: "[*][/*]",
    link: "[link url=''|][/link]"
};
const buttons = document.querySelectorAll(".add-button");
for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("mousedown", (e) => {
        e.preventDefault();
        const button = e.target;
        insertAtCursor(textarea, tags[button.value.toLowerCase()]);
    });
}
const descriptions = document.querySelectorAll(".lengt");
descriptions.forEach(desc => {
    let text = desc.textContent;
    const textLimit = 100;
    if (text.length <= textLimit) return;
    text = text.substring(0, textLimit);
    text += "...";
    desc.textContent = text;
});