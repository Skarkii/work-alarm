function get_data() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.response);
            console.log(data['alarm']);
            var rangeInput = document.getElementById('myRange');
            rangeInput.value = parseInt(data['alarm']);
        }
    };
    xhttp.open("GET", "../assets/alarm/get_data.php", true);
    xhttp.send();
}

function get_data_once() {
    get_data();
}

function get_data_loop() {
    get_data();
    setInterval(get_data, 5000);
}
