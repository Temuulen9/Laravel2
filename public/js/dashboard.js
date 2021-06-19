function openNav() {
    if (window.matchMedia("(max-width: 600px)").matches) {
        if (document.getElementById("main_sidebar").style.display == "block") {
            document.getElementById("main_sidebar").style.display = "none";
            document.getElementById("show_content").style.display = "block";
        }
        else {
            document.getElementById("main_sidebar").style.display = "block";
            document.getElementById("show_content").style.display = "none";
        }
    }
    else {
        if (document.getElementById("main_sidebar").style.display == "block") {
            document.getElementById("main_sidebar").style.display = "none";

        }
        else {
            document.getElementById("main_sidebar").style.display = "block";

        }
    }
}

function show_durem(id) {
    for (i = 1; i < 39; i++) {
        if (id == i) {
            document.getElementById(id + "a").style.display = "block";
            if (window.matchMedia("(max-width: 600px)").matches) {
                document.getElementById("main_sidebar").style.display = "none";
                document.getElementById("show_content").style.display = "block";
            }
        }
        else {
            document.getElementById(i + "a").style.display = "none";
        }

    }
}