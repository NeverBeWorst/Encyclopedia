document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchText');
    var suggestionsContainer = document.getElementById('suggestions');
    var searchForm = document.getElementById('searchForm');

    if (searchInput && suggestionsContainer) {
        
        searchInput.addEventListener('input', function() {
            console.log('faza1');
            var searchText = searchInput.value.trim();
            if (searchText.length > 0) {
                fetchSuggestions(searchText);
            } else {
                suggestionsContainer.innerHTML = '';
            }
        });

        suggestionsContainer.addEventListener('click', function(event) {
            if (event.target.tagName === 'LI') {
                searchInput.value = event.target.textContent;
                suggestionsContainer.innerHTML = ''; // Очистка подсказок после выбора
                searchForm.submit(); // Отправка формы
            }
        });
    }

    function fetchSuggestions(searchText) {
        fetch("{{ route('search') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('test6')
            },
            body: JSON.stringify({ searchText: searchText })
        })
        .then(response => response.json())
        .then(data => {
            suggestionsContainer.innerHTML = '';
            data.forEach(function(suggestion) {
                var suggestionElement = document.createElement('li');
                suggestionElement.textContent = suggestion;
                suggestionsContainer.appendChild(suggestionElement);
            });
        });
    }
});