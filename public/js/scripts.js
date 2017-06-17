var searchForm = document.getElementById('search_form');
var searchInput = document.getElementById('search');
var resultsSection = document.getElementById('titles');
var typingTimer;

searchForm.addEventListener('keyup', delay);

// set delay timer on key press
function delay() {

    // first clear the timeout
    clearTimeout(typingTimer);

    // set the 'loading' message
    if (searchInput.value != '') {
        resultsSection.innerHTML = '<p>Loading...</p>';
    } else {
        resultsSection.innerHTML = '';
    }

    // now set the timeout
    typingTimer = setTimeout(search, 400);
}

// start searching
function search() {
    if (searchInput.value.length > 2) {

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                resultsSection.innerHTML = this.responseText;
            }
        };

        xmlHttp.open("GET", "?search=" + searchInput.value, true);
        xmlHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xmlHttp.send();
    }
};

searchForm.addEventListener('keydown', typingTimer);
