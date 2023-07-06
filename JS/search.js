function searchUsers(keyword) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'searchUsers.php?keyword=' + keyword, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var users = JSON.parse(xhr.responseText);
            var userSearchInput = document.getElementById('userSearch');
            userSearchInput.setAttribute('list', 'userList');

            var userList = document.getElementById('userList');
            userList.innerHTML = '';
            users.forEach(function(user) {
                var option = document.createElement('option');
                option.value = user.username;
                userList.appendChild(option);
            });
        } else {
            console.log('Błąd żądania AJAX');
        }
    };
    xhr.send();
}