function get_data() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const data = (this.response);
            var rangeInput = document.getElementById('myRange');
            rangeInput.value = parseInt(data);
            console.log(data);
            return data;
        }
    };
    xhttp.open("POST", "../assets/alarm/get_data.php", true);
    xhttp.setRequestHeader('X-API-KEY', 'im_safe_i_promise');
    xhttp.setRequestHeader('REQUEST', 'alarm_data');
    xhttp.send();
}

function get_data_once() {
    get_data();
}

function get_data_loop() {
    get_data();
    setInterval(get_data, 5000);
}
