function createDateFromString(dateString) {
    const isoString = dateString.replace(' ', 'T');
    return new Date(isoString);
}

function get_last_ping(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const now = new Date();
            const last_response = createDateFromString(this.response);

            const differenceInMilliseconds = now - last_response;

            if(differenceInMilliseconds > 15000){
                document.getElementById('popup').style.display = 'block';
            } else {
                document.getElementById('popup').style.display = 'none';
            }
        }
    };
    xhttp.open("POST", "../assets/alarm/get_data.php", true);
    xhttp.setRequestHeader('X-API-KEY', 'im_safe_i_promise');
    xhttp.setRequestHeader('REQUEST', 'get_client_time');
    xhttp.send();
}
