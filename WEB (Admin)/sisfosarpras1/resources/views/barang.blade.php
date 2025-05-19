@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadKondisi();
    loadBarang();

    document.getElementById('formBarang').addEventListener('submit', function(e) {
        e.preventDefault();
        tambahBarang();
    });
});

// load Kondisi ke dalam Dropdown
function loadKondisi() {
    fetch('/api/kondisi')
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('kondisi_id');
            select.innerHTML = '';
            data.forEach(kondisi => {
                select.innerHTML += `<option value="${kondisi.id}">${kondisi.nama_kondisi}</option>`;
            });
        });
}

// load Barang ke dalam Tabel
function loadBarang() {
    fetch('/api/barang')
        .then(response => response.json())
        .then(data => {
            let tbody = document.getElementById('tabelBarang').querySelector('tbody');
            tbody.innerHTML = '';
            data.forEach(barang => {
                tbody.innerHTML += `
                    <tr>
                        <td>${barang.nama_barang}</td>
                        <td>${barang.kondisi ? barang.kondisi.nama_kondisi : 'Tidak Ada'}</td>
                        <td>
                            <button onclick="hapusBarang(${barang.id})">Hapus</button>
                        </td>
                    </tr>
                `;
            });
        });
}

// tambah Barang
function tambahBarang() {
    const nama_barang = document.getElementById('nama_barang').value;
    const kondisi_id = document.getElementById('kondisi_id').value;

    fetch('/api/barang', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ nama_barang, kondisi_id })
    })
    .then(response => response.json())
    .then(data => {
        alert('Barang berhasil ditambahkan!');
        loadBarang();
        document.getElementById('formBarang').reset();
    });
}

// hapus Barang
function hapusBarang(id) {
    if(confirm('Yakin mau hapus barang ini?')) {
        fetch(`/api/barang/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            alert('Barang berhasil dihapus!');
            loadBarang();
        });
    }
}
</script>
@endsection
