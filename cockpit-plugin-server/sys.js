cockpit.transport.wait(function() { });

const result = document.getElementById("r");
const result2 = document.getElementById("r2");

var _ = cockpit.gettext;
translated = _("Password1");
result.innerHTML = translated;

err = _("Error");


// fájl beolvasás, megjelenítés

console.log("0");

f = cockpit.file("/var/log/sbackup.log");
c = f.read();
c.then((content, tag) => {
        if (content == null) {
            result.innerHTML = err;
        }else{
            result.innerHTML = content;
        }
        f.close();
    })
    .catch(error => {
        result.innerHTML = error;
    });


// parancs végrehajtása

console.log("1");

result2.innerHTML = "";

cockpit.spawn(["ls"])
    .stream(r_output)
    .then(r_success)
    .catch(r_fail);

function r_success() {
    result2.innerHTML = result2.innerHTML + "<br />OK";
}

function r_fail(error) {
        result2.innerHTML = error;
}

function r_output(data) {
    result2.innerHTML = result2.innerHTML + data + "<br />";
}


// vége

console.log("2");

