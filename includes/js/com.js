function showHint(str) {
                if (str.length == 0) {
                    document.getElementById("idtabla").innerHTML = "";
                    return;
                }
                else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("idtabla").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","bu_pers.php?arti=" + str, true);
                    xmlhttp.send();
                }
            }