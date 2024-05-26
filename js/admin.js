fetch('../koneksi/getdata.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.querySelector('#data-table tbody');

        data.forEach(row => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `<td>${row.id_pengguna}</td><td>${row.username}</td><td>${row.password}</td><td>${row.role}</td><td>${row.login_time}</td><td><button class="delete-btn" onclick="deleteRow('${row.id_pengguna}')">Delete</button></td>`;
            tableBody.appendChild(newRow);
        });
    })
    .catch(error => console.error('Error:', error));

function deleteRow(id_pengguna) {
    if (confirm('Apakah anda serius menghapus data ini?')) {
        fetch(`admin.php?action=delete&id_pengguna=${id_pengguna}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data telah dihapus.');
                location.reload('../admin/admin.php');
            } else {
                alert('Gagal menghapus data.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
