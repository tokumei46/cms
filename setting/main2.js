const i = "<img src='setting/img/";
const x = "'>";

document.getElementById("bt").addEventListener("click", () => {
    let n = document.getElementById("gazou").value;
    document.getElementById("sam").innerHTML = i + n + x;
});

document.body.addEventListener("keyup", () => {
    document.getElementById("box").innerHTML = document.getElementById("area").value;
});

document.body.addEventListener("keyup", () => {
    document.getElementById("title").innerHTML = document.getElementById("title1").value;
});

document.getElementById("h1").addEventListener("click", () => {
    document.getElementById("area").value += "<h1></h1>";
});

document.getElementById("p").addEventListener("click", () => {
    document.getElementById("area").value += "<p></p>";
});

document.getElementById("br").addEventListener("click", () => {
    document.getElementById("area").value += "<br>";
});
document.getElementById("h2").addEventListener("click", () => {
    document.getElementById("area").value += "<h2></h2>";
});
document.getElementById("img").addEventListener("click", () => {
    document.getElementById("area").value += "<img class='bunimg' src='setting/img/ここにimg'>";
});