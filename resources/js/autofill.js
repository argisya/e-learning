document.addEventListener('DOMContentLoaded', function () {

    const namaLengkapInput = document.getElementById('nama_lengkap');

    // Kalau elemen tidak ada di halaman ini, hentikan eksekusi
    if (!namaLengkapInput) return;

    const nipInput = document.getElementById('username');
    const idUserInput = document.getElementById('id_user');

    // Ambil URL dari data attribute, bukan dari Blade
    const autofillUrl = namaLengkapInput.dataset.url;

    let debounceTimer;
    let dropdown = null;

    function createDropdown() {
        if (dropdown) return;
        dropdown = document.createElement('div');
        dropdown.className = 'absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto mt-1';
        dropdown.style.display = 'none';
        namaLengkapInput.parentNode.style.position = 'relative';
        namaLengkapInput.parentNode.appendChild(dropdown);
    }

    function showDropdown(data) {
        if (!dropdown) createDropdown();
        dropdown.innerHTML = '';
        if (data.length === 0) {
            dropdown.style.display = 'none';
            return;
        }
        data.forEach(item => {
            const div = document.createElement('div');
            div.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
            div.textContent = item.nama_lengkap;
            div.addEventListener('click', () => {
                namaLengkapInput.value = item.nama_lengkap;
                nipInput.value = item.username;
                idUserInput.value = item.id_user;
                dropdown.style.display = 'none';
            });
            dropdown.appendChild(div);
        });
        dropdown.style.display = 'block';
    }

    function hideDropdown() {
        if (dropdown) dropdown.style.display = 'none';
    }

    async function fetchAutocomplete(query) {
        try {
            const response = await fetch(`${autofillUrl}?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            showDropdown(data);
        } catch (error) {
            console.error('Error fetching autocomplete data:', error);
        }
    }

    namaLengkapInput.addEventListener('input', function () {
        const query = this.value.trim();
        clearTimeout(debounceTimer);
        if (query.length < 2) {
            hideDropdown();
            return;
        }
        debounceTimer = setTimeout(() => {
            fetchAutocomplete(query);
        }, 300);
    });

    document.addEventListener('click', function (e) {
        if (!namaLengkapInput.contains(e.target) && (!dropdown || !dropdown.contains(e.target))) {
            hideDropdown();
        }
    });

});