function deleteComment(name) {
    if (confirm('Apakah Anda ingin menghapus komentar ini?')) {
        fetch('../admin/comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name
            })
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                console.error('Gagal menghapus komentar');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
