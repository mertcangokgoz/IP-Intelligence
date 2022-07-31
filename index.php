<!doctype html>
<html lang="en">
<head>
    <title>IP Intelligence</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Mertcan GÖKGÖZ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Simple IP Intelligence">
    <meta name="description" content="Simple IP Intelligence is a service that determines high-risk ip addresses">
    <meta name="keywords" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://check.mertcan.dev/">
    <meta property="og:title" content="Simple IP Intelligence">
    <meta property="og:description" content="Simple IP Intelligence is a service that determines high-risk ip addresses">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:url" content="https://check.mertcan.dev/">
    <meta property="twitter:title" content="Simple IP Intelligence">
    <meta property="twitter:description" content="Simple IP Intelligence is a service that determines high-risk ip addresses">
    <meta property="twitter:creator" content="@mertcangokgoz">
    <link rel="canonical" href="https://check.mertcan.dev/"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-3"></div>
            <div class="column is-6">
                <form id="IPsearchForm" class="control" action="javascript:void(0)">
                    <div class="field">
                        <label class="label">IP Address</label>
                        <div class="control">
                            <label>
                                <input class="input" type="text" name="ip" placeholder="1.1.1.1" required>
                            </label>
                        </div>
                        <p class="help">Please enter the IP address you want to search.</p>
                    </div>
                    <div class="control has-text-centered">
                        <button id="searchSubmit" class="button is-info" name="button" type="button"
                                onclick="SearchFunction()">Search
                        </button>
                    </div>
                </form>
                <br>
                <article id="errorArticle" class="message is-small is-danger" style="display: none;">
                    <div id="errorMessage" class="message-body"></div>
                </article>
                <article id="successArticle" class="message is-small is-success" style="display: none;">
                    <div id="successMessage" class="message-body"></div>
                </article>
            </div>
            <div class="column is-3"></div>
        </div>
        <div class="content has-text-centered"><p>Powered by <a href="https://mertcangokgoz.com/"
                                                                target="_blank" rel="dofollow">Mertcan
                    GÖKGÖZ</a></p></div>
    </div>
</section>
<script>
    function SearchFunction() {
        const x = document.getElementById("IPsearchForm");
        const ip = x.elements["ip"].value;
        if (ip === "") {
            document.getElementById("errorMessage").innerHTML = "Please enter an IP address.";
            document.getElementById("errorArticle").style.display = "block";
            document.getElementById("successArticle").style.display = "none";
        } else {
            document.getElementById("errorArticle").style.display = "none";
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "https://check.mertcan.dev/check.php?ip=" + document.getElementsByName("ip")[0].value, true);
            xhttp.send();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.status === "success") {
                        document.getElementById("successArticle").style.display = "none";
                        document.getElementById("errorMessage").innerHTML = response.blocked ? "IP address is blocked." : "IP address is not blocked.";
                        document.getElementById("errorArticle").style.display = "block";
                    } else if (response.status === "fail") {
                        document.getElementById("errorArticle").style.display = "none";
                        document.getElementById("successMessage").innerHTML = response.blocked ? "IP address is blocked." : "IP address is not blocked.";
                        document.getElementById("successArticle").style.display = "block";
                    }
                }
            };
        }
    }
</script>
</body>
</html>
